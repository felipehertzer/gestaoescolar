<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multas', function(Blueprint $table) {
            $table->increments('id');
            $table->float('valor');
            $table->dateTime('data_pagamento')->nullable();
            $table->integer('id_tipomulta')->unsigned();
            $table->foreign('id_tipomulta')->references('id')->on('tipomulta');
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
        Schema::drop('multas');
    }
}
