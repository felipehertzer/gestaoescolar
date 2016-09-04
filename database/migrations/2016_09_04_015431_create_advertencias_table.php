<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdvertenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertencias', function(Blueprint $table) {
            $table->increments('id');
            $table->text('motivo');
            $table->date('data');
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
        Schema::drop('advertencias');
    }
}
