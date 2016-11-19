<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservaHasExemplar extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reserva_has_exemplares';
    public $timestamps = false;

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
    protected $fillable = ['reserva_id', 'exemplar_id'];

    
}
