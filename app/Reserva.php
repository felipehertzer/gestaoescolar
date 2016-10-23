<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
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
    protected $fillable = ['data_reserva', 'data_agenda', 'matricula_id'];

    public function matricula() {
        return $this->belongsTo(Matricula::class);
    }
    
}
