<?php

namespace App\Http\Controllers\Biblioteca;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Autor;
use Illuminate\Http\Request;
use Session;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $autores = Autor::paginate(15);

        return view('admin/biblioteca.autores.index', compact('autores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin/biblioteca.autores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
		try{
			$this->validate($request, ['nome' => 'required', ]);

			Autor::create($request->all());

			Session::flash('success', 'Autor adicionado!');
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
        }

        return redirect('admin/biblioteca/autores');
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
        $autores = Autor::findOrFail($id);

        return view('admin/biblioteca.autores.show', compact('autores'));
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
        $autores = Autor::findOrFail($id);

        return view('admin/biblioteca.autores.edit', compact('autores'));
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
		try{
			$this->validate($request, ['nome' => 'required', ]);

			$autores = Autor::findOrFail($id);
			$autores->update($request->all());

			Session::flash('success', 'Autor atualizado!');

			return redirect('admin/biblioteca/autores');
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
			return redirect('admin/biblioteca/autores/' . $id . '/edit');
        }
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
		try{
			Autor::destroy($id);

			Session::flash('success', 'Autor removido!');
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
        }
        return redirect('admin/biblioteca/autores');
    }
}
