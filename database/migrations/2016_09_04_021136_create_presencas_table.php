<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePresencasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presencas', function(Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->enum('presenca', ['presente', 'falta'])->default('presente');
            $table->integer('id_professor')->unsigned();
            $table->foreign('id_professor')->references('id')->on('professores');
            $table->integer('id_materia')->unsigned();
            $table->foreign('id_materia')->references('id')->on('materias');
            $table->integer('id_turma')->unsigned();
            $table->foreign('id_turma')->references('id')->on('turmas');
            $table->integer('id_matricula')->unsigned();
            $table->foreign('id_matricula')->references('id')->on('matriculas');
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
        Schema::drop('presencas');
    }
}
