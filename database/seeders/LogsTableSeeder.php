<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogsTableSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan log aktivitas admin dan customer
        DB::table('logs')->insert([
            [
                'user_id' => 13,  // Admin
                'role_id' => 1,  // Admin
                'action' => 'Admin login and checked document',
                'ip_address' => '192.168.1.1',
                'user_agent' => 'Mozilla/5.0',
            ],
            [
                'user_id' => 14,  // Customer
                'role_id' => 2,  // Customer
                'action' => 'Customer uploaded a document for plagiarism check',
                'ip_address' => '192.168.1.2',
                'user_agent' => 'Mozilla/5.0',
            ],
        ]);
    }
}
