<?php

namespace App\Http\Controllers\Biblioteca;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Multa;
use App\TipoMulta;
use Illuminate\Http\Request;
use Session;

class MultaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $multas = Multa::paginate(25);

        return view('admin/biblioteca.multas.index', compact('multas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $tipomultas = TipoMulta::pluck('nome', 'id');        
        $matriculas = \App\Matricula::select('matriculas.id', 'pessoas.nome')
                ->join('alunos', 'alunos.id', '=', 'matriculas.id_aluno')
                ->join('pessoas', 'pessoas.id', '=', 'alunos.id_pessoas')
                ->lists('pessoas.nome', 'matriculas.id');
        
        return view('admin/biblioteca.multas.create', compact('tipomultas', 'matriculas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {
		try {
			$requestData = $request->all();

			Multa::create($requestData);

			Session::flash('success', 'Multa adicionada!');
			
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
        }

		return redirect('admin/biblioteca/multas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $multa = Multa::findOrFail($id);

        return view('admin/biblioteca.multas.show', compact('multa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $multa = Multa::findOrFail($id);
        $tipomultas = TipoMulta::pluck('nome', 'id');
        $matriculas = \App\Matricula::select('matriculas.id', 'pessoas.nome')
                ->join('alunos', 'alunos.id', '=', 'matriculas.id_aluno')
                ->join('pessoas', 'pessoas.id', '=', 'alunos.id_pessoas')
                ->lists('pessoas.nome', 'matriculas.id');

        return view('admin/biblioteca.multas.edit', compact('multa', 'tipomultas', 'matriculas'));
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
		try {
			$requestData = $request->all();

			$multa = Multa::findOrFail($id);
			$multa->update($requestData);

			Session::flash('success', 'Multa atualizada!');

			return redirect('admin/biblioteca/multas');
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
            return redirect('admin/biblioteca/multas/' . $id . '/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
		try {
			Multa::destroy($id);

			Session::flash('success', 'Multa removida!');
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
        }

        return redirect('admin/biblioteca/multas');
    }

    /**
     * Funcao para pagar a multa
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function pagar_multa($id) {
        try {
            Multa::pagarMulta($id);
            Session::flash('success', 'Multa paga com sucesso!');
        } catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
        }

        return redirect('admin/biblioteca/multas');
    }

}
