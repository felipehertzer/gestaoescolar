<?php

namespace App\Http\Controllers\Biblioteca;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Retirada;
use Illuminate\Http\Request;
use Session;

class RetiradaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $retiradas = Retirada::where('status', '=', Retirada::STATUS_RETIRADO)->paginate(25);

        return view('admin/biblioteca.retiradas.index', compact('retiradas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $matriculas = \App\Matricula::select('matriculas.id', 'pessoas.nome')
                ->join('alunos', 'alunos.id', '=', 'matriculas.id_aluno')
                ->join('pessoas', 'pessoas.id', '=', 'alunos.id_pessoas')
                ->lists('pessoas.nome', 'matriculas.id');


        $exemplares = \App\Exemplar::select("exemplares.id"
                        , DB::raw("CONCAT('L:', livros.nome,' - Ex:', exemplares.id) as full_name"))
                ->join('livros', 'livros.id', '=', 'exemplares.livro_id')
                ->where('exemplares.status', \App\Exemplar::STATUS_DISPONIVEL)
                ->lists('full_name', 'exemplares.id');

        return view('admin/biblioteca.retiradas.create', compact('matriculas', 'exemplares'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {
        $retiradaTag = [];
        $exemplaresEscolhidos = $request->get('exemplares_escolhidos');
        foreach ($exemplaresEscolhidos as $exemplar) {
            $retiradaTag[] = [
                'exemplar_id' => $exemplar,
                'status' => Retirada::STATUS_RETIRADO
            ];
        }

        $r = Retirada::create($request->except(array('exemplares', 'exemplares_escolhidos')));
        $r->exemplares()->attach($retiradaTag);

        (new \App\Exemplar)->editaStatusParaEmprestado($exemplaresEscolhidos);

        Session::flash('success', 'Retirada added!');

        return redirect('admin/biblioteca/retiradas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $retirada = Retirada::findOrFail($id);

        return view('admin/biblioteca.retiradas.show', compact('retirada'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request) {

        $requestData = $request->all();
        dd($request);

        $retirada = Retirada::findOrFail($id);
        $retirada->update($requestData);

        Session::flash('success', 'Retirada updated!');

        return redirect('admin/biblioteca/retiradas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Retirada::destroy($id);

        Session::flash('success', 'Retirada deleted!');

        return redirect('admin/biblioteca/retiradas');
    }

    /**
     * Faz a devolução completa dos exemplares retirados e seta o registro como Devolvido
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function devolve_tudo($id) {
        $retirada = Retirada::findOrFail($id);
        $exemplares = $retirada->exemplares()->lists('exemplares.id');
        (new \App\RetiradaHasExemplar)->editaStatusParaDevolvido($id, $exemplares);
        (new \App\Exemplar)->editaStatusParaDisponivel($exemplares);
        (new \App\Retirada)->editaStatusParaDevolvido($id);

        Session::flash('success', 'Os Exemplares foram devolvidos com sucesso!');

        return redirect('admin/biblioteca/retiradas');
    }

    /**
     * Lista os exemplares escolhidos na retirada e pode fazer a devolição item por item
     * ******MELHORAR CÓDIGO DEPOIS********* TEM UM POCO DE POG HEHEHEHE
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function devolve_exemplares($id, Request $request) {

        if (!empty($request->all())) {
            $dados = $request->all();
            $RHE = new \App\RetiradaHasExemplar;
            $RHE->editaStatusParaDevolvido($id, $dados['exemplares_devolvidos']);
            (new \App\Exemplar)->editaStatusParaDisponivel($dados['exemplares_devolvidos']);
            
            if($RHE->todosExemplaresForamDevolvidos($id)) {
                (new \App\Retirada)->editaStatusParaDevolvido($id);
            }
            
            Session::flash('success', 'Os Exemplares foram devolvidos com sucesso!');

            return redirect('admin/biblioteca/retiradas');
        }

        $retirada = Retirada::findOrFail($id);

        $IdsExemplaresRetirados = $retirada->exemplares()->where('retirada_has_exemplares.status', '=', Retirada::STATUS_RETIRADO)->lists('exemplares.id');
        $IdsExemplaresDevolvidos = $retirada->exemplares()->where('retirada_has_exemplares.status', '=', Retirada::STATUS_DEVOLVIDO)->lists('exemplares.id');

        $exemplaresRetirados = \App\Exemplar::select("exemplares.id"
                        , DB::raw("CONCAT('L:', livros.nome,' - Ex:', exemplares.id) as full_name"))
                ->join('livros', 'livros.id', '=', 'exemplares.livro_id')
                ->whereIn('exemplares.id', $IdsExemplaresRetirados)
                ->lists('full_name', 'exemplares.id');
        
        $exemplaresDevolvidos = \App\Exemplar::select("exemplares.id"
                        , DB::raw("CONCAT('L:', livros.nome,' - Ex:', exemplares.id) as full_name"))
                ->join('livros', 'livros.id', '=', 'exemplares.livro_id')
                ->whereIn('exemplares.id', $IdsExemplaresDevolvidos)
                ->lists('full_name', 'exemplares.id');     

        return view('admin/biblioteca.retiradas.devolve_exemplares', compact('retirada', 'exemplaresRetirados', 'exemplaresDevolvidos'));
    }

}
