<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom baru
            $table->string('google_id')->nullable()->after('email'); // Kolom google_id baru
            $table->string('google_token')->nullable()->after('google_id'); // Kolom google_token baru
            $table->string('google_refresh_token')->nullable()->after('google_token'); // Kolom google_refresh_token baru
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom yang telah ditambahkan
            $table->dropColumn(['google_id', 'google_token', 'google_refresh_token']);
        });
    }
};
