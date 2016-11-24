<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Advertencia;
use Illuminate\Http\Request;
use Session;

class AdvertenciaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $advertencias = Advertencia::paginate(25);

        return view('admin.advertencias.index', compact('advertencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $aluno = Aluno::with('pessoa')->get();
        $alunos = $aluno->pluck('pessoa.nome', 'id');
        return view('admin.advertencias.create', compact('alunos'));
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

            Advertencia::create($requestData);

			Session::flash('success', 'Advertencia adicionada!');
        } catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
        }
        return redirect('admin/advertencias');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $advertencia = Advertencia::findOrFail($id);

        return view('admin.advertencias.show', compact('advertencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $advertencia = Advertencia::findOrFail($id);
        $aluno = Aluno::with('pessoa')->get();
        $alunos = $aluno->pluck('pessoa.nome', 'id');

        return view('admin.advertencias.edit', compact('advertencia', 'alunos'));
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

            $advertencia = Advertencia::findOrFail($id);
            $advertencia->update($requestData);

			Session::flash('success', 'Advertencia atualizada!');

            return redirect('admin/advertencias');
        } catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
            return redirect('admin/advertencias/' . $id . '/edit');
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
            Advertencia::destroy($id);
			Session::flash('success', 'Advertencia removida!');
        } catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
        }
        return redirect('admin/advertencias');
    }

}
