<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Materia;
use App\Pessoa;
use App\Professor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Session;

class MateriaController extends Controller
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
        $materias = Materia::paginate(15);

        return view('admin.materias.index', compact('materias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $collection = collect(
            DB::table('pessoas')
                ->select('professores.id', 'pessoas.nome')
                ->join('professores', 'pessoas.id', '=', 'professores.id_pessoas')
                ->get()
        );

        $professores = $collection->pluck('nome', 'id');

        return view('admin.materias.create', compact('professores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $m = Materia::create($request->except(array('professores','professores_escolhidos')));
        $m->professor()->attach($request->get('professores_escolhidos'));
        Session::flash('success', 'Materia added!');

        return redirect('admin/materias');
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
        $materia = Materia::findOrFail($id);

        return view('admin.materias.show', compact('materia'));
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
        $materia = Materia::findOrFail($id);

        $collection = collect(
            DB::table('pessoas')
                ->select('professores.id', 'pessoas.nome')
                ->join('professores', 'pessoas.id', '=', 'professores.id_pessoas')
                ->get()
        );
        $professores = $collection->pluck('nome', 'id');
        $professores_escolhidos = array();
        //dd($professores_escolhidos);
        return view('admin.materias.edit', compact('materia', 'professores', 'professores_escolhidos'));
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
        
        $materia = Materia::findOrFail($id);
        $materia->update($request->except(array('professores','professores_escolhidos')));
        $materia->professor()->detach($request->get('professores'));
        $materia->professor()->attach($request->get('professores_escolhidos'));
        Session::flash('success', 'Materia updated!');

        return redirect('admin/materias');
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
        Materia::destroy($id);

        Session::flash('success', 'Materia deleted!');

        return redirect('admin/materias');
    }
}
