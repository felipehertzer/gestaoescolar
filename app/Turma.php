<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use EnumTrait;
    /**
     * The database table used by the model .
     *
     * @var string
     */
    protected $table = 'turmas';

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
    protected $fillable = ['turno', 'vagas', 'id_serie', 'numero_turma', 'id_sala', 'ano'];

    public function sala() {
        return $this->belongsTo(Sala::class);
    }

    public function serie() {
        return $this->belongsTo(Serie::class);
    }

    public function aluno() {
        return $this->belongsTo(Aluno::class);
    }

    public function materia() {
        return $this->belongsToMany(Professor::class, 'materia_has_turma', 'id_turma', 'id_materia_professor');
    }

    public function materia_has_professor(){
        return $this->belongsTo(MateriaHasProfessor::class);
    }

    public function materia_has_turma(){
        return $this->belongsTo(MateriaHasTurma::class, 'id', 'id_turma');
    }

    public function matricula() {
        return $this->hasMany(Matricula::class, 'id_turma', 'id');
    }

    public function materia_professor() {
        return $this->belongsToMany(Materia::class, 'materia_has_turma', 'id_turma', 'id_materia_professor');
    }

    public function getMateriasIdsAttribute() {
        //dd($this->materia_professor);
        return $this->materia_professor->lists('nome', 'id');
    }

}
