<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model {

    const STATUS_RESERVADO = 'reservado';
    const STATUS_RETIRADO = 'retirado';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reservas';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that should be mutated to dates.
     * 
     * @var array 
     */
    protected $dates = ['data_reserva', 'data_agenda'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['data_reserva', 'data_agenda', 'matricula_id', 'status'];

    public function matricula() {
        return $this->belongsTo(Matricula::class);
    }

    public function exemplares() {
        return $this->belongsToMany(Exemplar::class, 'reserva_has_exemplares', 'reserva_id', 'exemplar_id');
    }

    public function getExemplaresIdsAttribute() {
        return $this->exemplares->lists('NomeCompletoExemplar', 'id');
    }

    public static function retirouExemplares($reserva_id) {
        $reserva = self::findOrFail($reserva_id);
        self::validacoesParaRetirarExemplares($reserva);
        Retirada::geraNovoRegistro($reserva->exemplares, $reserva->matricula_id);
        $reserva->update(['status' => self::STATUS_RETIRADO]);
    }
    
    public static function validacoesParaRetirarExemplares($reserva) {
        foreach ($reserva->exemplares as $exemplar) {
            if($exemplar->status == Exemplar::STATUS_EMPRESTADO) {
                throw new \Exception('O exemplar L:' . $exemplar->livro->nome . ' - Ex:' . $exemplar->id . ' está emprestado!');
            }
        }
    }

}
