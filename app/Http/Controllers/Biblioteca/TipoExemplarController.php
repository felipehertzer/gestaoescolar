<?php

namespace App\Http\Controllers\Biblioteca;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TipoExemplar;
use Illuminate\Http\Request;
use Session;

class TipoExemplarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tipoexemplares = TipoExemplar::paginate(25);

        return view('admin/biblioteca.tipoexemplares.index', compact('tipoexemplares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin/biblioteca.tipoexemplares.create');
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
        try{
			$requestData = $request->all();
			
			TipoExemplar::create($requestData);

			Session::flash('success', 'TipoExemplar added!');
			
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
        }

        return redirect('admin/biblioteca/tipoexemplares');
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
        $tipoexemplare = TipoExemplar::findOrFail($id);

        return view('admin/biblioteca.tipoexemplares.show', compact('tipoexemplare'));
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
        $tipoexemplare = TipoExemplar::findOrFail($id);

        return view('admin/biblioteca.tipoexemplares.edit', compact('tipoexemplare'));
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
        try{
			$requestData = $request->all();
			
			$tipoexemplar = TipoExemplar::findOrFail($id);
			$tipoexemplar->update($requestData);

			Session::flash('success', 'TipoExemplar updated!');

			return redirect('admin/biblioteca/tipoexemplares');
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());   
			return redirect('admin/biblioteca/tipoexemplares/' . $id . '/edit');
        }
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
		try{
			TipoExemplar::destroy($id);

			Session::flash('success', 'TipoExemplar deleted!');
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());   
		}
        return redirect('admin/biblioteca/tipoexemplares');
    }
}
