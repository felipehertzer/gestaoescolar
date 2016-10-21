<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRetiradaHasExemplaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retirada_has_exemplares', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('retirada_id')->unsigned();
            $table->foreign('retirada_id')->references('id')->on('retiradas')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('exemplar_id')->unsigned();
            $table->foreign('exemplar_id')->references('id')->on('exemplares')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status', ['retirado', 'devolvido']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('retirada_has_exemplares');
    }
}
