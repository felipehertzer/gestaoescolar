<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ListaEspera;
use Illuminate\Http\Request;
use Session;

class ListaEsperaController extends Controller
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
        $listaespera = ListaEspera::paginate(25);

        return view('admin.listaespera.index', compact('listaespera'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.listaespera.create');
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

        Session::flash('success', 'ListaEspera added!');

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

        return view('admin.listaespera.show', compact('listaespera'));
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

        return view('admin.listaespera.edit', compact('listaespera'));
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

        Session::flash('success', 'ListaEspera updated!');

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

        Session::flash('success', 'ListaEspera deleted!');

        return redirect('admin/listaespera');
    }
}
