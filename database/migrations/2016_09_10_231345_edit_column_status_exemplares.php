<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditColumnStatusExemplares extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('exemplares', function(Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('exemplares', function(Blueprint $table) {
            $table->enum('status', ['emprestado', 'disponivel'])->after('prateleira');
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
