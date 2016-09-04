<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'funcionarios';

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
    protected $fillable = ['pis', 'id_funcao', 'id_pessoa', 'salario'];

    
}
