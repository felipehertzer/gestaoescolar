<?php

namespace App\Http\Controllers\Biblioteca;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Reserva;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;

class ReservaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $reservas = Reserva::where('status', '=', Reserva::STATUS_RESERVADO)->paginate(25);

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
                ->where('exemplares.reservado', '=', 0)
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
        DB::beginTransaction();
        try {
            $dados = $request->all();
            $dataAtual = Carbon::parse(date('Y-m-d'));
            $dados['data_reserva'] = date('Y-m-d');
            $dados['data_agenda'] = $dataAtual->addDays(7);

            $reserva = Reserva::create($dados);
            $reserva->exemplares()->sync($dados['exemplares_escolhidos'], false);
            (new \App\Exemplar)->setExemplaresParaReservado($dados['exemplares_escolhidos']);

            DB::commit();
            Session::flash('success', 'Reserva added!');
        } catch (\Exception $ex) {
            DB::rollback();
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
        $matriculas = \App\Matricula::select('matriculas.id', 'pessoas.nome')
                ->join('alunos', 'alunos.id', '=', 'matriculas.id_aluno')
                ->join('pessoas', 'pessoas.id', '=', 'alunos.id_pessoas')
                ->lists('pessoas.nome', 'matriculas.id');

        $exemplares = \App\Exemplar::select("exemplares.id"
                        , DB::raw("CONCAT('L:', livros.nome,' - Ex:', exemplares.id) as full_name"))
                ->join('livros', 'livros.id', '=', 'exemplares.livro_id')
                ->where('exemplares.reservado', '=', 0)
                ->lists('full_name', 'exemplares.id');

        $exemplares_escolhidos = $reserva->getExemplaresIdsAttribute();

        return view('admin/biblioteca.reservas.edit', compact('reserva', 'matriculas', 'exemplares', 'exemplares_escolhidos'));
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
        DB::beginTransaction();
        try {
            $requestData = $request->all();

            $reserva = Reserva::findOrFail($id);

            $reserva->update($requestData);
            $reserva->exemplares()->sync($request->exemplares_escolhidos);

            (new \App\Exemplar)->setExemplaresParaReservado($request->exemplares_escolhidos);
            (new \App\Exemplar)->setExemplaresParaNaoReservado($request->exemplares);

            DB::commit();
            Session::flash('success', 'Reserva updated!');

            return redirect('admin/biblioteca/reservas');
        } catch (\Exception $ex) {
            DB::rollback();
            Session::flash('danger', $ex->getMessage());
            return redirect('admin/biblioteca/reservas/' . $id . '/edit');
        }
    }

    public function retirou_exemplares($reserva_id) {
        DB::beginTransaction();
        try {
            Reserva::retirouExemplares($reserva_id);
            DB::commit();
            Session::flash('success', 'Exemplares retirados com sucesso!');
        } catch (\Exception $ex) {
            DB::rollback();
            Session::flash('danger', $ex->getMessage());
        }

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
        DB::beginTransaction();
        try {
            $reserva = Reserva::findOrFail($id);
            (new \App\Exemplar)->setExemplaresParaNaoReservado($reserva->exemplares->lists('id')->toArray());

            Reserva::destroy($id);

            DB::commit();
            Session::flash('success', 'Reserva deleted!');
        } catch (\Exception $ex) {
            DB::rollback();
            Session::flash('danger', $ex->getMessage());
        }
        return redirect('admin/biblioteca/reservas');
    }

}
