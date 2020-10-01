<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login.ad');
});

Route::get('login-laravel', 'HomeController@index')->name('admin-login');

Route::get('login', 'LoginADController@index');
Route::post('login-ad', 'LoginADController@auth_ad');

Route::resource('empresas', 'EmpresasController');
Route::resource('mensagens', 'EmpresasController');

Route::resource('usuarios', 'LoginController');
Route::delete('exclusao-usuarios', 'LoginController@destroy');

Route::get('sair', 'SairController@sair');

Route::resource('campanhas', 'CampanhaController');

Route::get('opcoes', 'OpcoesController@index');
Route::post('opcoes', 'OpcoesController@store')->name('opcoes');
Route::post('salvar_opcoes', 'OpcoesController@salvar');

Route::delete('campanhas', 'ControllerCampanha@destroy');

Route::resource('importar', 'CampanhaRespondenteController');
Route::resource('perguntas', 'PerguntaController');
Route::resource('tipo', 'TipoRespostaController');

Route::get('dados/excluir/{empresa_id}', 'DadosController@destroy');

Route::get('perguntas/{campanha_id}/create', 'PerguntaController@create');
Route::post('import/{campanha_id}', 'CampanhaRespondenteController@update');

Route::post('perguntas/reorder', 'PerguntaController@reorder')->name('admin.perguntas.reorder');

Route::get('resposta', 'RespostaController@edit');

Route::get('relatorios', 'RelatorioController@index');
Route::get('relatorios/{campanha_id}', 'RelatorioController@show');
Route::get('relatorios/{pergunta_id}/detalhe','RelatorioController@detalhe');
Route::get('relatorios/{pergunta_id}/{respodente_id}', 'RelatorioController@respostas');

Route::patch('resposta', 'RespostaController@update');

Route::get('responder/{campanha_id}/{respondente_id}', 'RespostaController@login');





