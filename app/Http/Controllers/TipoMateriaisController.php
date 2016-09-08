<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TipoMaterial;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class TipoMateriaisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $tipomateriais = TipoMaterial::paginate(15);

        return view('admin/tipomateriais.index', compact('tipomateriais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin/tipomateriais.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {

        TipoMaterial::create($request->all());

        Session::flash('success', 'TipoMateriais added!');

        return redirect('admin/tipomateriais');
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
        $tipo_materiai = TipoMaterial::findOrFail($id);

        return view('admin/tipomateriais.show', compact('tipo_materiai'));
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
        $tipo_materiai = TipoMaterial::findOrFail($id);

        return view('admin/tipomateriais.edit', compact('tipo_materiai'));
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
        
        $tipo_materiai = TipoMaterial::findOrFail($id);
        $tipo_materiai->update($request->all());

        Session::flash('success', 'TipoMateriais updated!');

        return redirect('admin/tipomateriais');
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
        TipoMaterial::destroy($id);

        Session::flash('success', 'TipoMateriais deleted!');

        return redirect('admin/tipomateriais');
    }
}
