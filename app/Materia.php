<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'materias';

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

    public function professor() {
        return $this->belongsToMany(Professor::class, 'materia_has_professor', 'id_materia', 'id_professor');
    }

}
