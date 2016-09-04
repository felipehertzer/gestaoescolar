<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateListaesperaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listaespera', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_serie')->unsigned();
            $table->foreign('id_serie')->references('id')->on('series');
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
        Schema::drop('listaespera');
    }
}
