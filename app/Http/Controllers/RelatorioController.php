<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Avaliacao;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Presenca;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

use App\Livro;
use App\Pessoa;

class RelatorioController extends Controller {
    
    public function livros_mais_retirados() {        
        $livros = Livro::select('livros.nome', DB::raw('count(exemplares.id) as numero_exemplares_retirado'))
                ->join('exemplares', 'livros.id', '=', 'exemplares.livro_id')
                ->join('retirada_has_exemplares', 'exemplares.id', '=', 'retirada_has_exemplares.exemplar_id')
                ->groupBy('livros.id')
                ->orderBy('numero_exemplares_retirado', 'desc')
                ->get();
        
        return view('admin.relatorios.livros_mais_retirados', compact('livros'));
    }

    public function presencas() {
        $presencas = Aluno::select('matriculas.id', 'pessoas.nome', DB::raw("(SELECT COUNT(*) FROM presenca_has_matricula WHERE presenca_has_matricula.id_matricula = matriculas.id AND presenca = 'falta') as faltas"))
            ->join('pessoas', 'pessoas.id', '=', 'alunos.id_pessoas')
            ->join('matriculas', 'matriculas.id_aluno', '=', 'alunos.id')
            ->orderby(DB::raw("(SELECT COUNT(*) FROM presenca_has_matricula WHERE presenca_has_matricula.id_matricula = matriculas.id AND presenca = 'falta')"), 'DESC')
            ->get();
        return view('admin.relatorios.presencas', compact('presencas'));
    }

    public function notas() {
        $avaliacoes = Avaliacao::select('avaliacoes.id','avaliacoes.nome', 'materias.nome as materia', 'turmas.numero_turma', DB::raw('(SELECT count(*) FROM matriculas WHERE matriculas.id_turma = turmas.id) as alunos')
            , DB::raw('(SELECT SUM(notas.nota) FROM notas WHERE avaliacoes.id = notas.id_avaliacao) as media'))
            ->join('materias', 'avaliacoes.id_materia', '=', 'materias.id')
            ->join('turmas', 'turmas.id', '=', 'avaliacoes.id_turma')
            ->orderby(DB::raw('(SELECT SUM(notas.nota) FROM notas WHERE avaliacoes.id = notas.id_avaliacao)'), 'DESC')
            ->get();
        return view('admin.relatorios.notas', compact('avaliacoes'));
    }
    
    public function alunos_mais_retiram_livros() {        
        $alunos = Pessoa::select('pessoas.nome', DB::raw('count(retirada_has_exemplares.exemplar_id) as numero_exemplares_retirado'))
                ->join('alunos', 'pessoas.id', '=', 'alunos.id_pessoas')
                ->join('matriculas', 'alunos.id', '=', 'matriculas.id_aluno')
                ->join('retiradas', 'matriculas.id', '=', 'retiradas.matricula_id')
                ->join('retirada_has_exemplares', 'retiradas.id', '=', 'retirada_has_exemplares.retirada_id')
                ->groupBy('pessoas.id')
                ->orderBy('numero_exemplares_retirado', 'desc')
                ->get();
        
        return view('admin.relatorios.alunos_mais_retiram_livros', compact('alunos'));
    }
    
}
