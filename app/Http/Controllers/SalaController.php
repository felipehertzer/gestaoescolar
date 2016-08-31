<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Sala;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $salas = Sala::paginate(15);

        return view('admin.salas.index', compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.salas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        Sala::create($request->all());

        Session::flash('success', 'Sala added!');

        return redirect('admin/salas');
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
        $sala = Sala::findOrFail($id);

        return view('admin.salas.show', compact('sala'));
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
        $sala = Sala::findOrFail($id);

        return view('admin.salas.edit', compact('sala'));
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
        
        $sala = Sala::findOrFail($id);
        $sala->update($request->all());

        Session::flash('success', 'Sala updated!');

        return redirect('admin/salas');
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
        Sala::destroy($id);

        Session::flash('success', 'Sala deleted!');

        return redirect('admin/salas');
    }
}
