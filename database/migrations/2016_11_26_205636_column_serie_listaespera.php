<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ColumnSerieListaespera extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('listaespera', function ($table) {
            $table->dropForeign(['id_turma']);
            $table->dropColumn('id_turma');

            $table->integer('id_serie')->unsigned()->after('id_aluno');
            $table->foreign('id_serie')->references('id')->on('series')->onDelete('restrict')->onUpdate('cascade');
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
