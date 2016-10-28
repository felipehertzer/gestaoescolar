<?php

namespace App\Http\Controllers\Biblioteca;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Reserva;
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
        $matriculas = \App\Matricula::select('matriculas.id', 'pessoas.nome')
                ->join('alunos', 'alunos.id', '=', 'matriculas.id_aluno')
                ->join('pessoas', 'pessoas.id', '=', 'alunos.id_pessoas')
                ->lists('pessoas.nome', 'matriculas.id');


        $exemplares = \App\Exemplar::select("exemplares.id"
                        , DB::raw("CONCAT('L:', livros.nome,' - Ex:', exemplares.id) as full_name"))
                ->join('livros', 'livros.id', '=', 'exemplares.livro_id')
                ->where('exemplares.status', \App\Exemplar::STATUS_DISPONIVEL)
                ->lists('full_name', 'exemplares.id');
        
        return view('admin/biblioteca.reservas.create', compact('matriculas', 'exemplares'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {
		try{
			$requestData = $request->all();

			Reserva::create($requestData);

			Session::flash('success', 'Reserva added!');
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
        }
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
		try{
			$requestData = $request->all();

			$reserva = Reserva::findOrFail($id);
			$reserva->update($requestData);

			Session::flash('success', 'Reserva updated!');

			return redirect('admin/biblioteca/reservas');
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());   
			return redirect('admin/biblioteca/reservas/' . $id . '/edit');
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
		try{
			Reserva::destroy($id);

			Session::flash('success', 'Reserva deleted!');
		} catch (\Exception $ex) {
			Session::flash('danger', $ex->getMessage());
		}
        return redirect('admin/biblioteca/reservas');
    }

}
