<?php

namespace App\Lib;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Pessoa;

class Permissoes {

    public static function exibePaginaPorTipoPessoa() {
        $pessoa = Auth::user(); // pega o usuario da sessao
        $urlAcessada = Route::getFacadeRoot()->current()->uri(); // pega a url que esta acessando
        $tipoPessoa = $pessoa->tipopessoa;
        if (!self::temPermissao($tipoPessoa, $urlAcessada)) {
            return Redirect::to('home')->send()->with('danger', 'Você não tem permissão de acesso a está página!');
        }
    }

    public static function podeExibirMenu($modulo) {
        $pessoa = Auth::user(); // pega o usuario da sessao
        $tipoPessoa = $pessoa->tipopessoa;
        return self::temPermissao($tipoPessoa, $modulo);
    }

    public static function temPermissao($tipoPessoa, $urlAcessada) {
        $modulosPermitidasDoTipoPessoa = self::getModulosPermitidasPorPessoa()[$tipoPessoa];

        foreach ($modulosPermitidasDoTipoPessoa as $modulo) {
            if (preg_match('/' . trim($modulo) . '/', $urlAcessada)) {
                return true;
            }
        }

        return false;
    }

    public static function getModulosPermitidasPorPessoa() {
        return [
            Pessoa::PESSOA_FUNCIONARIO => self::modulosDisponiveisFuncionario(),
            Pessoa::PESSOA_PROFESSOR => self::modulosDisponiveisProfessor(),
            Pessoa::PESSOA_RESPONSAVEL => [],
            Pessoa::PESSOA_ALUNO => [],
        ];
    }

    public static function modulosDisponiveisFuncionario() {
        return array_merge(
                self::getModuloCadastros(), self::getModuloBiblioteca(), self::getModuloMatricula(), self::getModuloRelatorios());
    }

    public static function modulosDisponiveisProfessor() {
        return self::getModuloAvaliacoes();
    }

    public static function getModuloBiblioteca() {
        return [
            'retiradas', 'reservas', 'autores', 'livros', 'multas', 'tipomulta', 'tipoexemplares', 'exemplares'
        ];
    }

    public static function getModuloMatricula() {
        return [
            'matriculas', 'listaespera', 'advertencias'
        ];
    }

    public static function getModuloCadastros() {
        return [
            'pessoas', 'materias', 'turmas', 'salas', 'materiais', 'series', 'funcoes', 'tipomateriais',
            'emprestarmateriais', 'feriados'
        ];
    }

    public static function getModuloAvaliacoes() {
        return [
            'avaliacoes', 'notas', 'presencas'
        ];
    }

    public static function getModuloRelatorios() {
        return [
            'livros_mais_retirados', 'alunos_mais_retiram_livros'
        ];
    }

}
