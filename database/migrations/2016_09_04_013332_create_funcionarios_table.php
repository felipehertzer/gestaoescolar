<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('pis');
            $table->integer('id_pessoas')->unsigned();
            $table->foreign('id_pessoas')->references('id')->on('pessoas');
            $table->integer('id_funcao')->unsigned();
            $table->foreign('id_funcao')->references('id')->on('funcoes');
            $table->float('salario');
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
        Schema::drop('funcionarios');
    }
}
