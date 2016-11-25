<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\MateriaHasProfessor;
use App\MateriaHasTurma;
use App\Presenca;
use App\PresencaHasMatricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PresencaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {

        $presencas = DB::table('materia_has_professor')
                ->select('materia_has_turma.id', 'materias.nome', 'turmas.ano', 'turmas.numero_turma')
                ->join('materia_has_turma', 'materia_has_turma.id_materia_professor', '=', 'materia_has_professor.id')
                ->join('materias', 'materias.id', '=', 'materia_has_professor.id_materia')
                ->join('turmas', 'turmas.id', '=', 'materia_has_turma.id_turma')
                ->where('materia_has_professor.id_professor', '=', Auth::user()->id)
                ->paginate(15);
        //dd($presencas);
        return view('admin.presencas.index', compact('presencas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($id) {
        $presenca = DB::table('pessoas')
                ->select('pessoas.nome', 'matriculas.id')
                ->join('alunos', 'alunos.id_pessoas', '=', 'pessoas.id')
                ->join('matriculas', 'matriculas.id_aluno', '=', 'alunos.id')
                ->join('turmas', 'turmas.id', '=', 'matriculas.id_turma')
                ->join('materia_has_turma', 'turmas.id', '=', 'materia_has_turma.id_turma')
                ->where('materia_has_turma.id', '=', $id)
                ->get();

        return view('admin.presencas.create', compact('presenca', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request) {
        $jaexiste = Presenca::where('data', '=', $request->input('data'))->where('id_materia_turma', '=', $request->input('identificador'))->count();
        if ($jaexiste == 0) {
            $pre = Presenca::create(['data' => $request->input('data'), 'id_materia_turma' => $request->input('identificador')]);
            foreach ($request->only('presenca')['presenca'] as $matricula => $presenca) {
                PresencaHasMatricula::create(['id_presenca' => $pre->id, 'presenca' => $presenca == "1" ? "presente" : "falta", 'id_matricula' => $matricula]);
            }

            Session::flash('success', 'Presenca added!');
        } else {
            Session::flash('danger', 'Já existe uma lista de presença nessa data!');
        }
        return redirect('admin/presencas/' . $request->input('identificador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $presencas = DB::table('presencas')
                ->selectRaw('presencas.*, (SELECT SUM(if(presenca = "presente", 1, 0)) FROM presenca_has_matricula WHERE presenca_has_matricula.id_presenca = presencas.id) as presentes, (SELECT SUM(if(presenca = "falta", 1, 0)) FROM presenca_has_matricula WHERE presenca_has_matricula.id_presenca = presencas.id) as faltantes')
                //->join('presenca_has_matricula', 'presencas.id', '=', 'presenca_has_matricula.id_presenca')
                ->where('id_materia_turma', '=', $id)
                ->paginate(15);
        return view('admin.presencas.show', compact('presencas', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $presenca = collect(
                DB::table('pessoas')
                        ->select('pessoas.nome', 'matriculas.id', 'presenca_has_matricula.presenca', 'presencas.data', 'presencas.id as id_presenca')
                        ->join('alunos', 'pessoas.id', '=', 'alunos.id_pessoas')
                        ->join('matriculas', 'alunos.id', '=', 'matriculas.id_aluno')
                        ->join('turmas', 'matriculas.id_turma', '=', 'turmas.id')
                        ->join('materia_has_turma', 'materia_has_turma.id_turma', '=', 'turmas.id')
                        ->join('presencas', 'materia_has_turma.id', '=', 'presencas.id_materia_turma')
                        ->join('presenca_has_matricula', function($join) {
                            $join->on('presenca_has_matricula.id_presenca', '=', 'presencas.id');
                            $join->on('presenca_has_matricula.id_matricula', '=', 'matriculas.id');
                        })
                        ->where('presencas.id', '=', $id)
                        ->get()
        );
        //dd($presenca);
        return view('admin.presencas.edit', compact('presenca'));
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

        PresencaHasMatricula::where('id_presenca', '=', $id)->delete();

        foreach ($request->only('presenca')['presenca'] as $matricula => $presenca) {
            PresencaHasMatricula::create(['id_presenca' => $id, 'presenca' => $presenca == "1" ? "presente" : "falta", 'id_matricula' => $matricula]);
        }

        Session::flash('flash_message', 'Presenca updated!');

        return redirect('admin/presencas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Presenca::destroy($id);

        Session::flash('flash_message', 'Presenca deleted!');

        return redirect('admin/presencas');
    }

}
