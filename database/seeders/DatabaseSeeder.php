<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            PriceListTableSeeder::class,
            TransactionsTableSeeder::class,
            DocumentsTableSeeder::class,
            LogsTableSeeder::class,
        ]);
    }
}
