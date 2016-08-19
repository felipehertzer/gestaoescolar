<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Pessoa;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $pessoas = Pessoa::paginate(15);

        return view('admin.pessoas.index', compact('pessoas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.pessoas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        Pessoa::create($request->all());

        Session::flash('flash_message', 'Pessoa added!');

        return redirect('admin/pessoas');
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
        $pessoa = Pessoa::findOrFail($id);

        return view('admin.pessoas.show', compact('pessoa'));
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
        $pessoa = Pessoa::findOrFail($id);

        return view('admin.pessoas.edit', compact('pessoa'));
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
        
        $pessoa = Pessoa::findOrFail($id);
        $pessoa->update($request->all());

        Session::flash('flash_message', 'Pessoa updated!');

        return redirect('admin/pessoas');
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
        Pessoa::destroy($id);

        Session::flash('flash_message', 'Pessoa deleted!');

        return redirect('admin/pessoas');
    }
}
