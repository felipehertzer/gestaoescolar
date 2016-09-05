<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExemplaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exemplares', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('estante');
            $table->integer('prateleira');
            $table->enum('status', ['emprestado', 'disponivel']);
            $table->boolean('danificado');
            $table->integer('livro_id')->unsigned();
            $table->foreign('livro_id')->references('id')->on('livros');
            $table->integer('tipoexemplar_id')->unsigned();
            $table->foreign('tipoexemplar_id')->references('id')->on('tipoexemplares');
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
        Schema::drop('exemplares');
    }
}
