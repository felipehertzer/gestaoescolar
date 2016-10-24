<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMatriculaMultas extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('multas', function (Blueprint $table) {
            $table->integer('matricula_id')->unsigned()->after('data_pagamento');
            $table->foreign('matricula_id')->references('id')->on('matriculas')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('multas', function(Blueprint $table) {
            DB::statement('ALTER TABLE multas CHANGE retirada_id retirada_id INT(10) UNSIGNED NULL');
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
