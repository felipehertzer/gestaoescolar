<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'turmas';

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
    protected $fillable = ['turno', 'vagas', 'id_serie', 'numero_turma', 'id_sala', 'ano'];
}
