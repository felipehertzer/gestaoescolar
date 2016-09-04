<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('admin/materias', 'MateriaController');

Route::resource('admin/salas', 'SalaController');

Route::resource('admin/pessoas', 'PessoaController');

Route::resource('admin/biblioteca/autores', 'Biblioteca\\AutorController');

Route::resource('admin/biblioteca/tipomulta', 'Biblioteca\\TipoMultaController');

Route::resource('admin/biblioteca/tipoexemplares', 'Biblioteca\\TipoExemplarController');

Route::resource('admin/tipomateriais', 'TipoMateriaisController');

Route::resource('admin/funcoes', 'FuncaoController');

Route::resource('admin/feriados', 'FeriadoController');

Route::resource('admin/series', 'SerieController');

Route::resource('admin/biblioteca/livros', 'Biblioteca\\LivroController');