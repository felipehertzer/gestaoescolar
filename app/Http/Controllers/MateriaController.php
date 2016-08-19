<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Materia;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $materias = Materia::paginate(15);

        return view('admin.materias.index', compact('materias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.materias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        Materia::create($request->all());

        Session::flash('flash_message', 'Materia added!');

        return redirect('admin/materias');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
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
     * @return void
     */
    public function edit($id)
    {
        $materia = Materia::findOrFail($id);

        return view('admin.materias.edit', compact('materia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        
        $materia = Materia::findOrFail($id);
        $materia->update($request->all());

        Session::flash('flash_message', 'Materia updated!');

        return redirect('admin/materias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        Materia::destroy($id);

        Session::flash('flash_message', 'Materia deleted!');

        return redirect('admin/materias');
    }
}
