<?php

namespace App\Http\Controllers\Biblioteca;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TipoMulta;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class TipoMultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $tipomulta = TipoMulta::paginate(15);

        return view('admin/biblioteca.tipomulta.index', compact('tipomulta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin/biblioteca.tipomulta.create');
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
			TipoMulta::create($request->all());

			Session::flash('success', 'Tipo de Multa adicionado!');
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
        }
        return redirect('admin/biblioteca/tipomulta');
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
        $tipomultum = TipoMulta::findOrFail($id);

        return view('admin/biblioteca.tipomulta.show', compact('tipomultum'));
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
        $tipomultum = TipoMulta::findOrFail($id);

        return view('admin/biblioteca.tipomulta.edit', compact('tipomultum'));
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
			$tipo_multum = TipoMulta::findOrFail($id);
			$tipo_multum->update($request->all());

			Session::flash('success', 'Tipo de Multa atualizado!');

			return redirect('admin/biblioteca/tipomulta');
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());   
			return redirect('admin/biblioteca/tipomulta/' . $id . '/edit');
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
			TipoMulta::destroy($id);

			Session::flash('success', 'Tipo de Multa removido!');
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());   
		}
        return redirect('admin/biblioteca/tipomulta');
    }
}
