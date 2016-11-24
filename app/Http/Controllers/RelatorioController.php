<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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
