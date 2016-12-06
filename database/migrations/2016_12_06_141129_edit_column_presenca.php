<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditColumnPresenca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presencas', function ($table) {
            $table->dropForeign(['id_materia_professor']);
            $table->dropColumn('id_materia_professor');

            $table->integer('id_materia_turma')->unsigned()->after('id');
            $table->foreign('id_materia_turma')->references('id')->on('materia_has_turma')->onDelete('restrict')->onUpdate('cascade');
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
