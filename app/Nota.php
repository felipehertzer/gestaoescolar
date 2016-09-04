<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notas';

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
    protected $fillable = ['nota', 'id_avaliacao', 'id_matricula'];

    
}
