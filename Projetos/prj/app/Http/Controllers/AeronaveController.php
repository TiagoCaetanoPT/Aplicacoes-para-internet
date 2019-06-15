<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aeronave;
use App\Http\Requests\StoreAeronave;
use App\Http\Requests\UpdateAeronave;
use Illuminate\Support\Facades\DB;

class AeronaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aeronaves = Aeronave::All();
        $pagetitle = "Lista de Aeronaves";
        return view('aeronaves.index', compact('aeronaves', 'pagetitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Aeronave::class);
        $pagetitle = "Adicionar Aeronave";
        $unidades_conta_horas = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        return view('aeronaves.create', compact('pagetitle', 'unidades_conta_horas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAeronave $request)
    {
        $this->authorize('create', Aeronave::class);
        $aeronave = $request->validated();
        $aeronave = $request->only(['matricula', 'marca', 'modelo', 'num_lugares', 'conta_horas', 'preco_hora']);
        $aeronaveValores = $request->only(['matricula', 'unidade_conta_horas', 'tempos', 'precos']);

        Aeronave::create($aeronave);
        foreach($aeronaveValores['unidade_conta_horas'] as $valor){
            DB::table('aeronaves_valores')->insert(
                ['matricula' => $aeronave['matricula'], 'unidade_conta_horas' => $valor, 'minutos' => $aeronaveValores['tempos'][$valor], 'preco' => $aeronaveValores['precos'][$valor]]
            );
        }
        return redirect()->action('AeronaveController@index')->with('status', 'Aeronave adicionada com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Aeronave::findOrFail($id));
        $pagetitle = "Editar Aeronave";
        $aeronave = Aeronave::findOrFail($id);
        $aeronaveValores = DB::table('aeronaves_valores')->where('matricula', $aeronave->matricula)->get();
        return view('aeronaves.edit', compact('pagetitle', 'aeronave', 'aeronaveValores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAeronave $request, $id)
    {
        $this->authorize('update', Aeronave::findOrFail($id));
        $aeronave = $request->validated();

        $aeronave = $request->only(['matricula', 'marca', 'modelo', 'num_lugares', 'conta_horas', 'preco_hora']);
        $aeronaveValores = $request->only(['matricula', 'unidade_conta_horas', 'tempos', 'precos']);
        $aeronaveModel = Aeronave::findOrFail($id);
        $aeronaveModel->fill($aeronave);
        $aeronaveModel->save();

        foreach($aeronaveValores['unidade_conta_horas'] as $valor){
            DB::table('aeronaves_valores')->where('matricula', $aeronave['matricula'])->where('unidade_conta_horas', $valor)->update(
                ['minutos' => $aeronaveValores['tempos'][$valor], 'preco' => $aeronaveValores['precos'][$valor]]
            );
        }

        return redirect()->action('AeronaveController@index')->with('status', 'Aeronave editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Aeronave::findOrFail($id));
        $aeronave = Aeronave::findOrFail($id);
        DB::table('aeronaves_valores')->where('matricula', '=', $aeronave->matricula)->delete();
        if($aeronave->movimentos->count() == 0)
        {
            $aeronave->forceDelete();
        }
        else
        {
            Aeronave::destroy($id);
        }
        return redirect()->action('AeronaveController@index')->with('status', 'Aeronave eliminada com sucesso!');
    }
}
