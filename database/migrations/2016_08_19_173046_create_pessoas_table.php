<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('cpf');
            $table->string('password');
            $table->enum('sexo', ['masculino', 'feminino']);
            $table->date('dataNascimento');
            $table->string('email');
            $table->string('telefoneFixo');
            $table->string('telefoneCelular');
            $table->enum('status', ['ativo', 'inativo']);
            $table->enum('tipo', ['a', 'r', 'p', 'f']);
            $table->string('endereco');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pessoas');
    }
}
