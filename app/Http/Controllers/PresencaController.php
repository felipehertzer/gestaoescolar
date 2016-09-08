<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Presenca;
use Illuminate\Http\Request;
use Session;

class PresencaController extends Controller
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
        $presencas = Presenca::paginate(25);

        return view('admin.presencas.index', compact('presencas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.presencas.create');
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
        
        Presenca::create($requestData);

        Session::flash('flash_message', 'Presenca added!');

        return redirect('admin/presencas');
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
        $presenca = Presenca::findOrFail($id);

        return view('admin.presencas.show', compact('presenca'));
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
        $presenca = Presenca::findOrFail($id);

        return view('admin.presencas.edit', compact('presenca'));
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
        
        $presenca = Presenca::findOrFail($id);
        $presenca->update($requestData);

        Session::flash('flash_message', 'Presenca updated!');

        return redirect('admin/presencas');
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
        Presenca::destroy($id);

        Session::flash('flash_message', 'Presenca deleted!');

        return redirect('admin/presencas');
    }
}
