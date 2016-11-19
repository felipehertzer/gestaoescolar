<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReservaHasExemplaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_has_exemplares', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('reserva_id')->unsigned();
            $table->foreign('reserva_id')->references('id')->on('reservas')->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('exemplar_id')->unsigned();
            $table->foreign('exemplar_id')->references('id')->on('exemplares')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reserva_has_exemplares');
    }
}
