<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function(Blueprint $table) {
            $table->increments('id');
            $table->dateTime('data_reserva');
            $table->dateTime('data_agenda');
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
        Schema::drop('reservas');
    }
}
