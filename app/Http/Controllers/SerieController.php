<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Serie;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;

class SerieController extends Controller
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
        $series = Serie::paginate(15);

        return view('admin.series.index', compact('series'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
		try{
			$messages = ['nome.required' => 'Informe o nome!'];
			$validator = Validator::make($request->all(), ['nome' => 'required'],$messages);
			if ($validator->fails()) {
				return redirect('admin/series/create')
							->withErrors($validator)
							->withInput();
			}
        
			Serie::create($request->all());

			Session::flash('success', 'Serie added!');

			} catch (\Exception $ex) {
				Session::flash('danger', $ex->getMessage());   
			}

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

        return view('admin.series.show', compact('series'));
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

        return view('admin.series.edit', compact('series'));
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
			$messages = ['nome.required' => 'Informe o nome!'];
			$validator = Validator::make($request->all(), ['nome' => 'required'],$messages);
			if ($validator->fails()) {
				return redirect('admin/series/' . $id . '/edit')
							->withErrors($validator)
							->withInput();
			}
        
        $series = Serie::findOrFail($id);
        $series->update($request->all());

        Session::flash('success', 'Serie updated!');

        return redirect('admin/series');

		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());   
			return redirect('admin/series/' . $id . '/edit');
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
        Serie::destroy($id);

        Session::flash('success', 'Serie deleted!');

        return redirect('admin/series');
    }
}
