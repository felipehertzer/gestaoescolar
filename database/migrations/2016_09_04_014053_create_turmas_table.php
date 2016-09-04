<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas', function(Blueprint $table) {
            $table->increments('id');
            $table->enum('turno', ['manha', 'tarde', 'noite']);
            $table->integer('vagas');
            $table->integer('numero_turma');
            $table->integer('id_serie')->unsigned();
            $table->foreign('id_serie')->references('id')->on('series');
            $table->integer('id_sala')->unsigned();
            $table->foreign('id_sala')->references('id')->on('salas');
            $table->integer('ano');
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
        Schema::drop('turmas');
    }
}
