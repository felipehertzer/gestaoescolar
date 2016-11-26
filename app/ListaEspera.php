<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaEspera extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'listaespera';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_aluno', 'id_turma', 'observacoes'];

    public function aluno() {
        return $this->belongsTo(Aluno::class, 'id_aluno');
    }

    public function turma() {
        return $this->belongsTo(Turma::class, 'id_turma');
    }

    public static function adicionar($dados) {
        ListaEspera::create($dados);
    }

    public static function realizar_matricula($dados) {
        $temVagasNaTurma = Matricula::temVagasNaTurma($dados['id_turma']);

        if (!$temVagasNaTurma) {
            throw new \Exception('Ainda não há vagas para essa turma!');
        }

        ListaEspera::destroy($dados['id']);
        return Matricula::create($dados)->id;
    }

}
