<?php

namespace App\Http\Controllers;

use App\Avaliacao;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MateriaHasTurma;
use App\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class NotaController extends Controller
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
        $notas = MateriaHasTurma::with('materia_has_professor', 'materia_has_professor.materia', 'turma')->whereHas('materia_has_professor', function($q) use($value) {
            $q->where('id_professor', '=', $value);
        })->paginate(25);

        return view('admin.notas.index', compact('notas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.notas.create');
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
        
        $requestData = $request->all();
        
        Nota::create($requestData);

        Session::flash('success', 'Nota added!');

        return redirect('admin/notas');
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
        $avaliacoes = DB::table('avaliacoes')
            ->select('avaliacoes.nome', 'peso', 'trimestre', 'tipo', 'avaliacoes.id')
            ->join('materia_has_professor', function($join) {
                $join->on('materia_has_professor.id_materia', '=', 'avaliacoes.id_materia');
                $join->on('materia_has_professor.id_professor','=', 'avaliacoes.id_professor');
            })
            ->join('materias', 'materias.id', '=', 'avaliacoes.id_materia')
            ->where('avaliacoes.id_materia', '=', $id) // id_professor = session id_professor
            ->paginate(15);
        //dd($avaliacoes);
        return view('admin.notas.show', compact('avaliacoes'));
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
        $alunos = DB::table('avaliacoes')
            ->select('matriculas.id', 'pessoas.nome', 'nota')
            ->join('matriculas', 'matriculas.id_turma', '=', 'avaliacoes.id_turma')
            ->join('alunos', 'alunos.id', '=', 'matriculas.id_aluno')
            ->join('pessoas', 'pessoas.id', '=', 'alunos.id_pessoas')
            ->join('notas', function($join){
                $join->on('notas.id_avaliacao', '=', 'avaliacoes.id');
                $join->on('notas.id_matricula','=', 'matriculas.id_aluno');
            })
            ->where('avaliacoes.id', '=', $id)
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
    public function update($id, Request $request)
    {
        Nota::where('id_avaliacao', '=', $id)->delete();

        foreach($request->only('notas')['notas'] as $matricula => $nota){
            Nota::create(['id_avaliacao' => $id , 'id_matricula' => $matricula, 'nota' => $nota]);
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
    public function destroy($id)
    {
        Nota::destroy($id);

        Session::flash('success', 'Nota deleted!');

        return redirect('admin/notas');
    }
}
