<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multa extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'multas';

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
    protected $fillable = ['valor', 'data_pagamento', 'id_tipomulta'];

    
}
