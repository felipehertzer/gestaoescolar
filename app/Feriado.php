<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feriado extends Model
{
    use EnumTrait;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feriados';

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
    protected $fillable = ['dia', 'mes', 'ano', 'tipo'];
}
