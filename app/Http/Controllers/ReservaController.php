<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Reserva;
use Illuminate\Http\Request;
use Session;

class ReservaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $reservas = Reserva::paginate(25);

        return view('reservas.reservas.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('reservas.reservas.create');
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
        
        Reserva::create($requestData);

        Session::flash('success', 'Reserva added!');

        return redirect('admin/reservas');
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
        $reserva = Reserva::findOrFail($id);

        return view('admin.reservas.show', compact('reserva'));
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
        $reserva = Reserva::findOrFail($id);

        return view('admin.reservas.edit', compact('reserva'));
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
        
        $reserva = Reserva::findOrFail($id);
        $reserva->update($requestData);

        Session::flash('success', 'Reserva updated!');

        return redirect('admin/reservas');
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
        Reserva::destroy($id);

        Session::flash('success', 'Reserva deleted!');

        return redirect('admin/reservas');
    }
}
