<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Funcao;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class FuncaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $funcoes = Funcao::paginate(15);

        return view('admin.funcoes.index', compact('funcoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.funcoes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        Funcao::create($request->all());

        Session::flash('success', 'Funcao added!');

        return redirect('admin/funcoes');
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
        $funco = Funcao::findOrFail($id);

        return view('admin.funcoes.show', compact('funco'));
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
        $funco = Funcao::findOrFail($id);

        return view('admin.funcoes.edit', compact('funco'));
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
        
        $funco = Funcao::findOrFail($id);
        $funco->update($request->all());

        Session::flash('success', 'Funcao updated!');

        return redirect('admin/funcoes');
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
        Funcao::destroy($id);

        Session::flash('success', 'Funcao deleted!');

        return redirect('admin/funcoes');
    }
}
