<?php

namespace App\Http\Controllers\Biblioteca;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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

        return view('admin/biblioteca.retiradas.index', compact('retiradas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $collection = collect(
                DB::table('matriculas')
                        ->select('matriculas.id', 'pessoas.nome')
                        ->join('alunos', 'alunos.id', '=', 'matriculas.id_aluno')
                        ->join('pessoas', 'pessoas.id', '=', 'alunos.id_pessoas')
                        ->get()
        );
        
        $matriculas = $collection->pluck('nome', 'id');
        return view('admin/biblioteca.retiradas.create', compact('matriculas'));
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

        Session::flash('success', 'Retirada added!');

        return redirect('admin/biblioteca/retiradas');
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

        return view('admin/biblioteca.retiradas.show', compact('retirada'));
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
        $collection = collect(
                DB::table('matriculas')
                        ->select('matriculas.id', 'pessoas.nome')
                        ->join('alunos', 'alunos.id', '=', 'matriculas.id_aluno')
                        ->join('pessoas', 'pessoas.id', '=', 'alunos.id_pessoas')
                        ->get()
        );
        
        $matriculas = $collection->pluck('nome', 'id');

        return view('admin/biblioteca.retiradas.edit', compact('retirada', 'matriculas'));
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

        Session::flash('success', 'Retirada updated!');

        return redirect('admin/biblioteca/retiradas');
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

        Session::flash('success', 'Retirada deleted!');

        return redirect('admin/biblioteca/retiradas');
    }
}
