<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfessoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professores', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('pis');
            $table->integer('id_pessoas')->unsigned();
            $table->foreign('id_pessoas')->references('id')->on('pessoas');
            $table->float('salario');
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
        Schema::drop('professores');
    }
}
