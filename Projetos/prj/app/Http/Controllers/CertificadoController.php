<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CertificadoController extends Controller
{
	$certificados = Certificado::All();
	$pagetitle = "Lista de Gestão Certeficados";
	return view('certificados.index', compact('certeficados', 'pagetitle'));
}
