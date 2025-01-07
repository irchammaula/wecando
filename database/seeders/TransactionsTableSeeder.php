<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsTableSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data transaksi untuk user tertentu
        DB::table('transactions')->insert([
            [
                'user_id' => 13,  // Admin
                'amount' => 5000.00,
                'balance_used' => 3000.00,
                'remaining_balance' => 2000.00,
                'check_count' => 1,
                'payment_status' => 'completed',
                'payment_method' => 'bank_transfer',
                'transaction_id' => 'TX12345',
            ],
            [
                'user_id' => 14,  // Customer
                'amount' => 5000.00,
                'balance_used' => 5000.00,
                'remaining_balance' => 0.00,
                'check_count' => 2,
                'payment_status' => 'completed',
                'payment_method' => 'credit_card',
                'transaction_id' => 'TX12346',
            ],
        ]);
    }
}
