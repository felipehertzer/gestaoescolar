<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Funcao;
use App\Funcionario;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pessoa;
use App\Professor;
use App\Responsavel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class PessoaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index() {
        $pessoas = Pessoa::paginate(15);

        return view('admin.pessoas.index', compact('pessoas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create() {
        $funcoes = Funcao::pluck('nome', 'id');
        return view('admin.pessoas.create', compact('funcoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request) {
        try {
            $p = Pessoa::create($request->except(array('funcao', 'pis', 'salario', 'empresa', 'observacoes')));
            switch ($request->get('tipopessoa')) {
                // alunos
                case 3:
                    $p->aluno()->create(['observacoes' => $request->get('observacoes')]);
                    break;
                // responsaveis
                case 2:
                    $p->responsavel()->create(['empresa' => $request->get('empresa'), 'id_funcao' => $request->get('funcao')]);
                    break;
                // professores
                case 1:
                    $p->professor()->create(['pis' => $request->get('pis'), 'salario' => $request->get('salario')]);
                    break;
                // funcionarios
                default:
                    $p->funcionario()->create(['pis' => $request->get('pis'), 'salario' => $request->get('salario'), 'id_funcao' => $request->get('funcao')]);
                    break;
            }

			Session::flash('success', 'Pessoa adicionada!');
        } catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
        }

        return redirect('admin/pessoas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id) {
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
    public function edit($id) {
        try {

            $data['pessoa'] = Pessoa::findOrFail($id);
            $data['funcoes'] = Funcao::pluck('nome', 'id');
            switch ($data['pessoa']->tipopessoa) {
                // alunos
                case 3:
                    $data['aluno'] = Aluno::where("id_pessoas", $id)->get();
                    break;
                // responsaveis
                case 2:
                    $data['responsavel'] = Responsavel::where("id_pessoas", $id)->get();
                    break;
                // professores
                case 1:
                    $data['professor'] = Professor::where("id_pessoas", $id)->get();
                    break;
                // funcionarios
                default:
                    $data['funcionario'] = Funcionario::where("id_pessoas", $id)->get();
                    break;
            }

            return view('admin.pessoas.edit', $data);
        } catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update($id, Request $request) {
        try {
            $pessoa = Pessoa::findOrFail($id);

            switch ($pessoa->tipopessoa) {
                // alunos
                case 3:
                    $aluno = Aluno::where('id_pessoas', '=', $id)->firstOrFail();
                    Aluno::destroy($aluno->id);
                    break;
                // responsaveis
                case 2:
                    $responsavel = Responsavel::where('id_pessoas', '=', $id)->firstOrFail();
                    Responsavel::destroy($responsavel->id);
                    break;
                // professores
                case 1:
                    $professor = Professor::where('id_pessoas', '=', $id)->firstOrFail();
                    Professor::destroy($professor->id);
                    break;
                // funcionarios
                default:
                    $funcionario = Funcionario::where('id_pessoas', '=', $id)->firstOrFail();
                    Funcionario::destroy($funcionario->id);
                    break;
            }

            $pessoa->update($request->except(array('funcao', 'pis', 'salario', 'empresa', 'observacoes')));

            switch ($request->get('tipopessoa')) {
                // alunos
                case 3:
                    $pessoa->aluno()->create(['observacoes' => $request->get('observacoes')]);
                    break;
                // responsaveis
                case 2:
                    $pessoa->responsavel()->create(['empresa' => $request->get('empresa'), 'id_funcao' => $request->get('funcao')]);
                    break;
                // professores
                case 1:
                    $pessoa->professor()->create(['pis' => $request->get('pis'), 'salario' => $request->get('salario')]);
                    break;
                // funcionarios
                default:
                    $pessoa->funcionario()->create(['pis' => $request->get('pis'), 'salario' => $request->get('salario'), 'id_funcao' => $request->get('funcao')]);
                    break;
            }
			Session::flash('success', 'Pessoa atualizada!');
        } catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
        }
        return redirect('admin/pessoas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id) {
        Pessoa::destroy($id);

        Session::flash('success', 'Pessoa removida!');

        return redirect('admin/pessoas');
    }

}
