<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'alunos';

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
    protected $fillable = ['observacoes', 'id_pessoa'];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'id_pessoa', 'id');
    }

    public function matricula() {
        return $this->hasMany(Matricula::class, 'id');
    }

    public function advertencia() {
        return $this->hasMany(Advertencia::class, 'id');
    }
}
