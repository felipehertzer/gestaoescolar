<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Sala;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;

class SalaController extends Controller
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
        $salas = Sala::paginate(15);

        return view('admin.salas.index', compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.salas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
		try{
			$messages = [
						'numero.required' => 'Informe o número!',
						'capacidade.required' => 'Informe a capacidade!',
					];
			$validator = Validator::make($request->all(), ['numero' => 'required', 'capacidade' => 'required'],$messages);


			if ($validator->fails()) {
				return redirect('admin/salas/create')
							->withErrors($validator)
							->withInput();
			}
        
        Sala::create($request->all());

        Session::flash('success', 'Sala added!');
		
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());   
        }

	return redirect('admin/salas');

        
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
        $sala = Sala::findOrFail($id);

        return view('admin.salas.show', compact('sala'));
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
        $sala = Sala::findOrFail($id);

        return view('admin.salas.edit', compact('sala'));
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
		$messages = [
						'numero.required' => 'Informe o número!',
						'capacidade.required' => 'Informe a capacidade!',
					];
		$validator = Validator::make($request->all(), ['numero' => 'required', 'capacidade' => 'required'],$messages);


		if ($validator->fails()) {
				return redirect('admin/salas/'.$id.'/edit')
							->withErrors($validator)
							->withInput();
		}
	
        
        $sala = Sala::findOrFail($id);
        $sala->update($request->all());

        Session::flash('success', 'Sala updated!');
		return redirect('admin/salas');
		} catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());   
			return redirect('admin/salas/' . $id . '/edit');
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
        Sala::destroy($id);

        Session::flash('success', 'Sala deleted!');

        return redirect('admin/salas');
    }
}
