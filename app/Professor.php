<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'professores';

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
    protected $fillable = ['pis', 'id_pessoas', 'salario'];

    public function materia() {
        return $this->belongsToMany(Materia::class, 'materia_has_professor', 'id_professor', 'id_materia');
    }

    public function pessoa() {
        return $this->hasOne(Pessoa::class, 'id');
    }
}
