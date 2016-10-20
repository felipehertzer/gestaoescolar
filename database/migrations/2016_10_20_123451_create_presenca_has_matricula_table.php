<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePresencaHasMatriculaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presenca_has_matricula', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_presenca')->unsigned();
            $table->foreign('id_presenca')->references('id')->on('presencas');
            $table->integer('id_matricula')->unsigned();
            $table->foreign('id_matricula')->references('id')->on('matriculas');
            $table->enum('presenca', ['presente', 'falta'])->default('presente');
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
        Schema::drop('presenca_has_matricula');
    }
}
