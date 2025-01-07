<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Document;
use App\Models\PriceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $pricelist = PriceList::all();
        $dokumen = Document::where('id', Auth::id())->first(); // Mendapatkan dokumen customer
        $saldo = User::where('id', Auth::id())->first(); // Mendapatkan saldo user

        $Documents = Document::where('user_id', Auth::id())
            ->where('transaction_id', Auth::id())
            ->count();

        // Menghitung jumlah dokumen dengan status 'pending' untuk customer yang sedang login
        $pendingDocuments = Document::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->count();

        // Menghitung jumlah dokumen dengan status 'checked' untuk customer yang sedang login
        $checkedDocuments = Document::where('user_id', Auth::id())
            ->where('status', 'checked')
            ->count();

        // Arahkan ke view dashboard dengan parameter saldo, dokumen, pendingDocuments, checkedDocuments
        return view('customer.dashboard', [
            'saldok' => $saldo,
            'halah' => $Documents,
            'dok' => $dokumen,
            'pendingDocuments' => $pendingDocuments,
            'checkedDocuments' => $checkedDocuments,
            'pl' => $pricelist
        ]);
    }

    public function belipulsaindex()
    {
        return view('customer.belipulsa');
    }

    public function belipulsa(Request $request) {}
}
