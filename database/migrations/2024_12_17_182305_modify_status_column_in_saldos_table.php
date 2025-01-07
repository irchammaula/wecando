<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStatusColumnInSaldosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saldos', function (Blueprint $table) {
            // Ubah kolom 'status' menjadi ENUM
            $table->enum('status', ['PAID', 'UNPAID'])->default('UNPAID')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saldos', function (Blueprint $table) {
            // Kembalikan ke tipe data sebelumnya, misalnya string
            $table->string('status')->default('pending')->change();
        });
    }
}
