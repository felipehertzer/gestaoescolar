<?php

namespace App\Http\Controllers\Biblioteca;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Reserva;
use App\Matricula;
use Illuminate\Http\Request;
use Session;

class ReservaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $reservas = Reserva::paginate(25);

        return view('admin/biblioteca.reservas.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $collection = collect(
                DB::table('matriculas')
                        ->select('matriculas.id', 'pessoas.nome')
                        ->join('alunos', 'alunos.id', '=', 'matriculas.id_aluno')
                        ->join('pessoas', 'pessoas.id', '=', 'alunos.id_pessoas')
                        ->get()
        );
        
        $matriculas = $collection->pluck('nome', 'id');
        return view('admin/biblioteca.reservas.create', compact('matriculas'));
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

        Reserva::create($requestData);

        Session::flash('success', 'Reserva added!');

        return redirect('admin/biblioteca/reservas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $reserva = Reserva::findOrFail($id);

        return view('admin/biblioteca.reservas.show', compact('reserva'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $reserva = Reserva::findOrFail($id);
        $collection = collect(
                DB::table('matriculas')
                        ->select('matriculas.id', 'pessoas.nome')
                        ->join('alunos', 'alunos.id', '=', 'matriculas.id_aluno')
                        ->join('pessoas', 'pessoas.id', '=', 'alunos.id_pessoas')
                        ->get()
        );
        
        $matriculas = $collection->pluck('nome', 'id');

        return view('admin/biblioteca.reservas.edit', compact('reserva', 'matriculas'));
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

        $reserva = Reserva::findOrFail($id);
        $reserva->update($requestData);

        Session::flash('success', 'Reserva updated!');

        return redirect('admin/biblioteca/reservas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Reserva::destroy($id);

        Session::flash('success', 'Reserva deleted!');

        return redirect('admin/biblioteca/reservas');
    }

}
