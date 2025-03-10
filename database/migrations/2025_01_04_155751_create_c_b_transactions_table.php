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
        Schema::create('c_b_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('trxid_api')->unique();
            $table->string('code');
            $table->string('phone');
            $table->string('idcust')->nullable();
            $table->decimal('amount', 10, 2);
            $table->integer('status')->default(0); // 0: Belum diproses
            $table->string('sn')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_b_transactions');
    }
};
