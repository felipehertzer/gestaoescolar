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
        return view('admin/biblioteca.multas.create', compact('tipomultas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {

        $requestData = $request->all();

        Multa::create($requestData);

        Session::flash('success', 'Multa added!');

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

        return view('admin/biblioteca.multas.edit', compact('multa', 'tipomultas'));
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

        $multa = Multa::findOrFail($id);
        $multa->update($requestData);

        Session::flash('success', 'Multa updated!');

        return redirect('admin/biblioteca/multas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Multa::destroy($id);

        Session::flash('success', 'Multa deleted!');

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

        return redirect('admin/biblioteca/multas/' . $id);
    }

}
