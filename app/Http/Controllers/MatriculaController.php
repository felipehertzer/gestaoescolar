<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Matricula;
use App\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;
use Session;

class MatriculaController extends Controller
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
        $matriculas = DB::table('matriculas')
            ->select('pessoas.nome', 'turmas.numero_turma', 'matriculas.observacoes', 'matriculas.id')
            ->join('alunos', 'alunos.id', '=', 'matriculas.id_aluno')
            ->join('pessoas', 'pessoas.id', '=', 'alunos.id_pessoas')
            ->join('turmas', 'turmas.id', '=', 'matriculas.id_turma')
            ->paginate(15);
        //dd($matriculas);
        return view('admin.matriculas.index', compact('matriculas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $aluno = Aluno::with('pessoa')->get();
        $alunos = $aluno->pluck('pessoa.nome','id');
        $turmas = Turma::pluck('numero_turma','id');
        return view('admin.matriculas.create', compact('alunos', 'turmas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try { 
			$requestData = $request->all();			
			Matricula::create($requestData);
			Session::flash('success', 'Matricula adicionada!');
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
        }
		return redirect('admin/matriculas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $matricula = Matricula::findOrFail($id);

        return view('admin.matriculas.show', compact('matricula'));
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
        $matricula = Matricula::findOrFail($id);
        $aluno = Aluno::with('pessoa')->get();
        $alunos = $aluno->pluck('pessoa.nome','id');
        $turmas = Turma::pluck('numero_turma','id');

        return view('admin.matriculas.edit', compact('matricula', 'alunos', 'turmas'));
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
        try {  
			$requestData = $request->all();	
			
			$matricula = Matricula::findOrFail($id);
			$matricula->update($requestData);

			Session::flash('success', 'Matricula atualizada!');
			return redirect('admin/matriculas');
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());   
			return redirect('admin/matriculas/' . $id . '/edit');
        }
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
		try {
			Matricula::destroy($id);
			Session::flash('success', 'Matricula removida!');
		} catch (\Exception $ex) {
			Session::flash('danger', $ex->getMessage());
		}
        return redirect('admin/matriculas');
    }
}
