<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Feriado;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class FeriadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $feriados = Feriado::paginate(15);

        return view('admin.feriados.index', compact('feriados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.feriados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        Feriado::create($request->all());

        Session::flash('success', 'Feriado added!');

        return redirect('admin/feriados');
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
        $feriado = Feriado::findOrFail($id);

        return view('admin.feriados.show', compact('feriado'));
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
        $feriado = Feriado::findOrFail($id);

        return view('admin.feriados.edit', compact('feriado'));
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
        
        $feriado = Feriado::findOrFail($id);
        $feriado->update($request->all());

        Session::flash('success', 'Feriado updated!');

        return redirect('admin/feriados');
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
        Feriado::destroy($id);

        Session::flash('success', 'Feriado deleted!');

        return redirect('admin/feriados');
    }
}
