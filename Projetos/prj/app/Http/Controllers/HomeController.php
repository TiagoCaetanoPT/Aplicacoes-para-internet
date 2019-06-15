<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Aeronave;
use App\Movimento;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Recebe as contagem dos socios para apresentar na página inicial
        $totalPilotos = User::where('tipo_socio', 'P')->count();
        $totalSocios = User::where('deleted_at', null)->count();
        $totalAlunos = User::where('aluno', '=', '1')->count();
        $totalInstrutores = User::where('instrutor', '=', '1')->count();

        //Recebe as aeronaves para o grafico da pagina inicial
        $aeronaves = Aeronave::All();

        // Recebe os ultimos movimentos para a tabela da pagina inicial
        $movimentos = Movimento::orderBy('id', 'desc')->take(10)->get();

        //Recebe as contagem dos voos para apresentar no grafico da página inicial
        $totalTreinos = Movimento::where('natureza', 'T')->count();
        $totalEspecial = Movimento::where('natureza', 'E')->count();
        $totalInstrucao = Movimento::where('natureza', 'I')->count();

        $pagetitle = "Pagina Incial";
        return view('home', compact('totalPilotos', 'totalSocios', 'totalAlunos', 'totalInstrutores',
                                    'aeronaves', 'movimentos',
                                    'totalTreinos', 'totalEspecial', 'totalInstrucao',
                                    'pagetitle'));
    }
}
