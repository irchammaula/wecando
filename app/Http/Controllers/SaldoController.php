<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Saldo;
use GuzzleHttp\Client;
use App\Models\PriceList;
use App\Models\UserBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class SaldoController extends Controller


{
    public function index()
    {
        $saldocuy = Saldo::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')  // Urutkan berdasarkan 'created_at' dari terbaru
            ->get();
        return view('customer.isisaldo', ['saldo' => $saldocuy]);
    }

    public function createTopup(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer|min:3000',
            'method' => 'required|string',
        ]);

        $user = Auth::user();

        $apiKey       = config('services.tripay.api_key');
        $privateKey   = config('services.tripay.private_key');
        $merchantCode = config('services.tripay.merchant_code');
        $merchantRef  = 'INV-' . time(); // Unique ID
        $amount       = $request->amount;

        $data = [
            'method'        => $request->method,
            'merchant_ref'  => $merchantRef,
            'amount'        => $amount,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'order_items' => [
                [
                    'name' => 'Topup Saldo',
                    'price' => $request->amount,
                    'quantity' => 1,
                ]
            ],
            'customer_phone' => $user->phone,
            'return_url'    => route('customer.isisaldo'),
            'expired_time'  => time() + (24 * 60 * 60),
            'signature'     => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            return back()->withErrors(['error' => 'Failed to create transaction.']);
        }

        $result = json_decode($response, true);

        if ($result['success']) {
            // Simpan transaksi di database
            $saldo = Saldo::create([
                'user_id'      => $user->id,
                'merchant_ref' => $merchantRef,
                'amount'       => $amount,
                'method'       => $request->method, // pastikan menggunakan 'method' sesuai dengan model
                'status'       => 'unpaid',
                'checkout_url'  => $result['data']['checkout_url'],
            ]);

            // Redirect ke URL pembayaran Tripay
            return redirect($result['data']['checkout_url']);
        }

        // Menambahkan kode untuk update saldo setelah transaksi berhasil
        $saldo = Saldo::where('merchant_ref', $merchantRef)->first();

        if ($saldo && $saldo->status === 'unpaid') {

            // Log::info('Saldo Amount: ' . $saldo->amount);
            dd($saldo->amount);
            // Update status saldo menjadi paid
            $saldo->update(['status' => 'paid']);

            // Temukan user terkait dan tambah saldo
            $user = User::find($saldo->user_id);
            $user->increment('balance', $saldo->amount); // Tambahkan saldo

            // Redirect atau response sesuai kebutuhan
            return redirect()->route('customer.isisaldo')->with('success', 'Top-up berhasil!');
        }

        return back()->withErrors(['error' => $result['message'] ?? 'Failed to create transaction.']);
    }

    // public function purchaseQuota(Request $request)
    // {
    //     $validated = $request->validate([
    //         'price_list_id' => 'required|exists:price_list,id',
    //     ]);

    //     $user = auth()->user();
    //     $priceList = PriceList::find($validated['price_list_id']);

    //     if ($user->balance < $priceList->price) {
    //         return response()->json(['error' => 'Insufficient balance'], 400);
    //     }

    //     $user->decrement('balance', $priceList->price);
    //     $user->increment('quota', $priceList->check_count);

    //     return response()->json(['message' => 'Quota purchased successfully']);
    // }

    public function show($reference)
    {
        $tripay = new DetailController();
        $tripay->detail($reference);
        dd($reference);
        return view('customer.detail');
    }
}
