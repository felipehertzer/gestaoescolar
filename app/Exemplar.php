<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exemplar extends Model
{
    const STATUS_EMPRESTIMO = 'emprestimo';
    const STATUS_SEDE = 'sede';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exemplares';

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
    protected $fillable = ['estante', 'prateleira', 'status', 'danificado', 'livro_id', 'tipoexemplar_id'];
    
    //essa funcao faz o relacionamento, olhar na index pra ver como se chama ela
    public function livro() {
        return $this->belongsTo(Livro::class);
    }
    
    public function tipoexemplar() {
        return $this->belongsTo(TipoExemplar::class);
    }
    
    public static function getStatus() {
        return array(
            self::STATUS_EMPRESTIMO => 'Empréstimo',
            self::STATUS_SEDE => 'Sede'
        );
    }
    
    public static function getNomeStatus($status) {
        return self::getStatus()[$status];
    }

    
}
