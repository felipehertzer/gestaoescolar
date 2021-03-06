<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'livros';

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
    protected $fillable = ['nome', 'ano'];

    public function autores() {
        return $this->belongsToMany(Autor::class, 'livro_has_autores', 'livro_id', 'autor_id');
    }
    
    public function getAutoresIdsAttribute() {
        return $this->autores->lists('nome', 'id');
    }
    
}
