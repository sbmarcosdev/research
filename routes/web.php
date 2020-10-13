<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login.ad');
});

Route::get('login', 'LoginADController@index');
Route::post('login-ad', 'LoginADController@auth_ad');

Route::resource('empresas', 'EmpresasController');

Route::resource('campanhas', 'CampanhaController');
Route::delete('campanhas', 'CampanhaController@destroy');

Route::resource('mensagens', 'MensagemController');
Route::get('mensagens/incluir/{campanha_id}', 'MensagemController@create');

Route::get('inserir-opcoes/{id}/create', 'OpcoesController@create');
Route::resource('opcoes', 'OpcoesController');

Route::resource('importar', 'CampanhaRespondenteController');

Route::get('arquivo/{campanha_id}', 'CampanhaRespondenteController@export');


Route::resource('perguntas', 'PerguntaController');
Route::get('perguntas/{campanha_id}/create', 'PerguntaController@create');
Route::post('perguntas/reorder', 'PerguntaController@reorder')->name('admin.perguntas.reorder');

Route::post('import/{campanha_id}', 'CampanhaRespondenteController@update');

Route::get('responder/{campanha_id}/{respondente_id}', 'RespostaController@login');

Route::get('resposta', 'RespostaController@edit');
Route::patch('resposta', 'RespostaController@update');

Route::get('relatorios', 'RelatorioController@index');
Route::get('relatorios/{campanha_id}', 'RelatorioController@show');
Route::get('relatorios/{pergunta_id}/detalhe','RelatorioController@detalhe');
Route::get('relatorios/{pergunta_id}/{respodente_id}', 'RelatorioController@respostas');

Route::resource('usuarios', 'LoginController');
Route::delete('exclusao-usuarios', 'LoginController@destroy');

Route::get('sair', 'SairController@sair');








