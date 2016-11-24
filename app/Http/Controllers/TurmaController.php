<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Materia;
use App\MateriaHasProfessor;
use App\MateriaHasTurma;
use App\Sala;
use App\Serie;
use App\Turma;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\DB;

class TurmaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $turmas = Turma::paginate(15);
        return view('admin.turmas.index', compact('turmas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $salas = Sala::pluck('numero', 'id');
        $series = Serie::pluck('nome', 'id');
        //$materia = MateriaHasProfessor::with('professor', 'materia', 'professor.pessoa')->get();
        //$materias = Materia::pluck("ProfessorMateria", "id");
        $materias = \App\Materia::select("materia_has_professor.id"
                        , DB::raw("CONCAT('', materias.nome,' - ', pessoas.nome) as full_name"))
                ->join('materia_has_professor', 'materia_has_professor.id_materia', '=', 'materias.id')
                ->join('professores', 'professores.id', '=', 'materia_has_professor.id_professor')
                ->join('pessoas', 'pessoas.id', '=', 'professores.id_pessoas')
                ->lists('full_name', 'materia_has_professor.id');

        return view('admin.turmas.create', compact('salas', 'series', 'materias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request) {

        $t = Turma::create($request->except(array("materias", "materias_escolhidas")));

        $t->materia()->attach($request->get('materias_escolhidas'));

        Session::flash('success', 'Turma adicionada!');

        return redirect('admin/turmas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $turma = Turma::findOrFail($id);

        return view('admin.turmas.show', compact('turma'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $turma = Turma::findOrFail($id);
        $salas = Sala::pluck('numero', 'id');
        $series = Serie::pluck('nome', 'id');
        //$materia = MateriaHasProfessor::with('professor', 'materia', 'professor.pessoa')->get();
        //$materias = $materia->pluck("ProfessorMateria", "id");
        //$materias_escolhidas = $turma->getMateriasIdsAttribute();

        $materias = \App\Materia::select("materia_has_professor.id"
                        , DB::raw("CONCAT('', materias.nome,' - ', pessoas.nome) as full_name"))
                ->join('materia_has_professor', 'materia_has_professor.id_materia', '=', 'materias.id')
                ->join('professores', 'professores.id', '=', 'materia_has_professor.id_professor')
                ->join('pessoas', 'pessoas.id', '=', 'professores.id_pessoas')
                ->lists('full_name', 'materia_has_professor.id');
        $materias_escolhidas = \App\MateriaHasTurma::select("materia_has_professor.id"
                        , DB::raw("CONCAT('', materias.nome,' - ', pessoas.nome) as full_name"))
                ->join('materia_has_professor', 'materia_has_professor.id', '=', 'materia_has_turma.id_materia_professor')
                ->join('materias', 'materias.id', '=', 'materia_has_professor.id_materia')
                ->join('professores', 'professores.id', '=', 'materia_has_professor.id_professor')
                ->join('pessoas', 'pessoas.id', '=', 'professores.id_pessoas')
                ->where('materia_has_turma.id_turma', $id)
                ->lists('full_name', 'materia_has_professor.id');

        return view('admin.turmas.edit', compact('salas', 'series', 'turma', 'materias', 'materias_escolhidas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request) {

        $turma = Turma::findOrFail($id);

        $materias_turma = (new \App\MateriaHasTurma)->where('id_turma', '=', $id)->lists('id');
        if ($materias_turma->first()) {
            DB::table('materia_has_turma')->whereIn('id', $materias_turma)->delete();
        }

        $turma->update($request->except(array('materias', 'materias_escolhidas')));

        $turma->materia()->detach($request->get('materias'));

        $turma->materia()->attach($request->get('materias_escolhidas'));

        Session::flash('success', 'Turma atualizada!');

        return redirect('admin/turmas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function destroy($id) {
        Turma::destroy($id);

        Session::flash('success', 'Turma deleted!');

        return redirect('admin/turmas');
    }

}
