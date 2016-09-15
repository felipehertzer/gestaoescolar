<?php

namespace App\Http\Controllers;

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



class AvaliacaoController extends Controller
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
        $avaliacoes = Avaliacao::paginate(15);

        return view('admin.avaliacoes.index', compact('avaliacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $materia = MateriaHasProfessor::with('materia')->where('id_professor', 1)->get();
        $materias = $materia->pluck('materia.nome','id');
        return view('admin.avaliacoes.create', compact('materias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        
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
    public function show($id)
    {
        $avaliaco = Avaliacao::findOrFail($id);

        return view('admin.avaliacoes.show', compact('avaliaco'));
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
        $avaliaco = Avaliacao::findOrFail($id);
        $materia = MateriaHasProfessor::with('materia')->where('id_professor', 1)->get();
        $materias = $materia->pluck('materia.nome','id');

        return view('admin.avaliacoes.edit', compact('avaliaco', 'materias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        
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
    public function destroy($id)
    {
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
    public function getTurmas(Request $request)
    {
        if($request->ajax() && $request->has('id_materia')) {
            $materia = MateriaHasTurma::with('turma')->where('id_materia_professor', $request->only('id_materia'))->get();
            $materias = $materia->pluck('turma.id', 'turma.numero_turma');
            return Response::json(array("success" => "true", "materias" => $materias));
        } else {
            return Response::json(array("success" => "false", 'mensagem' => 'Houve um erro ao buscar as turmas'));
        }
    }
}
