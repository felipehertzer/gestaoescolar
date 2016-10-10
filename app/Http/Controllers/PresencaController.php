<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MateriaHasProfessor;
use App\MateriaHasTurma;
use App\Presenca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PresencaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $value = 1;
        $presencas = MateriaHasTurma::with('materia_has_professor', 'materia_has_professor.materia', 'turma')->whereHas('materia_has_professor', function($q) use($value) {
            $q->where('id_professor', '=', $value);
        })->paginate(25);
        return view('admin.presencas.index', compact('presencas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        $presenca = Aluno::with('pessoa','matricula', 'matricula.turma', 'matricula.turma.materia_has_turma')->whereHas('matricula.turma.materia_has_turma', function($q) use($id) {
            $q->where('id_materia_professor', '=', $id);
        })->get();
        return view('admin.presencas.create', compact('presenca', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        foreach($request->only('presenca')['presenca'] as $matricula => $presenca){
            Presenca::create(['data' => $request->input('data'), 'presenca' => $presenca == "1" ? "presente" : "falta", 'id_matricula' => $matricula, 'id_materia_professor' => $request->input('identificador') ]);
        }

        Session::flash('success', 'Presenca added!');
        return redirect('admin/presencas');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $presencas = Presenca::where(function ($query) use ($id) {
            return $query->where('id_materia_professor', '=', $id);
        })->select('*', DB::raw('SUM(if(presenca = "presente", 1, 0)) as presentes, SUM(if(presenca = "falta", 1, 0)) as faltantes'))->groupBy('data')->paginate(15);
        return view('admin.presencas.show', compact('presencas', 'id'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $presenca = Aluno::with('pessoa','matricula', 'matricula.turma', 'matricula.turma.materia_has_turma')->whereHas('matricula.turma.materia_has_turma', function($q) use($id) {
            $q->where('id_materia_professor', '=', $id);
        })->get();
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
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $presenca = Presenca::findOrFail($id);
        $presenca->update($requestData);

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
    public function destroy($id)
    {
        Presenca::destroy($id);

        Session::flash('flash_message', 'Presenca deleted!');

        return redirect('admin/presencas');
    }
}
