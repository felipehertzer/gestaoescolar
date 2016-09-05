<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Material;
use App\TipoMaterial;
use Illuminate\Http\Request;
use Session;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $materiais = Material::paginate(25);

        return view('admin.materiais.index', compact('materiais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tipomaterial = TipoMaterial::pluck('nome','id');

        return view('admin.materiais.create', compact('tipomaterial'));
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
        
        Material::create($requestData);

        Session::flash('flash_message', 'Material added!');

        return redirect('admin/materiais');
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
        $materiai = Material::findOrFail($id);

        return view('admin.materiais.show', compact('materiai'));
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
        $materiai = Material::findOrFail($id);
        $tipomaterial = TipoMaterial::pluck('nome','id');

        return view('admin.materiais.edit', compact('materiai', 'tipomaterial'));
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
        
        $materiai = Material::findOrFail($id);
        $materiai->update($requestData);

        Session::flash('flash_message', 'Material updated!');

        return redirect('admin/materiais');
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
        Material::destroy($id);

        Session::flash('flash_message', 'Material deleted!');

        return redirect('admin/materiais');
    }
}
