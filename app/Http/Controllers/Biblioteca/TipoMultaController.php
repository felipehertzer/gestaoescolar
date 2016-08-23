<?php

namespace App\Http\Controllers\Biblioteca;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TipoMulta;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class TipoMultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $tipomulta = TipoMulta::paginate(15);

        return view('admin/biblioteca.tipomulta.index', compact('tipomulta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin/biblioteca.tipomulta.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        TipoMulta::create($request->all());

        Session::flash('flash_message', 'TipoMulta added!');

        return redirect('admin/biblioteca/tipomulta');
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
        $tipomultum = TipoMulta::findOrFail($id);

        return view('admin/biblioteca.tipomulta.show', compact('tipomultum'));
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
        $tipomultum = TipoMulta::findOrFail($id);

        return view('admin/biblioteca.tipomulta.edit', compact('tipomultum'));
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
        
        $tipo_multum = TipoMulta::findOrFail($id);
        $tipo_multum->update($request->all());

        Session::flash('flash_message', 'TipoMulta updated!');

        return redirect('admin/biblioteca/tipomulta');
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
        TipoMulta::destroy($id);

        Session::flash('flash_message', 'TipoMulta deleted!');

        return redirect('admin/biblioteca/tipomulta');
    }
}
