<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Matricula;
use Illuminate\Http\Request;
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
        $matriculas = Matricula::paginate(25);

        return view('admin.matriculas.index', compact('matriculas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.matriculas.create');
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
        
        Matricula::create($requestData);

        Session::flash('success', 'Matricula added!');

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

        return view('admin.matriculas.edit', compact('matricula'));
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
        
        $matricula = Matricula::findOrFail($id);
        $matricula->update($requestData);

        Session::flash('success', 'Matricula updated!');

        return redirect('admin/matriculas');
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
        Matricula::destroy($id);

        Session::flash('success', 'Matricula deleted!');

        return redirect('admin/matriculas');
    }
}
