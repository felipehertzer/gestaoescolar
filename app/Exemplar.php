<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exemplar extends Model
{
    const STATUS_EMPRESTADO = 'emprestado';
    const STATUS_DISPONIVEL = 'disponivel';
    const STATUS_RESERVADO = 'reservado';
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
    
    public function retiradas() {
        return $this->belongsToMany(Retirada::class, 'retirada_has_exemplares', 'exemplar_id', 'retirada_id');
    }
    
    public function editaStatusParaEmprestado($exemplaresIds) {
        $this->editaStatusExemplares($exemplaresIds, self::STATUS_EMPRESTADO);
    }
    
    public function editaStatusParaDisponivel($exemplaresIds) {
        $this->editaStatusExemplares($exemplaresIds, self::STATUS_DISPONIVEL);
    }
    
    public function editaStatusExemplares($exemplaresIds, $status) {
        foreach ($exemplaresIds as $exemplarId) {
            $e = self::findOrFail($exemplarId);
            $e->update(['status' => $status]);
        }        
    }
    
    public static function getStatus() {
        return array(
            self::STATUS_EMPRESTADO => 'Emprestado',
            self::STATUS_DISPONIVEL => 'Disponível'
        );
    }
    
    public static function getNomeStatus($status) {
        return self::getStatus()[$status];
    }

    public function getNomeCompletoExemplarAttribute() {
        return 'L:' . $this->livro->nome . ' - Ex:' . $this->id;
    }

    
}
