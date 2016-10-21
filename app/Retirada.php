<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retirada extends Model {

    const STATUS_RETIRADO = 'retirado';
    const STATUS_DEVOLVIDO = 'devolvido';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'retiradas';

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
    protected $fillable = ['data_retirada', 'data_devolucao', 'renovacao', 'status', 'matricula_id'];

    public function matricula() {
        return $this->belongsTo(Matricula::class);
    }

    public function exemplares() {
        return $this->belongsToMany(Exemplar::class, 'retirada_has_exemplares', 'retirada_id', 'exemplar_id');
    }

    public function editaStatusParaDevolvido($id) {
        $e = self::findOrFail($id);
        $e->update(['status' => self::STATUS_DEVOLVIDO]);
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

}
