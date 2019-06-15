<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\User;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Http\Requests\UpdatePasswordUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereNull('deleted_at');

        if(request()->query('num_socio')){
            $users = $users->where('num_socio', '=', request()->query('num_socio'));
        }

        if(request()->query('nome_informal')){
            $users = $users->where('nome_informal', 'LIKE', '%'.request()->query('nome_informal').'%');
        }
        if(request()->query('email')){
            $users = $users->where('email', 'LIKE', '%'.request()->query('email').'%');
        }
        if(request()->query('tipo')){
            $users = $users->where('tipo_socio', '=', request()->query('tipo'));
        }
        if(request()->query('direcao') == '1')
            $users = $users->where('direcao', '=', '1');
        if(request()->query('direcao') == '0')
            $users = $users->where('direcao', '=', '0');
        if(Auth::user()->direcao == '1') {
            if(request()->query('quotas_pagas') == '1')
                $users = $users->where('quota_paga', '=', '1');
            if(request()->query('quotas_pagas') == '0')
                $users = $users->where('quota_paga', '=', '0');
            if(request()->query('ativo') == '1')
                $users = $users->where('ativo', '=', '1');
            if(request()->query('ativo') == '0')
                $users = $users->where('ativo', '=', '0');

            $users = $users->paginate(15);
        }
        else {
            $users = $users->where('ativo', '=', '1')->paginate(15);
        }
        //dd(request()->query());
        
        //Remover parâmetros vazios da query string
        $vazio = array_filter($_GET, function($valores) { return $valores != ''; });
        if ($vazio != $_GET) {
            $query = "?".http_build_query($vazio);

            header('Location: ' . URL::current() . "$query") ;
            exit;
        }

        $pagetitle = "Lista de Sócios";
        return view('users.index', compact('users', 'pagetitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);
        $pagetitle = "Adicionar Sócio";
        $licencas = DB::table('tipos_licencas')->get();
        $certificados = DB::table('classes_certificados')->get();
        return view('users.create', compact('pagetitle', 'licencas', 'certificados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $this->authorize('create', User::class);

        $user = $request->validated();

        $user['password'] = Hash::make($request->data_nascimento);
        $user['password_inicial'] = '1';
        if($request->input('tipo_socio') != 'P'){
            $user['num_licenca'] = null;
            $user['tipo_licenca'] = null;
            $user['instrutor'] = '0';
            $user['aluno'] = '0';
            $user['validade_licenca'] = null;
            $user['licenca_confirmada'] = null;
            $user['num_certificado'] = null;
            $user['classe_certificado'] = null;
            $user['validade_certificado'] = null;
            $user['certificado_confirmado'] = null;
        }

        if($request->hasFile('file_foto') && $request->file('file_foto')->isValid()){
            $path = Storage::putFile('public/fotos', $request->file('file_foto'));
            $user['foto_url'] = basename($path);
        }

        $dadosUser = User::create($user);
        $dadosUser->sendEmailVerificationNotification();

        if($request->input('tipo_socio') == 'P'){
            if($request->hasFile('file_licenca') && $request->file('file_licenca')->isValid()){
                Storage::putFileAs('docs_piloto', $request->file('file_licenca'), 'licenca_'.$dadosUser->id.'.pdf');
            }
            if($request->hasFile('file_certificado') && $request->file('file_certificado')->isValid()){
                Storage::putFileAs('docs_piloto', $request->file('file_certificado'), 'certificado_'.$dadosUser->id.'.pdf');
            }
        }
        return redirect()->action('UserController@index')->with('status', 'Sócio adicionado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', User::findOrFail($id));
        $pagetitle = "Editar Sócio";
        $user = User::findOrFail($id);
        $licencas = DB::table('tipos_licencas')->get();
        $certificados = DB::table('classes_certificados')->get();
        return view('users.edit', compact('pagetitle', 'user', 'licencas', 'certificados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        $this->authorize('update', User::findOrFail($id));

        $user = $request->validated();

        $userModel = User::findOrFail($id);
        if(Auth::user()->direcao != '1')
        {
          $user['num_socio'] = $userModel['num_socio'];
          $user['ativo'] = $userModel['ativo'];
          $user['quota_paga'] = $userModel['quota_paga'];
          $user['sexo'] = $userModel['sexo'];
          $user['tipo_socio'] = $userModel['tipo_socio'];
          $user['direcao'] = $userModel['direcao'];
          $user['instrutor'] = $userModel['instrutor'];
          $user['aluno'] = $userModel['aluno'];
          $user['certificado_confirmado'] = $userModel['certificado_confirmado'];
          $user['licenca_confirmada'] = $userModel['licenca_confirmada'];
        }

        if(Auth::user()->direcao != '1' && ($request->num_licenca != $userModel['num_licenca'] || $request->tipo_licenca != $userModel['tipo_licenca'] || $request->validade_licenca != $userModel['validade_licenca']))
        {
            $user['licenca_confirmada'] = '0';
        }
        if(Auth::user()->direcao != '1' && ($request->num_certificado != $userModel['num_certificado'] || $request->classe_certificado != $userModel['classe_certificado'] || $request->validade_certificado != $userModel['validade_certificado']))
        {
            $user['certificado_confirmado'] = '0';
        }

        if($request->input('tipo_socio') != 'P'){
            $user['num_licenca'] = null;
            $user['tipo_licenca'] = null;
            $user['instrutor'] = '0';
            $user['aluno'] = '0';
            $user['validade_licenca'] = null;
            $user['licenca_confirmada'] = null;
            $user['num_certificado'] = null;
            $user['classe_certificado'] = null;
            $user['validade_certificado'] = null;
            $user['certificado_confirmado'] = null;
            Storage::delete('docs_piloto/licenca_'.$userModel->id.'.pdf');
            Storage::delete('docs_piloto/certificado_'.$userModel->id.'.pdf');
        }

        if($request->hasFile('file_foto') && $request->file('file_foto')->isValid()){
            if(Storage::exists('public/fotos/'.$userModel->foto_url)){
                Storage::delete('public/fotos/'.$userModel->foto_url);
            }
            $path = Storage::putFile('public/fotos', $request->file('file_foto'));
            $user['foto_url'] = basename($path);
        }

        if($request->input('tipo_socio') == 'P'){
            if($request->hasFile('file_licenca') && $request->file('file_licenca')->isValid()){
                if(Storage::exists('docs_piloto/licenca_'.$userModel->id.'.pdf')){
                    Storage::delete('docs_piloto/licenca_'.$userModel->id.'.pdf');
                }
                Storage::putFileAs('docs_piloto', $request->file('file_licenca'), 'licenca_'.$userModel->id.'.pdf');
                $user['licenca_confirmada'] = '0';
            }
            if($request->hasFile('file_certificado') && $request->file('file_certificado')->isValid()){
                if(Storage::exists('docs_piloto/certificado_'.$userModel->id.'.pdf')){
                    Storage::delete('docs_piloto/certificado_'.$userModel->id.'.pdf');
                }
                Storage::putFileAs('docs_piloto', $request->file('file_certificado'), 'certificado_'.$userModel->id.'.pdf');
                $user['certificado_confirmado'] = '0';
            }
        }

        $userModel->fill($user);
        $userModel->save();
        return redirect()->action('UserController@index')->with('status', 'Sócio editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', User::findOrFail($id));
        $user = User::findOrFail($id);
        if($user->movimentosPiloto->count() == 0 && $user->movimentosInstrutor->count() == 0)
        {
            if($user->foto_url != null && Storage::exists('public/fotos/'.$user->foto_url)){
                Storage::delete('public/fotos/'.$user->foto_url);
            }
            if(Storage::exists('docs_piloto/licenca_'.$user->id.'.pdf')){
                Storage::delete('docs_piloto/licenca_'.$user->id.'.pdf');
            }
            if(Storage::exists('docs_piloto/certificado_'.$user->id.'.pdf')){
                Storage::delete('docs_piloto/certificado_'.$user->id.'.pdf');
            }
            $user->forceDelete();
        }
        else
        {
            User::destroy($id);
        }
        return redirect()->action('UserController@index')->with('status', 'Sócio eliminado com sucesso!');
    }

    public function changePassword()
    {
        $this->authorize('updatePassword', User::findOrFail(Auth::id()));
        $pagetitle = "Alterar Password";
        $user = Auth::user();
        return view('users.password', compact('pagetitle', 'user'));
    }

    public function updatePassword(UpdatePasswordUser $request)
    {
        $this->authorize('updatePassword', User::findOrFail(Auth::id()));
        $request->validated();
        $user = $request->only(['password']);
        $user['password'] = Hash::make($request->password);
        $user['password_inicial'] = '0';

        $userModel = User::findOrFail(Auth::id());
        $userModel->fill($user);
        $userModel->save();
        return redirect()->action('HomeController@index')->with('status', 'Password alterada com sucesso!');
    }

    // Mostrar apenas pilotos
    public function pilotos()
    {
        $users = User::where('tipo_socio', 'P')->paginate(15);
        $pagetitle = "Lista de Pilotos";
        return view('users.index', compact('users', 'pagetitle'));
    }

    // Mostrar apenas alunos
    public function alunos()
    {
        $users = User::where('aluno', '=', '1')->paginate(15);
        $pagetitle = "Lista de Alunos";
        return view('users.index', compact('users', 'pagetitle'));
    }

    // Mostrar apenas instrutores
    public function instrutores()
    {
        $users = User::where('instrutor', '=', '1')->paginate(15);
        $pagetitle = "Lista de Instrutores";
        return view('users.index', compact('users', 'pagetitle'));
    }

    public function updateQuota(Request $request, $id)
    {
        $this->authorize('updateQuotaAtivo', User::findOrFail(Auth::id()));
        $userModel = User::findOrFail($id);
        if($request->has('quota_paga'))
        {
            if($userModel['quota_paga'] == '1')
                $userModel['quota_paga'] = '0';
            else
                $userModel['quota_paga'] = '1';
        }
        $userModel->save();
        return redirect()->action('UserController@index')->with('status', 'Quota de Sócio alterada com sucesso!');
    }

    public function updateAtivo(Request $request, $id)
    {
        $this->authorize('updateQuotaAtivo', User::findOrFail(Auth::id()));
        $userModel = User::findOrFail($id);
        if($request->has('ativo'))
        {
            if($userModel['ativo'] == '1')
                $userModel['ativo'] = '0';
            else
                $userModel['ativo'] = '1';
        }
        $userModel->save();
        return redirect()->action('UserController@index')->with('status', 'Estado de Sócio alterado com sucesso!');
    }

    public function sendMail(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->sendEmailVerificationNotification();
        return redirect()->action('UserController@index')->with('status', 'Email de verificação enviado com sucesso!');
    }

    public function updateQuotas(Request $request)
    {
        $this->authorize('updateQuotaAtivo', User::findOrFail(Auth::id()));
        if($request->has('quotas_pagas'))
        {
            User::whereNull('deleted_at')->where('quota_paga', '1')->where('id', '!=', Auth::id())->update(['quota_paga' => '0']);
        }
        return redirect()->action('UserController@index')->with('status', 'Quotas de todos os Sócios atualizadas com sucesso!');
    }

    public function updateAtivos(Request $request)
    {
        $this->authorize('updateQuotaAtivo', User::findOrFail(Auth::id()));
        if($request->has('ativos'))
        {
            User::whereNull('deleted_at')->where('ativo', '1')->where('quota_paga', '0')->where('id', '!=', Auth::id())->update(['ativo' => '0']);
        }
        return redirect()->action('UserController@index')->with('status', 'Estados de todos os Sócios atualizados com sucesso!');
    }
}
