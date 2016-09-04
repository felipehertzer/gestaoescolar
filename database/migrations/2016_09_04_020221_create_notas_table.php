<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function(Blueprint $table) {
            $table->increments('id');
            $table->float('nota');
            $table->integer('id_avaliacao')->unsigned();
            $table->foreign('id_avaliacao')->references('id')->on('avaliacoes');
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
        Schema::drop('notas');
    }
}
