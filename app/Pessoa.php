<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Pessoa extends Authenticatable
{
    use EnumTrait;
	const PESSOA_ALUNO = '3';
    const PESSOA_PROFESSOR = '1';
	const PESSOA_FUNCIONARIO = '0';
	const PESSOA_RESPONSAVEL = '2';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pessoas';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'email', 'dataNascimento', 'cpf', 'password', 'telefoneFixo', 'telefoneCelular', 'status', 'sexo', 'endereco', 'tipopessoa'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function professor()
    {
        return $this->hasOne(Professor::class, 'id_pessoas');
    }

    public function funcionario()
    {
        return $this->hasOne(Funcionario::class, 'id_pessoas');
    }

    public function aluno()
    {
        return $this->hasOne(Aluno::class, 'id_pessoas');
    }

    public function responsavel()
    {
        return $this->hasOne(Responsavel::class, 'id_pessoas');
    }

    public function funcao()
    {
        return $this->belongsTo(Funcao::class);
    }
	
	public static function getTipoPessoa() {
        return array(
            self::PESSOA_ALUNO => 'Aluno',
            self::PESSOA_PROFESSOR => 'Professor',
            self::PESSOA_FUNCIONARIO => 'Funcionário',
            self::PESSOA_RESPONSAVEL => 'Responsável'
        );
    }
	
	public static function getNomeTipoPessoa($tipopessoa) {
        return self::getTipoPessoa()[$tipopessoa];
    }
}
