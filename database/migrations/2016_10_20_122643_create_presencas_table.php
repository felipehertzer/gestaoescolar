<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePresencasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presencas', function(Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->integer('id_materia_professor')->unsigned();
            $table->foreign('id_materia_professor')->references('id')->on('materia_has_professor');
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
        Schema::drop('presencas');
    }
}
