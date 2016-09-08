<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMateriaHasTurmaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materia_has_turma', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_materia_professor')->unsigned();
            $table->foreign('id_materia_professor')->references('id')->on('materia_has_professor');
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
        Schema::drop('materia_has_turma');
    }
}
