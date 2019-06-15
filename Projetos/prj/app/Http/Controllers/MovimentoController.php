<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Movimento;
use App\User;
use App\Aeronave;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMovimento;
use App\Http\Requests\UpdateMovimento;

class MovimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movimentos = Movimento::whereNotNull('id');
        if(request()->query('id')){
            $movimentos = $movimentos->where('id', '=', request()->query('id'));
        }

        if(request()->query('num_diario')){
            $movimentos = $movimentos->where('num_diario', '=', request()->query('num_diario'));
        }


        if(request()->query('aeronave')){
            $movimentos = $movimentos->where('aeronave', '=', request()->query('aeronave'));
        }
        if(request()->query('data_inf')){
            $movimentos = $movimentos->where('data', '>=', request()->query('data_inf'));
        }
        if(request()->query('data_sup')){
            $movimentos = $movimentos->where('data', '<=', request()->query('data_sup'));
        }
        if(request()->query('natureza')){
            $movimentos = $movimentos->where('natureza', '=', request()->query('natureza'));
        }
        if(request()->query('confirmado') == '1')
            $movimentos = $movimentos->where('confirmado', '=', '1');
        if(request()->query('confirmado') == '0')
            $movimentos = $movimentos->where('confirmado', '=', '0');
        if(request()->query('instrutor')){
            $movimentos = $movimentos->where('instrutor_id', '=', request()->query('instrutor'));
        }
        if(request()->query('piloto')){
            $movimentos = $movimentos->where('piloto_id', '=', request()->query('piloto'));
        }
        if(Auth::user()->tipo_socio == 'P') {
            if(request()->query('meus_movimentos')){
                $movimentos = $movimentos->where(function($query) {
                                            $query->where('piloto_id', '=', Auth::id())
                                            ->orWhere('instrutor_id', '=', Auth::id());
                                        });

            }
            $movimentos = $movimentos->paginate(15);
        }
        else {
            $movimentos = $movimentos->paginate(15);
        }

        //Remover parâmetros vazios da query string
        $vazio = array_filter($_GET, function($valores) { return $valores != ''; });
        if ($vazio != $_GET) {
            $query = "?".http_build_query($vazio);

            header('Location: ' . URL::current() . "$query") ;
            exit;
        }

        $pagetitle = "Lista de Movimentos";
        return view('movimentos.index', compact('movimentos', 'pagetitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Movimento::class);
        $pagetitle = "Adicionar Movimento";
        if(Auth::user()->direcao == '1' || Auth::user()->instrutor == '1')
        {
            $pilotos = User::where('tipo_socio', '=', 'P')->get();
            $instrutores = User::where('instrutor', '=', 1)->get();
            $aeronaves = Aeronave::all();
        }
        else
        {
            $pilotos = Auth::user();
            $instrutores = User::where('instrutor', '=', 1)->where('id', '!=', Auth::id())->get();
            $aeronaves = $pilotos->aeronaves;
        }

        $aerodromos = DB::table('aerodromos')->get();
        return view('movimentos.create', compact('pagetitle', 'pilotos', 'instrutores', 'aerodromos', 'aeronaves'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovimento $request)
    {
        $this->authorize('create', Movimento::class);
        $movimento = $request->validated();

        $piloto = User::findOrFail($request->input('piloto_id'));
        $movimento = array_merge($movimento, [
            'num_licenca_piloto' => $piloto->num_licenca,
            'tipo_licenca_piloto' => $piloto->tipo_licenca,
            'validade_licenca_piloto' => $piloto->validade_licenca,
            'num_certificado_piloto' => $piloto->num_certificado,
            'validade_certificado_piloto' => $piloto->validade_certificado,
            'classe_certificado_piloto' => $piloto->classe_certificado,
        ]);

        if($request->input('natureza') == 'I'){
            $instrutor = User::findOrFail($request->input('instrutor_id'));
            $movimento = array_merge($movimento, [
                'num_licenca_instrutor' => $instrutor->num_licenca,
                'tipo_licenca_instrutor' => $instrutor->tipo_licenca,
                'validade_licenca_instrutor' => $instrutor->validade_licenca,
                'num_certificado_instrutor' => $instrutor->num_certificado,
                'validade_certificado_instrutor' => $instrutor->validade_certificado,
                'classe_certificado_instrutor' => $instrutor->classe_certificado,
            ]);
        }
        else {
            $movimento['tipo_instrucao'] = null;
            $movimento['instrutor_id'] = null;
        }
        $movimento['hora_descolagem'] = $movimento['data'].' '.$movimento['hora_descolagem'];
        $movimento['hora_aterragem'] = $movimento['data'].' '.$movimento['hora_aterragem'];


        if(Auth::user()->direcao != '1')
        {
            $movimento['confirmado'] = '0';
        }

        Movimento::create($movimento);
        return redirect()->action('MovimentoController@index')->with('status', 'Movimento adicionado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Movimento::findOrFail($id));
        $pagetitle = "Editar Movimento";
        $movimento = Movimento::findOrFail($id);
        if(Auth::user()->direcao == '1' || Auth::user()->instrutor == '1')
        {
            $pilotos = User::where('tipo_socio', '=', 'P')->get();
            $instrutores = User::where('instrutor', '=', 1)->get();
            $aeronaves = Aeronave::all();
        }
        else
        {
            $pilotos = Auth::user();
            $instrutores = User::where('instrutor', '=', 1)->where('id', '!=', Auth::id())->get();
            $aeronaves = $pilotos->aeronaves;
        }
        $aerodromos = DB::table('aerodromos')->get();
        return view('movimentos.edit', compact('pagetitle', 'movimento', 'pilotos', 'instrutores', 'aerodromos', 'aeronaves'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovimento $request, $id)
    {
        $this->authorize('update', Movimento::findOrFail($id));
        $movimentoModel = Movimento::findOrFail($id);

        $movimento = $request->validated();

        $piloto = User::findOrFail($request->input('piloto_id'));
        $movimento = array_merge($movimento, [
            'num_licenca_piloto' => $piloto->num_licenca,
            'tipo_licenca_piloto' => $piloto->tipo_licenca,
            'validade_licenca_piloto' => $piloto->validade_licenca,
            'num_certificado_piloto' => $piloto->num_certificado,
            'validade_certificado_piloto' => $piloto->validade_certificado,
            'classe_certificado_piloto' => $piloto->classe_certificado,
        ]);

        if($request->input('natureza') == 'I'){
            $instrutor = User::findOrFail($request->input('instrutor_id'));
            $movimento = array_merge($movimento, [
                'num_licenca_instrutor' => $instrutor->num_licenca,
                'tipo_licenca_instrutor' => $instrutor->tipo_licenca,
                'validade_licenca_instrutor' => $instrutor->validade_licenca,
                'num_certificado_instrutor' => $instrutor->num_certificado,
                'validade_certificado_instrutor' => $instrutor->validade_certificado,
                'classe_certificado_instrutor' => $instrutor->classe_certificado,
            ]);
        }
        else{
            $movimentoModel['num_licenca_instrutor'] = null;
            $movimentoModel['tipo_licenca_instrutor'] = null;
            $movimentoModel['validade_licenca_instrutor'] = null;
            $movimentoModel['num_certificado_instrutor'] = null;
            $movimentoModel['validade_certificado_instrutor'] = null;
            $movimentoModel['classe_certificado_instrutor'] = null;
            $movimento['tipo_instrucao'] = null;
            $movimento['instrutor_id'] = null;
        }
        $movimento['hora_descolagem'] = $movimento['data'].' '.$movimento['hora_descolagem'];
        $movimento['hora_aterragem'] = $movimento['data'].' '.$movimento['hora_aterragem'];

        if(Auth::user()->direcao != '1')
        {
            $movimento['confirmado'] = '0';
        }

        $movimentoModel->fill($movimento);
        $movimentoModel->save();
        return redirect()->action('MovimentoController@index')->with('status', 'Movimento editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Movimento::findOrFail($id));
        Movimento::destroy($id);
        return redirect()->action('MovimentoController@index')->with('status', 'Movimento eliminado com sucesso!');
    }

    public function confirmarMovimento(Request $request, $id)
    {
        $this->authorize('confirmar', Movimento::findOrFail($id));
        $movimentoModel = Movimento::findOrFail($id);
        $movimentoModel['confirmado'] = '1';
        $movimentoModel->save();
        return redirect()->action('MovimentoController@index')->with('status', 'Movimento confirmado com sucesso!');
    }
}
