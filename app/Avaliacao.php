<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'avaliacoes';

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
    protected $fillable = ['nome', 'peso', 'observacoes', 'trimestre', 'tipo', 'id_professor', 'id_materia', 'id_turma'];

    
}
