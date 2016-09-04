<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAvaliacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacoes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->float('peso');
            $table->text('observacoes');
            $table->integer('trimestre');
            $table->enum('tipo', ['normal','exame'])->default('normal');
            $table->integer('id_professor')->unsigned();
            $table->foreign('id_professor')->references('id')->on('professores');
            $table->integer('id_materia')->unsigned();
            $table->foreign('id_materia')->references('id')->on('materias');
            $table->integer('id_turma')->unsigned();
            $table->foreign('id_turma')->references('id')->on('turmas');
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
        Schema::drop('avaliacoes');
    }
}
