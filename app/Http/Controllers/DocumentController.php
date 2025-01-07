<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PriceList;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    // Tampilkan daftar dokumen
    public function index()
    {
        // $pricelist = config('pricelist');
        $pl = PriceList::all();
        $saldo = User::where('id', Auth::id())->first();
        $documents = Document::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')  // Urutkan berdasarkan 'created_at' dari terbaru
            ->get();
        return view('customer.cekturnitin', ['dokument' => $documents, 'saldohuy' => $saldo, 'pricelist' => $pl]);
    }

    // Upload dokumen
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx',
            'description' => 'nullable|string',
        ]);

        $user = auth()->user();

        if ($user->quota <= 0) {
            session()->flash('error', 'Kuota tidak Cukup');
            return back();
        }

        $filePath = $request->file('file')->store('uploads/documents');

        $document = Document::create([
            'transaction_id' => uniqid(), // Auto-generate ID transaksi
            'name' => $request->name,
            'file_path' => $filePath,
            'description' => $request->description,
            'user_id' => auth()->id(),
            'status' => 'pending',
            'uploaded_at' => now(),
        ]);

        $user->decrement('quota', 1);
        return redirect()->route('customer.cekturnitin')->with('success', 'Dokumen berhasil diupload.');
    }



    public function download(Document $dokument)
    {
        if ($dokument->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki akses ke dokumen ini.');
        }

        // Validasi bahwa dokumen sudah diperiksa admin
        if ($dokument->status !== 'checked') {
            return back()->with('error', 'Dokumen belum diperiksa oleh admin.');
        }


        return Storage::download($dokument->file_path);
    }

    public function belikuota(Request $request)
    {
        $request->validate([
            'jumlah_cek' => 'required|integer|min:1',
        ]);

        $user = auth()->user();

        // Cari harga di tabel Pricelist
        $pricelist = Pricelist::where('jumlah_cek', $request->jumlah_cek)->first();

        if (!$pricelist) {
            session()->flash('error', 'Jumlah cek tidak valid');
            return back();
        }

        $harga = $pricelist->harga;

        // Cek apakah balance mencukupi
        if ($user->balance < $harga) {
            session()->flash('error', 'Saldo tidak mencukupi');
            return back();
        }

        // Kurangi balance dan tambahkan quota
        $user->decrement('balance', $harga);
        $user->increment('quota', $request->jumlah_cek);

        session()->flash('success', 'Berhasil membeli kuota');
        return back();
    }
}
