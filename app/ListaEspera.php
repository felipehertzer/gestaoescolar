<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaEspera extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'listaespera';

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
    protected $fillable = ['id_aluno', 'id_serie', 'observacoes'];

    public function aluno() {
        return $this->belongsTo(Aluno::class, 'id_aluno');
    }

    public function serie() {
        return $this->belongsTo(Serie::class, 'id_serie');
    }

    public static function adicionar($dados) {
        $dados['id_serie'] = Turma::findOrFail($dados['id_turma'])->id_serie;
        ListaEspera::create($dados);
    }

    public static function realizar_matricula($id) {
        $listaespera = ListaEspera::findOrFail($id)->toArray();
        $turmasDaSerie = self::getTurmasPorSerie($listaespera['id_serie']);
        foreach ($turmasDaSerie as $turma) {
            $temVagasNaTurma = Matricula::temVagasNaTurma($turma['id']);
            if ($temVagasNaTurma) {
                $listaespera['id_turma'] = $turma['id'];
                ListaEspera::destroy($id);
                return Matricula::create($listaespera)->id;
            }
        }

        throw new \Exception('Ainda não há vagas nessa série!');
    }

    public static function getTurmasPorSerie($id_serie) {
        return Turma::where('id_serie', $id_serie)->get()->toArray();
    }

}
