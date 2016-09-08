<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertencia extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'advertencias';

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
    protected $fillable = ['motivo', 'data','id_matricula'];

    public function aluno() {
        return $this->belongsTo(Aluno::class);
    }
}
