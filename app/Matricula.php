<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
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
    protected $fillable = ['observacoes', 'id_aluno', 'id_turma'];

    public function aluno() {
        return $this->belongsTo(Aluno::class, 'id', 'id_matricula');
    }

    public function turma() {
        return $this->hasMany(Turma::class, 'id', 'id_turma');
    }
}
