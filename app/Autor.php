<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'autores';

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
    protected $fillable = ['nome'];
    
    public function livros() {
        return $this->belongsToMany(Livro::class, 'livro_has_autores', 'autor_id', 'livro_id');
    }
}
