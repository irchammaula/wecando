<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentsTableSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data dokumen yang diunggah oleh customer
        DB::table('documents')->insert([
            [
                'user_id' => 14,  // Pastikan user_id ada di tabel users
                'file_path' => 'uploads/documents/document1.pdf',
                'status' => 'pending',
                'plagiarism_file' => null,  // Belum ada file hasil pengecekan plagiarisme
            ],
            [
                'user_id' => 14,  // Pastikan user_id ada di tabel users
                'file_path' => 'uploads/documents/document2.pdf',
                'status' => 'checked',
                'plagiarism_file' => 'uploads/plagiarism_results/result1.pdf',  // Hasil pengecekan plagiarisme
            ],
        ]);
    }
}
