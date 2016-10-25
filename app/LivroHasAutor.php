<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LivroHasAutor extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'livro_has_autores';

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
    protected $fillable = ['livro_id', 'autor_id'];

    
}
