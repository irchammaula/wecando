<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceListTableSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data harga pengecekan
        DB::table('price_lists')->insert([
            ['check_count' => 1, 'price' => 3000.00],
            ['check_count' => 2, 'price' => 5000.00],
            ['check_count' => 3, 'price' => 7000.00],
            ['check_count' => 4, 'price' => 9000.00],
            ['check_count' => 5, 'price' => 11000.00],
            ['check_count' => 6, 'price' => 13000.00],
            ['check_count' => 7, 'price' => 15000.00],
            ['check_count' => 8, 'price' => 17000.00],
            ['check_count' => 9, 'price' => 18000.00],
            ['check_count' => 10, 'price' => 20000.00],
        ]);
    }
}
