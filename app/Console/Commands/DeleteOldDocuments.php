<?php

// Command: DeleteOldDocuments.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DeleteOldDocuments extends Command
{
    protected $signature = 'documents:delete-old';
    protected $description = 'Hapus dokumen yang sudah lebih dari 24 jam';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $documents = Document::where('uploaded_at', '<', now()->subDay())->get();

        foreach ($documents as $document) {
            // Hapus file dari storage
            if (Storage::exists($document->file_path)) {
                Storage::delete($document->file_path);
            }

            // Hapus data dokumen dari database
            $document->delete();
        }

        $this->info('Dokumen yang sudah lebih dari 24 jam telah dihapus.');
    }
}
