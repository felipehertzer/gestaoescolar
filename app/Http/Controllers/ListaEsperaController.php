<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ListaEspera;
use App\Matricula;
use Illuminate\Http\Request;
use Session;

class ListaEsperaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $listaespera = ListaEspera::paginate(25);

        return view('admin.listaespera.index', compact('listaespera'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $listaespera = ListaEspera::findOrFail($id);

        return view('admin.listaespera.show', compact('listaespera'));
    }

    public function realizar_matricula($id) {
        try {
            $listaespera = ListaEspera::findOrFail($id)->toArray();
            $matriculaId = ListaEspera::realizar_matricula($listaespera);
            Session::flash('success', 'Matricula foi realizada!');
            return redirect('admin/matriculas/' . $matriculaId);
        } catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
        }
        
        return redirect('admin/listaespera');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        ListaEspera::destroy($id);

        Session::flash('success', 'ListaEspera deleted!');

        return redirect('admin/listaespera');
    }

}
