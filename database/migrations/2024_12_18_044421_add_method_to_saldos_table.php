<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('saldos', function (Blueprint $table) {
            $table->string('method')->after('merchant_ref'); // Menambahkan kolom 'method' setelah kolom 'merchant_ref'
        });
    }

    public function down()
    {
        Schema::table('saldos', function (Blueprint $table) {
            $table->dropColumn('method'); // Menghapus kolom 'method' jika migration di-revert
        });
    }
};
