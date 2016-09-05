<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMateriaHasProfessorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materia_has_professor', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_materia')->unsigned();
            $table->foreign('id_materia')->references('id')->on('materias');
            $table->integer('id_professor')->unsigned();
            $table->foreign('id_professor')->references('id')->on('professores');
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
        Schema::drop('materia_has_professor');
    }
}
