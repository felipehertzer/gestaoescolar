<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Multa extends Model {

    const STATUS_PAGO = 'pago';
    const STATUS_NAO_PAGO = 'nao_pago';
    
    const VALOR_MULTA_POR_DIA = 0.50;
    const NOME_TIPO_MULTA_ATRASO_DEVOLUCAO_LIVROS = "ATRASO DEVOLUÇÃO DE LIVROS";

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'multas';

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
    protected $fillable = ['valor', 'data_pagamento', 'status', 'matricula_id', 'retirada_id', 'tipomulta_id'];

    public function matricula() {
        return $this->belongsTo(Matricula::class);
    }
    
    public function tipomulta() {
        return $this->belongsTo(TipoMulta::class);
    }
    
    public function retirada() {
        return $this->belongsTo(Retirada::class);
    }

    /**
     * Cria uma multa para a $retirada_id da matricula $matricula_id
     * 
     * @param int $matricula_id
     * @param int $retirada_id
     * @param date $dataDevolucao
     * @return int $id da multa adicionada
     * @throws Exception
     */
    public function adicionaMultaAtrasoLivros($retirada_id, $matricula_id, $dataDevolucao) {

        $this->valor = self::getValorMulta($dataDevolucao);
        $this->status = self::STATUS_NAO_PAGO;
        $this->data_pagamento = NULL;
        $this->retirada_id = $retirada_id;
        $this->matricula_id = $matricula_id;
        $this->tipomulta_id = $this->getIdTipoMultaAtrasoDevolucaoLivros();

        if (!$this->save()) {
            throw new \Exception('Não foi possível adicionar a multa!');
        }

        return $this->id;
    }
    
    /**
     * Retorna o id do tipo de multa de atraso de devolução de livros
     * Se não existe esse tipo, entao chama funcao que cria ela
     * @return int
     */
    public function getIdTipoMultaAtrasoDevolucaoLivros() {
        $tipoMulta = TipoMulta::where('nome', '=', self::NOME_TIPO_MULTA_ATRASO_DEVOLUCAO_LIVROS)->first();
        if(empty($tipoMulta)) {
            $tipoMulta = $this->criaTipoMultaAtrasoDevolucaoLivros();
        }
        
        return $tipoMulta->id;
    }
    
    /**
     * 
     * @return object
     */
    public function criaTipoMultaAtrasoDevolucaoLivros() {        
        return TipoMulta::create(['nome' => self::NOME_TIPO_MULTA_ATRASO_DEVOLUCAO_LIVROS]);
    }
    
    public static function getStatus() {
        return [
            self::STATUS_NAO_PAGO => 'Não Pago',
            self::STATUS_PAGO => 'Pago'
        ];
    }
    
    public static function getNomeStatus($status) {
        return self::getStatus()[$status];
    }

    /**
     * Retorna o valor da multa dos dias de atraso * valor de multa por dia
     * 
     * @param date $dataDevolucao
     * @return float
     */
    public static function getValorMulta($dataDevolucao) {
        $dataAtual = date('Y-m-d');
        $diasMulta = self::getDiferencaEmDiasDatas($dataDevolucao, $dataAtual);
        return $diasMulta * self::VALOR_MULTA_POR_DIA;
    }

    /**
     * Retorna a diferenca em dias entre duas datas
     * 
     * @param date $data1
     * @param date $data2
     * @return int
     */
    public static function getDiferencaEmDiasDatas($data1, $data2) {
        $date1 = Carbon::createFromFormat('Y-m-d', $data1);
        $date2 = Carbon::createFromFormat('Y-m-d', $data2);

        return $date2->diffInDays($date1);
    }
    
    /**
     * Atualiza os campos status para pago e data de pagamento para a data atual
     * @param int $id
     */
    public static function pagarMulta($id) {        
        $multa = Multa::findOrFail($id);
        if($multa->status == self::STATUS_PAGO) {
            throw new \Exception('Multa já está paga!');
        }
        
        $multa->update(['status' => self::STATUS_PAGO, 'data_pagamento' => date('Y-m-d')]);
    }

}
