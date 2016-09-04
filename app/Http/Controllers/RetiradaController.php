<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Retirada;
use Illuminate\Http\Request;
use Session;

class RetiradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $retiradas = Retirada::paginate(25);

        return view('retiradas.retiradas.index', compact('retiradas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('retiradas.retiradas.create');
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
        
        Retirada::create($requestData);

        Session::flash('flash_message', 'Retirada added!');

        return redirect('admin/retiradas');
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
        $retirada = Retirada::findOrFail($id);

        return view('retiradas.retiradas.show', compact('retirada'));
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
        $retirada = Retirada::findOrFail($id);

        return view('retiradas.retiradas.edit', compact('retirada'));
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
        
        $retirada = Retirada::findOrFail($id);
        $retirada->update($requestData);

        Session::flash('flash_message', 'Retirada updated!');

        return redirect('admin/retiradas');
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
        Retirada::destroy($id);

        Session::flash('flash_message', 'Retirada deleted!');

        return redirect('admin/retiradas');
    }
}
