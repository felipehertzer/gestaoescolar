<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmprestaMaterial extends Model
{
	
	const STATUS_RETIRADO = 'retirado';
    const STATUS_DEVOLVIDO = 'devolvido';
	
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'emprestamateriais';

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
    protected $fillable = [ 'data', 'material_id', 'materia_turma_id', 'status'];


    public function materiais() {
        return $this->belongsTo(Material::class);
    }
	
	public function turma() {
        return $this->belongsTo(MateriaHasTurma::class);
    }
	
	 public function editaStatusParaEmprestado($id) {
        $this->editaStatusMaterial($id, self::STATUS_RETIRADO);
    }
    
    public function editaStatusParaDisponivel($id) {
        $this->editaStatusMaterial($id, self::STATUS_DEVOLVIDO);
    }
    
    public function editaStatusMaterial($id, $status) {
            $e = self::findOrFail($id);
            $e->update(['status' => $status]);
    }
	
	
}
