<?php

namespace App\Http\Controllers;

use Ilovepdf\Ilovepdf;
use Illuminate\Http\Request;

class MergePdfController extends Controller
{
    public function showForm()
    {
        // Menampilkan form untuk upload file
        return view('compresspdf');
    }

    public function merge(Request $request)
    {
        // Validasi file yang diupload
        $request->validate([
            'pdfs' => 'required|array|min:2', // Setidaknya ada 2 file
            'pdfs.*' => 'mimes:pdf|max:10240', // Maksimal 10MB per file
        ]);

        // Ambil semua file yang diupload
        $files = $request->file('pdfs');

        // Inisialisasi API iLovePDF
        $ilovepdf = new Ilovepdf(config('ilovepdf.public_id'), config('ilovepdf.secret_key'));

        // Membuat task untuk menggabungkan file
        $myTask = $ilovepdf->newTask('merge');

        // Loop untuk menambahkan semua file yang diupload ke task
        foreach ($files as $file) {
            // Menyimpan file sementara
            $path = $file->store('temp', 'public');
            $myTask->addFile(storage_path("app/public/{$path}"));
        }

        // Menetapkan nama file output
        $myTask->setOutputFilename('merged_file');

        // Menjalankan task
        $myTask->execute();

        // Mendownload file yang sudah digabung
        $outputPath = storage_path('app/public/merged_file.pdf');
        $myTask->download($outputPath);

        // Menghapus file sementara
        foreach ($files as $file) {
            $path = $file->store('temp', 'public');
            unlink(storage_path("app/public/{$path}"));
        }

        // Menyediakan file untuk diunduh
        return response()->download($outputPath)->deleteFileAfterSend(true);
    }
}
