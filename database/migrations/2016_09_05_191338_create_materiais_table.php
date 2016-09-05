<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMateriaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiais', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('id_tipomaterial')->unsigned();
            $table->foreign('id_tipomaterial')->references('id')->on('tipomaterial');
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
        Schema::drop('materiais');
    }
}
