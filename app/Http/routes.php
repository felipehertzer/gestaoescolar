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

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if(Auth::user())
        return Redirect::to('home');

    return view('welcome');
});
Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('admin/materias', 'MateriaController');

Route::resource('admin/salas', 'SalaController');

Route::resource('admin/pessoas', 'PessoaController');

Route::resource('admin/tipomateriais', 'TipoMateriaisController');

Route::resource('admin/funcoes', 'FuncaoController');

Route::resource('admin/feriados', 'FeriadoController');

Route::resource('admin/series', 'SerieController');

Route::resource('admin/turmas', 'TurmaController');

Route::resource('admin/materiais', 'MaterialController');

Route::resource('admin/advertencias', 'AdvertenciaController');

Route::resource('admin/avaliacoes', 'AvaliacaoController');

Route::post('admin/avaliacoes/{id}/get-turmas', ['uses' =>'AvaliacaoController@getTurmas']);

Route::post('admin/avaliacoes/get-turmas', ['uses' =>'AvaliacaoController@getTurmas']);

Route::resource('admin/listaespera', 'ListaEsperaController');

Route::resource('admin/notas', 'NotaController');

Route::resource('admin/presencas', 'PresencaController');

Route::get('admin/presencas/{id}', 'PresencaController@show');

Route::get('admin/presencas/{id}/create', 'PresencaController@create');

Route::resource('admin/matriculas', 'MatriculaController');

Route::resource('admin/emprestamateriais', 'EmprestaMateriaisController');

Route::resource('admin/biblioteca/autores', 'Biblioteca\\AutorController');

Route::resource('admin/biblioteca/tipomulta', 'Biblioteca\\TipoMultaController');

Route::resource('admin/biblioteca/tipoexemplares', 'Biblioteca\\TipoExemplarController');

Route::resource('admin/biblioteca/exemplares', 'Biblioteca\\ExemplarController');

Route::resource('admin/biblioteca/livros', 'Biblioteca\\LivroController');

Route::resource('admin/biblioteca/multas', 'Biblioteca\\MultaController');

Route::resource('admin/biblioteca/multas/{id}/pagar_multa', 'Biblioteca\\MultaController@pagar_multa');

Route::resource('admin/biblioteca/reservas', 'Biblioteca\\ReservaController');

Route::resource('admin/biblioteca/retiradas', 'Biblioteca\\RetiradaController');

Route::resource('admin/biblioteca/retiradas/{id}/devolve_tudo', 'Biblioteca\\RetiradaController@devolve_tudo');

Route::resource('admin/biblioteca/retiradas/{id}/devolve_exemplares', 'Biblioteca\\RetiradaController@devolve_exemplares');

Route::resource('admin/biblioteca/retiradas/{id}/renovar', 'Biblioteca\\RetiradaController@renovar');

Route::resource('admin/emprestamateriais/{id}/devolve', 'EmprestaMateriaisController@devolve');

Route::resource('admin/biblioteca/reservas/{id}/retirou_exemplares', 'Biblioteca\\ReservaController@retirou_exemplares');

Route::resource('admin/relatorios/livros_mais_retirados', 'RelatorioController@livros_mais_retirados');

Route::resource('admin/relatorios/alunos_mais_retiram_livros', 'RelatorioController@alunos_mais_retiram_livros');

Route::resource('admin/relatorios/relacao_presencas', 'RelatorioController@presencas');

Route::resource('admin/relatorios/relacao_notas', 'RelatorioController@notas');

Route::resource('aluno/lista_notas', 'NotaController@notas');

Route::resource('admin/listaespera/{id}/realizar_matricula', 'ListaEsperaController@realizar_matricula');