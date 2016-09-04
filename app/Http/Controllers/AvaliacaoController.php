<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Avaliacao;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class AvaliacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $avaliacoes = Avaliacao::paginate(15);

        return view('admin.avaliacoes.index', compact('avaliacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.avaliacoes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        Avaliacao::create($request->all());

        Session::flash('success', 'Avaliacao added!');

        return redirect('admin/avaliacoes');
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
        $avaliaco = Avaliacao::findOrFail($id);

        return view('admin.avaliacoes.show', compact('avaliaco'));
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
        $avaliaco = Avaliacao::findOrFail($id);

        return view('admin.avaliacoes.edit', compact('avaliaco'));
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
        
        $avaliaco = Avaliacao::findOrFail($id);
        $avaliaco->update($request->all());

        Session::flash('success', 'Avaliacao updated!');

        return redirect('admin/avaliacoes');
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
        Avaliacao::destroy($id);

        Session::flash('success', 'Avaliacao deleted!');

        return redirect('admin/avaliacoes');
    }
}
