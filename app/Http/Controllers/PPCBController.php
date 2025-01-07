<?php

namespace App\Http\Controllers;

use App\Models\CBTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PPCBController extends Controller
{
    public function index(Request $request)
    {
        // Ambil user yang sedang login
        $user = $request->user();

        // Ambil data transaksi berdasarkan user_id
        $transactions = CBTransaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Return view dengan data transaksi
        return view('customer.riwayat', compact('transactions'));
    }
    public function handleCallback(Request $request)
    {
        // Pastikan hanya menerima request dari IP PortalPulsa
        $data = $request->input('content');

        // Pastikan hanya menerima request dari IP yang benar
        $ip = $request->server('HTTP_X_FORWARDED_FOR') ?? $request->ip();
        if ($ip !== '172.104.161.223') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Validasi jika data transaksi tidak lengkap
        if (empty($data['trxid_api']) || empty($data['code']) || empty($data['phone']) || empty($data['status'])) {
            return response()->json(['error' => 'Invalid data'], 400);
        }

        // Simpan transaksi ke dalam database jika status sukses (4)
        if ($data['status'] === 4) {
            try {
                $transaction = CBTransaction::create([
                    'user_id' => auth()->check() ? auth()->id() : null, // Asumsikan transaksi terkait dengan user yang sedang login, bisa null jika tidak login
                    'trxid_api' => $data['trxid_api'],
                    'code' => $data['code'],
                    'phone' => $data['phone'],
                    'idcust' => $data['idcust'] ?? '',
                    'sequence' => $data['sequence'],
                    'status' => $data['status'],
                    'sn' => $data['sn'],
                    'note' => $data['note'],
                    'price' => $data['price'],
                    'date_insert' => $data['date_insert'],
                    'date_update' => $data['date_update'],
                    'last_balance' => $data['last_balance'],
                ]);

                // Log data untuk analisis lebih lanjut
                Log::info('Transaksi diterima:', $data);

                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                // Log error jika transaksi gagal disimpan
                Log::error('Gagal menyimpan transaksi:', ['error' => $e->getMessage()]);

                return response()->json(['error' => 'Failed to save transaction'], 500);
            }
        }

        // Jika status bukan sukses, tidak simpan transaksi
        return response()->json(['error' => 'Transaction not successful'], 400);
    }
}
