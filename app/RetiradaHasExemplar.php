<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RetiradaHasExemplar extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'retirada_has_exemplares';
    public $timestamps = false;

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
    protected $fillable = ['retirada_id', 'exemplar_id', 'status'];

    public function retirada() {
        return $this->belongsTo(Retirada::class);
    }

    public function exemplar() {
        return $this->belongsTo(Exemplar::class);
    }

    public function editaStatusParaDevolvido($retirada_id, $exemplaresIds) {
        foreach ($exemplaresIds as $exemplarId) {
            $e = self::where('retirada_id', '=' , $retirada_id)
                    ->where('exemplar_id', '=' , $exemplarId)
                    ->where('status', '=' , Retirada::STATUS_RETIRADO)
                    ->first();
            
            if(!empty($e)) {
                $e->update(['status' => Retirada::STATUS_DEVOLVIDO]);
            }            
        }
    }
    
    public function todosExemplaresForamDevolvidos($retirada_id) {
        $exemplaresNaoDevolvidos = self::where('retirada_id', '=' , $retirada_id)
                    ->where('status', '=' , Retirada::STATUS_RETIRADO)
                    ->lists('id');
        
        if($exemplaresNaoDevolvidos->isEmpty()) {
            return true;
        }
        
        return false;
    }

}
