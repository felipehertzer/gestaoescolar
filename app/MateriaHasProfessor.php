<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriaHasProfessor extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'materia_has_professor';

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
    protected $fillable = ['id_materia', 'id_professor'];

    public function materia(){
        return $this->belongsTo(Materia::class, 'id_materia', 'id');
    }

    public function materia_has_turma(){
        return $this->hasMany(MateriaHasTurma::class, 'id_materia_professor', 'id');
    }

    public function professor(){
        return $this->belongsTo(Professor::class, 'id_professor', 'id');
    }

    public function getProfessorMateriaAttribute(){
        return $this->materia->nome . " - " . $this->professor->pessoa->nome;
    }
}
