<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeriadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feriados', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('dia');
            $table->integer('mes');
            $table->integer('ano');
            $table->enum('tipo', ['municipal', 'estadual']);
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
        Schema::drop('feriados');
    }
}
