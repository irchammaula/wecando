<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DocumentCheckedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customerName;
    protected $filePath;

    /**
     * Create a new message instance.
     *
     * @param string $filePath
     * @param string $customerName
     */
    public function __construct($filePath, $customerName)
    {
        $this->filePath = $filePath;
        $this->customerName = $customerName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Hasil Pemeriksaan Dokumen')
            ->view('emails.document_checked') // Menggunakan template email
            ->with(['customerName' => $this->customerName])
            ->attach(Storage::path($this->filePath)); // Lampirkan file
    }
}
