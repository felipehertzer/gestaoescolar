<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRetiradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retiradas', function(Blueprint $table) {
            $table->increments('id');
            $table->date('data_retirada');
            $table->date('data_devolucao');
            $table->integer('renovacao');
            $table->enum('status', ['retirado', 'devolvido']);
            $table->integer('matricula_id');
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
        Schema::drop('retiradas');
    }
}
