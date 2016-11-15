<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmprestamateriaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emprestamateriais', function(Blueprint $table) {
				$table->increments('id');
				$table->integer('materia_turma_id')->unsigned();
				$table->foreign('materia_turma_id')->references('id')->on('materia_has_turma')->onDelete('cascade')->onUpdate('cascade');
				$table->integer('material_id')->unsigned();
				$table->foreign('material_id')->references('id')->on('materiais')->onDelete('cascade')->onUpdate('cascade');
				$table->date('data');
				$table->enum('status', ['retirado', 'devolvido']);
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
        //
    }
}
