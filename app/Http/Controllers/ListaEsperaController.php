<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ListaEspera;
use Illuminate\Http\Request;
use Session;

class ListaEsperaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $listaespera = ListaEspera::paginate(25);

        return view('listaespera.listaespera.index', compact('listaespera'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('listaespera.listaespera.create');
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
        
        ListaEspera::create($requestData);

        Session::flash('flash_message', 'ListaEspera added!');

        return redirect('admin/listaespera');
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
        $listaespera = ListaEspera::findOrFail($id);

        return view('listaespera.listaespera.show', compact('listaespera'));
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
        $listaespera = ListaEspera::findOrFail($id);

        return view('listaespera.listaespera.edit', compact('listaespera'));
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
        
        $listaespera = ListaEspera::findOrFail($id);
        $listaespera->update($requestData);

        Session::flash('flash_message', 'ListaEspera updated!');

        return redirect('admin/listaespera');
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
        ListaEspera::destroy($id);

        Session::flash('flash_message', 'ListaEspera deleted!');

        return redirect('admin/listaespera');
    }
}
