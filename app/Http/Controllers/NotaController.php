<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MateriaHasTurma;
use App\Nota;
use Illuminate\Http\Request;
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
        $nota = Nota::findOrFail($id);

        return view('admin.notas.show', compact('nota'));
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
        $nota = Nota::findOrFail($id);

        return view('admin.notas.edit', compact('nota'));
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
        
        $nota = Nota::findOrFail($id);
        $nota->update($requestData);

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
