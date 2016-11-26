<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'matriculas';

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

    public function presenca() {
        return $this->hasMany(Presenca::class, 'id', 'id_matricula');
    }

    public static function adicionar($dadosMatricula) {
        $temVagasNaTurma = self::temVagasNaTurma($dadosMatricula['id_turma']);
        
        if(!$temVagasNaTurma) {
            ListaEspera::adicionar($dadosMatricula);
            throw new \Exception('Não há mais vagas para essa turma. Aluno foi cadastrado na Lista de Espera!');
        }

        Matricula::create($dadosMatricula);
    }

    public static function temVagasNaTurma($turmaId) {
        $vagasDisponiveisDaTurma = Turma::findOrFail($turmaId)->vagas;
        $matriculadosNaTurma = Matricula::where('id_turma', $turmaId)->count();

        return $vagasDisponiveisDaTurma > $matriculadosNaTurma;
    }

}
