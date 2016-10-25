<?php

namespace App\Http\Controllers\Biblioteca;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Livro;
use App\Autor;
use Illuminate\Http\Request;
use Session;

class LivroController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $livros = Livro::paginate(25);

        return view('admin/biblioteca.livros.index', compact('livros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $autores = Autor::pluck('nome', 'id');
        return view('admin/biblioteca.livros.create', compact('autores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {
        try {
            if(!isset($request->autores_escolhidos)) {
                throw new \Exception('É necessário escolher ao menos um autor para o livro!');
            }
            
            $livro = Livro::create($request->all());
            $livro->autores()->sync($request->autores_escolhidos, false);

            Session::flash('success', 'Livro added!');
        } catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
        }

        return redirect('admin/biblioteca/livros');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $livro = Livro::findOrFail($id);

        return view('admin/biblioteca.livros.show', compact('livro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $livro = Livro::findOrFail($id);
        $autores = Autor::pluck('nome', 'id');
        $autores_escolhidos = $livro->getAutoresIdsAttribute();

        return view('admin/biblioteca.livros.edit', compact('livro', 'autores', 'autores_escolhidos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request) {
        try {            
            $requestData = $request->all();
            if(!isset($request->autores_escolhidos)) {
                throw new \Exception('É necessário escolher ao menos um autor para o livro');
            }
            
            $livro = Livro::findOrFail($id);
            $livro->update($requestData);
            $livro->autores()->sync($request->autores_escolhidos);

            Session::flash('success', 'Livro updated!');
            return redirect('admin/biblioteca/livros');
        } catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
            return redirect('admin/biblioteca/livros/' . $id . '/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        
        Livro::destroy($id);

        Session::flash('success', 'Livro deleted!');

        return redirect('admin/biblioteca/livros');
    }

}
