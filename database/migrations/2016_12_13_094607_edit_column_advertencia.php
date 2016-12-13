<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditColumnAdvertencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertencias', function ($table) {
            $table->dropForeign(['id_matricula']);
            $table->dropColumn('id_matricula');

            $table->integer('id_aluno')->unsigned()->after('id');
            $table->foreign('id_aluno')->references('id')->on('alunos')->onDelete('restrict')->onUpdate('cascade');
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
