<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsReservasAndExemplares extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('reservas', function (Blueprint $table) {
            $table->enum('status', ['reservado', 'retirado'])->default('reservado')->after('matricula_id');
        });
        
        Schema::table('exemplares', function (Blueprint $table) {
            $table->boolean('reservado')->default(0)->after('danificado');
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
