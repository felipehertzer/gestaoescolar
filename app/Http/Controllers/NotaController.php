<?php

namespace App\Http\Controllers;

use App\Avaliacao;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\MateriaHasTurma;
use App\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class NotaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {

        $notas = DB::table('materia_has_professor')
                ->select('materia_has_turma.id', 'materias.nome', 'turmas.ano', 'turmas.numero_turma')
                ->join('materia_has_turma', 'materia_has_turma.id_materia_professor', '=', 'materia_has_professor.id')
                ->join('materias', 'materias.id', '=', 'materia_has_professor.id_materia')
                ->join('turmas', 'turmas.id', '=', 'materia_has_turma.id_turma')
                ->where('materia_has_professor.id_professor', '=', Auth::user()->id)
                ->paginate(15);

        return view('admin.notas.index', compact('notas'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $avaliacoes = DB::table('materia_has_turma')
                ->join('materia_has_professor', 'materia_has_turma.id_materia_professor', '=', 'materia_has_professor.id')
                ->join('avaliacoes', function($join) {
                    $join->on('materia_has_professor.id_materia', '=', 'avaliacoes.id_materia');
                    $join->on('materia_has_professor.id_professor', '=', 'avaliacoes.id_professor');
                    $join->on('materia_has_turma.id_turma', '=', 'avaliacoes.id_turma');
                })
                ->where('materia_has_turma.id', '=', $id)
                ->where('materia_has_professor.id_professor', '=', Auth::user()->id)
                ->paginate(15);
        return view('admin.notas.show', compact('avaliacoes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $alunos = DB::table('avaliacoes')
                ->select('matriculas.id', 'pessoas.nome', 'nota')
                ->join('matriculas', 'matriculas.id_turma', '=', 'avaliacoes.id_turma')
                ->join('alunos', 'alunos.id', '=', 'matriculas.id_aluno')
                ->join('pessoas', 'pessoas.id', '=', 'alunos.id_pessoas')
                ->join('materia_has_professor', 'materia_has_professor.id_materia', '=', 'avaliacoes.id_materia')
                ->leftjoin('notas', function($join) {
                    $join->on('notas.id_avaliacao', '=', 'avaliacoes.id');
                    $join->on('notas.id_matricula', '=', 'matriculas.id');
                })
                ->where('avaliacoes.id', '=', $id)
                ->where('materia_has_professor.id_professor', '=', Auth::user()->id)
                ->get();
        //dd($alunos);
        return view('admin.notas.edit', compact('alunos', 'id'));
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
        Nota::where('id_avaliacao', '=', $id)->delete();

        foreach ($request->only('notas')['notas'] as $matricula => $nota) {
            Nota::create(['id_avaliacao' => $id, 'id_matricula' => $matricula, 'nota' => $nota]);
        }

        Session::flash('success', 'Nota updated!');

        return redirect('admin/notas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Nota::destroy($id);

        Session::flash('success', 'Nota deleted!');

        return redirect('admin/notas');
    }

}
