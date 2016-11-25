<?php

namespace App\Http\Controllers;

use App\Nota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Requests;
use Response;
use Session;
use App\Http\Controllers\Controller;
use App\Avaliacao;
use App\Materia;
use App\MateriaHasProfessor;
use App\MateriaHasTurma;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AvaliacaoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $avaliacoes = Avaliacao::paginate(15);

        return view('admin.avaliacoes.index', compact('avaliacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {

        $materia = MateriaHasProfessor::with('materia')->where('id_professor', Auth::user()->id)->get();
        $materias = $materia->pluck('materia.nome', 'materia.id');

        $turmas = DB::table('materia_has_professor')
                ->select('turmas.id', 'turmas.numero_turma')
                ->join('materia_has_turma', 'materia_has_turma.id_materia_professor', '=', 'materia_has_professor.id')
                ->join('materias', 'materias.id', '=', 'materia_has_professor.id_materia')
                ->join('turmas', 'turmas.id', '=', 'materia_has_turma.id_turma')
                ->where('materia_has_professor.id_professor', '=', Auth::user()->id)
                ->where('materia_has_professor.id_materia', '=', key(head($materias)))
                ->pluck('turmas.numero_turma', 'turmas.id');

        return view('admin.avaliacoes.create', compact('materias', 'turmas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request) {

        Avaliacao::create($request->all());

        Session::flash('success', 'Avaliacao added!');

        return redirect('admin/avaliacoes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $avaliaco = Avaliacao::with('materias', 'turmas', 'professores.pessoa')->findOrFail($id);

        //dd($avaliaco);

        return view('admin.avaliacoes.show', compact('avaliaco'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $avaliaco = Avaliacao::findOrFail($id);
        $materia = MateriaHasProfessor::with('materia')->where('id_professor', Auth::user()->id)->get();
        $materias = $materia->pluck('materia.nome', 'materia.id');

        $turmas = \App\MateriaHasProfessor::join('materia_has_turma', 'materia_has_professor.id', '=', 'materia_has_turma.id_materia_professor')
            ->join('turmas', 'turmas.id', '=', 'materia_has_turma.id_turma')
            ->where('materia_has_professor.id_materia', '=', $avaliaco->id_materia)
            ->where('materia_has_professor.id_professor', '=', Auth::user()->id)
            ->lists('turmas.numero_turma', 'turmas.id');

        return view('admin.avaliacoes.edit', compact('avaliaco', 'materias', 'turmas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request) {

        $avaliaco = Avaliacao::findOrFail($id);
        $avaliaco->update($request->all());

        Session::flash('success', 'Avaliacao updated!');

        return redirect('admin/avaliacoes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function destroy($id) {
        Nota::where('id_avaliacao', '=', $id)->delete();

        Avaliacao::destroy($id);

        Session::flash('success', 'Avaliacao deleted!');

        return redirect('admin/avaliacoes');
    }

    /**
     * Return a new JSON response from turmas.
     *
     * @param Request $request
     * @return Response
     * @static
     */
    public function getTurmas(Request $request) {
        if ($request->ajax() && $request->has('id_materia')) {
            $materias = \App\MateriaHasProfessor::join('materia_has_turma', 'materia_has_professor.id', '=', 'materia_has_turma.id_materia_professor')
                ->join('turmas', 'turmas.id', '=', 'materia_has_turma.id_turma')
                ->where('materia_has_professor.id_materia', '=', $request->only('id_materia'))
                ->where('materia_has_professor.id_professor', '=', Auth::user()->id)
                ->lists('turmas.id', 'turmas.numero_turma');

            return Response::json(array("success" => "true", "materias" => $materias));
        } else {
            return Response::json(array("success" => "false", 'mensagem' => 'Houve um erro ao buscar as turmas'));
        }
    }

}
