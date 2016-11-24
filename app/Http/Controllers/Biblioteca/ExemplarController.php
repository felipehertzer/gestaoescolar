<?php

namespace App\Http\Controllers\Biblioteca;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Exemplar;
use App\TipoExemplar;
use App\Livro;
use Illuminate\Http\Request;
use Session;

class ExemplarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $exemplares = Exemplar::paginate(25);
        return view('admin/biblioteca.exemplares.index', compact('exemplares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tipoexemplares = TipoExemplar::pluck('nome','id');
        $livros = Livro::pluck('nome','id');
        return view('admin/biblioteca.exemplares.create', compact('tipoexemplares', 'livros'));
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
			
			Exemplar::create($requestData);

			Session::flash('success', 'Exemplar adicionado!');
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
        }
        return redirect('admin/biblioteca/exemplares');
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
        $exemplare = Exemplar::findOrFail($id);

        return view('admin/biblioteca.exemplares.show', compact('exemplare'));
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
        $exemplare = Exemplar::findOrFail($id);
        $tipoexemplares = TipoExemplar::pluck('nome','id');
        $livros = Livro::pluck('nome','id');

        return view('admin/biblioteca.exemplares.edit', compact('exemplare', 'tipoexemplares', 'livros'));
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
			//var_dump($request->all());exit;
			$requestData = $request->all();
			
			$exemplare = Exemplar::findOrFail($id);
			$exemplare->update($requestData);

			Session::flash('success', 'Exemplar atualizado!');

			return redirect('admin/biblioteca/exemplares');
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
			return redirect('admin/biblioteca/exemplares/' . $id . '/edit');
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
			Exemplar::destroy($id);

			Session::flash('success', 'Exemplar removido!');
		} catch (\Exception $ex) {
			Session::flash('danger', $ex->getMessage());
		}
        return redirect('admin/biblioteca/exemplares');
    }
}
