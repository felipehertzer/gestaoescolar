<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriaHasTurma extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'materia_has_turma';

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
    protected $fillable = ['id_materia_professor', 'id_turma'];

    public function turma(){
        return $this->hasOne(Turma::class, 'id', 'id_turma');
    }

    public function materia_has_professor(){
        return $this->hasOne(MateriaHasProfessor::class, 'id', 'id_materia_professor');
    }

}
