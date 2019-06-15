<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('auth.login');
});

Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth','verified'])->group(function(){
  Route::get('/password', 'UserController@changePassword');
  Route::patch('/password', 'UserController@updatePassword')->name('socios.password');
});

Route::middleware(['auth','verified','direcao'])->group(function(){
  Route::patch('socios/reset_quotas', 'UserController@updateQuotas')->name('socios.quotas');
  Route::patch('socios/desativar_sem_quotas', 'UserController@updateAtivos')->name('socios.ativos');
  Route::patch('socios/{socio}/quota', 'UserController@updateQuota')->name('socios.quota');
  Route::patch('socios/{socio}/ativo', 'UserController@updateAtivo')->name('socios.ativo');
  Route::post('socios/{socio}/send_reactivate_mail', 'UserController@sendMail')->name('socios.mail');
  Route::patch('movimentos/{movimento}/confirmar', 'MovimentoController@confirmarMovimento')->name('movimentos.confirmar');
});

Route::middleware(['auth','verified','ativo'])->group(function(){
  Route::get('pilotos/{piloto}/certificado', function($id){
  	return response()->file(storage_path('app/docs_piloto/certificado_'.$id.'.pdf'));
  })->name('pilotos.certificado');
  Route::get('pilotos/{piloto}/licenca', function($id){
  	return response()->file(storage_path('app/docs_piloto/licenca_'.$id.'.pdf'));
  })->name('pilotos.licenca');

  Route::resource('aeronaves', 'AeronaveController')->except(['show'])->parameters(['aeronaves' => 'aeronave']);
  Route::resource('socios', 'UserController')->except(['show']);
  Route::resource('movimentos', 'MovimentoController')->except(['show'])->parameters(['movimentos' => 'movimento']);

  Route::get('pilotos', 'UserController@pilotos')->name('socios.pilotos');
  Route::get('alunos', 'UserController@alunos')->name('socios.alunos');
  Route::get('instrutores', 'UserController@instrutores')->name('socios.instrutores');

  Route::get('/certificados', 'CertificadoController@index');

});
