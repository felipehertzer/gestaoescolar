<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presenca extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'presencas';

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
    protected $fillable = ['id_professor', 'id_materia','id_turma', 'id_matricula', 'data', 'presenca'];

    
}
