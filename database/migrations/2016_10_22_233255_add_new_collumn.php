<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewCollumn extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('multas', function (Blueprint $table) {
            $table->integer('retirada_id')->unsigned()->after('data_pagamento');
            $table->foreign('retirada_id')->references('id')->on('retiradas')->onDelete('cascade')->onUpdate('cascade');
            
            $table->enum('status', ['nao_pago', 'pago'])->after('valor');
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
