<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Serie;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $series = Serie::paginate(15);

        return view('series.series.index', compact('series'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('series.series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        Serie::create($request->all());

        Session::flash('flash_message', 'Serie added!');

        return redirect('admin/series');
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
        $series = Serie::findOrFail($id);

        return view('series.series.show', compact('series'));
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
        $series = Serie::findOrFail($id);

        return view('series.series.edit', compact('series'));
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
        
        $series = Serie::findOrFail($id);
        $series->update($request->all());

        Session::flash('flash_message', 'Serie updated!');

        return redirect('admin/series');
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
        Serie::destroy($id);

        Session::flash('flash_message', 'Serie deleted!');

        return redirect('admin/series');
    }
}
