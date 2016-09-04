<?php

namespace App\Http\Controllers\Biblioteca;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Livro;
use Illuminate\Http\Request;
use Session;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $livros = Livro::paginate(25);

        return view('admin/biblioteca.livros.index', compact('livros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin/biblioteca.livros.create');
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
        
        Livro::create($requestData);

        Session::flash('flash_message', 'Livro added!');

        return redirect('admin/biblioteca/livros');
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
    public function edit($id)
    {
        $livro = Livro::findOrFail($id);

        return view('admin/biblioteca.livros.edit', compact('livro'));
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
        
        $livro = Livro::findOrFail($id);
        $livro->update($requestData);

        Session::flash('flash_message', 'Livro updated!');

        return redirect('admin/biblioteca/livros');
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
        Livro::destroy($id);

        Session::flash('flash_message', 'Livro deleted!');

        return redirect('admin/biblioteca/livros');
    }
}
