<?php

namespace App\Http\Controllers;

use App\Mail\DocumentCheckedMail;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $TurnitinCount = Document::count();
        return view('admin.dashboard', ['hitung_user' => $userCount, 'hitung_doc' => $TurnitinCount]); // Buat view di resources/views/admin/dashboard.blade.php
    }

    public function dokumenindex()
    {
        $documentsChecked = Document::where('status', 'checked')
            ->orderBy('created_at', 'desc')  // Urutkan berdasarkan 'created_at' dari terbaru
            ->get();

        return view('admin.turnitin', compact('documentsChecked'));
    }
    public function dokumenindex2()
    {
        $documentsPending = Document::where('status', 'pending')
            ->orderBy('created_at', 'desc')  // Urutkan berdasarkan 'created_at' dari terbaru
            ->get();

        return view('admin.turnitinuncheck', compact('documentsPending'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:checked', // Hanya bisa di-set ke checked
        ]);

        $document = Document::findOrFail($id);
        $document->status = 'checked'; // Update status menjadi checked
        $document->save();

        return redirect()->route('admin.turnitin')->with('success', 'Dokumen berhasil diperiksa.');
    }

    // Mendownload dokumen yang sudah di-upload
    public function download($id)
    {
        $document = Document::findOrFail($id);
        return response()->download(storage_path("app/public/{$document->file_path}"));
    }

    // Meng-upload dokumen yang sudah diperiksa oleh admin
    public function uploadChecked(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx', // Format dokumen yang diperiksa
        ]);

        $document = Document::findOrFail($id);

        // Upload file hasil pemeriksaan
        $filePath = $request->file('file')->store('uploads/checked_documents');
        $document->file_path = $filePath;
        $document->status = 'checked'; // Ubah status menjadi checked
        $document->save();

        $customer = $document->user;

        // dd($customer);

        // Kirim email dengan file sebagai lampiran
        Mail::to($customer->email)->send(
            new DocumentCheckedMail($filePath, $customer->name)
        );

        return redirect()->route('admin.turnitin')->with('success', 'Dokumen hasil pemeriksaan berhasil di-upload.');
    }
    public function datauser()
    {
        return view('admin.datauser');
    }
}
