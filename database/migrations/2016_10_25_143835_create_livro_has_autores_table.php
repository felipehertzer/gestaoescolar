<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLivroHasAutoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livro_has_autores', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('livro_id')->unsigned();
            $table->foreign('livro_id')->references('id')->on('livros')->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('autor_id')->unsigned();
            $table->foreign('autor_id')->references('id')->on('autores')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('livro_has_autores');
    }
}
