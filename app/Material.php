<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
	const STATUS_RETIRADO = 'retirado';
    const STATUS_DEVOLVIDO = 'devolvido';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'materiais';

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
    protected $fillable = ['nome', 'id_tipomaterial' ,'status'];

    public function tipomaterial() {
        return $this->belongsTo(TipoMaterial::class);
    }
	
	public static function getStatus() {
        return array(
            self::STATUS_RETIRADO => 'Retirado',
            self::STATUS_DEVOLVIDO => 'Devolvido'
        );
    }

    public static function getNomeStatus($status) {
        return self::getStatus()[$status];
    }
	
	public function editaStatusParaEmprestado($material_id) {
        $this->editaStatusMaterial($material_id, self::STATUS_RETIRADO);
    }
    
    public function editaStatusParaDevolvido($material_id) {
        $this->editaStatusMaterial($material_id, self::STATUS_DEVOLVIDO);
    }
    
    public function editaStatusMaterial($material_id, $status) {
            $e = self::findOrFail($material_id);
            $e->update(['status' => $status]);
    }
}
