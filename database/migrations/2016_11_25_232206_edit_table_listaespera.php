<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTableListaespera extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('listaespera', function ($table) {
            $table->dropForeign(['id_serie']);
            $table->dropForeign(['id_matricula']);

            $table->dropColumn('id_serie');
            $table->dropColumn('id_matricula');

            $table->integer('id_aluno')->unsigned()->after('id');
            $table->foreign('id_aluno')->references('id')->on('alunos')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('id_turma')->unsigned()->after('id_aluno');
            $table->foreign('id_turma')->references('id')->on('turmas')->onDelete('cascade')->onUpdate('cascade');
            
            $table->text('observacoes')->after('id_turma')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
