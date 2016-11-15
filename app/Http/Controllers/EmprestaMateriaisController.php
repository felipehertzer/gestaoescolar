<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\EmprestaMaterial;
use App\Material;
use App\MateriaHasTurma;
use App\Materias;
use Session;

class EmprestaMateriaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$emprestamateriais = EmprestaMaterial::where('status', '=', EmprestaMaterial::STATUS_RETIRADO)->paginate(25);
        return view('admin.emprestamateriais.index', compact('emprestamateriais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$materiais = \App\Material::select("materiais.id", 'materiais.nome')
                ->where('materiais.status', \App\Material::STATUS_DEVOLVIDO)
                ->lists("materiais.nome", 'materiais.id');
				
		$disciplinas = \App\MateriaHasTurma::select("materia_has_turma.id"
                        , DB::raw("CONCAT('T:', turmas.numero_turma,' - D:', materias.nome) as full_name"))
                ->join('materia_has_professor', 'materia_has_professor.id', '=', 'materia_has_turma.id_materia_professor')
                ->join('materias', 'materias.id', '=', 'materia_has_professor.id_materia')
                ->join('turmas', 'turmas.id', '=', 'materia_has_turma.id_turma')
                ->lists('full_name', 'materia_has_turma.id');
		
        return view('admin.emprestamateriais.create', compact('materiais', 'disciplinas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
		EmprestaMaterial::create($request->all());
		(new \App\Material)->editaStatusParaEmprestado($request->get('material_id'));

        Session::flash('success', 'EmprestaMaterial added!');

        return redirect('admin/emprestamateriais');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emprestamateriais = EmprestaMaterial::findOrFail($id);

        return view('admin/emprestamateriais.show', compact('emprestamateriais'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $emprestamateriais = EmprestaMaterial::findOrFail($id);

        return view('admin/emprestamateriais.edit', compact('emprestamateriais'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $emprestamateriais = EmprestaMaterial::findOrFail($id);
        $emprestamateriais->update($request->all());

        Session::flash('success', 'EmprestaMaterial updated!');

        return redirect('admin/emprestamateriais');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EmprestaMaterial::destroy($id);

        Session::flash('success', 'EmprestaMaterial deleted!');

        return redirect('admin/emprestamateriais');
    }
	
	public function devolve($id) {
        DB::beginTransaction();
        try {
            $material = EmprestaMaterial::findOrFail($id);

            (new \App\Material)->editaStatusParaDevolvido($material->material_id);
            (new \App\EmprestaMaterial)->editaStatusParaDisponivel($id);

            DB::commit();
            Session::flash('success', 'O material foi devolvido com sucesso!');
        } catch (\Exception $ex) {
            DB::rollback();
            Session::flash('danger', $ex->getMessage());
        }

        return redirect('admin/emprestamateriais');
    }
}
