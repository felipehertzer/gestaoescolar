<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Turma;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class TurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $turmas = Turma::paginate(15);

        return view('admin.turmas.index', compact('turmas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.turmas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        Turma::create($request->all());

        Session::flash('success', 'Turma added!');

        return redirect('admin/turmas');
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
        $turma = Turma::findOrFail($id);

        return view('admin.turmas.show', compact('turma'));
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
        $turma = Turma::findOrFail($id);

        return view('admin.turmas.edit', compact('turma'));
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
        
        $turma = Turma::findOrFail($id);
        $turma->update($request->all());

        Session::flash('success', 'Turma updated!');

        return redirect('admin/turmas');
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
        Turma::destroy($id);

        Session::flash('success', 'Turma deleted!');

        return redirect('admin/turmas');
    }
}
