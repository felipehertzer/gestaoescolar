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
     * The attributes that should be mutated to dates.
     * 
     * @var array 
     */
    protected $dates = ['data_retirada', 'data_devolucao'];

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

    /**
     * Atualiza status da retirada para devolvido
     * @param int $id
     */
    public function editaStatusParaDevolvido($id) {
        $retirada = self::findOrFail($id);
        $atualDataDevolucao = $retirada->data_devolucao->toDateString();
        $matricula_id = $retirada->matricula_id;
        $gerouMulta = false;
        if (self::isVencidaRetirada($atualDataDevolucao)) {
            $idMulta = $this->geraMulta($id, $matricula_id, $atualDataDevolucao);
            $gerouMulta = $idMulta;
        }
        
        $retirada->update(['status' => self::STATUS_DEVOLVIDO]);
        return $gerouMulta;
    }
    
    private function geraMulta($retirada_id, $matricula_id, $dataDevolucao) {
        return (new \App\Multa)->adicionaMultaAtrasoLivros($retirada_id, $matricula_id, $dataDevolucao);
    }

    /**
     * Renova o registro da retirada por x dias e incrementa o campo renovacao.
     * Antes de renovar faz algumas validações para ver se é possivel renovar
     * 
     * @param int $id
     * @param int $dias, por default recebe 7
     * @throws \Exception
     */
    public function renovarRetirada($id, $dias = 7) {
        $retirada = self::findOrFail($id);
        self::validacoes($retirada);

        $novaDataDevolucao = $retirada->data_devolucao->addDays($dias);

        $dados = [
            'renovacao' => $retirada->renovacao + 1,
            'data_devolucao' => $novaDataDevolucao->toDateString()
        ];

        if (!$retirada->update($dados)) {
            throw new \Exception('Não foi possível renovar a retirada!');
        }
    }
    
    public static function validacoes($retirada) {
        $atualDataDevolucao = $retirada->data_devolucao->toDateString();        

        if (self::isVencidaRetirada($atualDataDevolucao)) {
            throw new \Exception('Retirada está vencida!');
        }
        
        if($retirada->renovacao == 10) {
            throw new \Exception('Limite de renovações ja foi alcançado!');
        }
    }

    public static function isVencidaRetirada($dataDevolucao) {
        $dataAtual = date('Y-m-d');
        return $dataAtual > $dataDevolucao;
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
