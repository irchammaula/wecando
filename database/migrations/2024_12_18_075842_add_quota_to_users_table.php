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
            // $table->id();
            // $table->string('name');
            // $table->string('email')->unique();
            // $table->string('password');
            // $table->foreignId('role_id')->constrained('roles')->onDelete('cascade'); // Relasi ke roles
            // $table->decimal('balance', 10, 2)->default(0); // Saldo pengguna
            $table->integer('quota')->default(0)->change(); // Kuota cek plagiarisme
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
