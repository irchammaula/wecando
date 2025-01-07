<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class CHController extends Controller
{
    public function topup(Request $request)
    {
        // Validasi data yang dikirimkan
        $validated = $request->validate([
            'phone' => 'required|numeric',
            'amount' => 'required|numeric',
            'code' => 'required|string', // Pastikan kode produk diterima
        ]);
        $user = auth()->user();

        // Menyimpan data dari form
        $phone = $validated['phone'];
        $amount = $validated['amount'];
        $code = $validated['code'];

        // dd($validated);

        if ($user->balance < $amount) {
            session()->flash('error', 'Saldo tidak mencukupi');
            return back();
        }
        $user->decrement('balance', $amount);

        // Data untuk dikirim ke API portalpulsa
        $url = 'https://portalpulsa.com/api/connect/';
        $header = [
            'portal-userid: P241064',
            'portal-key: a51d2312a04beb8bced992e831383e01', // lihat hasil autogenerate di member area
            'portal-secret: 07da0cfb589f26980973bbb962417f59def6972ffaefe1c9c02c1ab9b603de17', // lihat hasil autogenerate di member area
        ];

        // $no = isset($lastTransactionNumber) ? $lastTransactionNumber + 1 : 1;
        // Data transaksi
        $data = [
            'inquiry' => 'I', // Konstan
            'code' => $code, // Kode produk
            'phone' => $phone, // Nomor telepon dari form
            'idcust' => '', // ID Cust jika diperlukan
            'trxid_api' => uniqid(), // Transaction ID, gunakan ID unik
            'no' => '1', // Urutan
        ];

        // Menggunakan Guzzle untuk mengirim request POST ke API portalpulsa

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POSTREDIR, CURL_REDIR_POST_ALL);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);

        if ($result === false) {
            $error = curl_error($ch);
            return back()->withErrors(['error' => "cURL Error: $error"]);
        }

        curl_close($ch);

        // Decode the result
        $response = json_decode($result, true);


        // dd($response);
        if ($response['result'] === 'success') {
            return redirect()->route('customer.topup')->with('success', 'Top-up berhasil!');
        }
    }
    public function topupgopay(Request $request)
    {
        // Validasi data yang dikirimkan
        $validated = $request->validate([
            'gopay_phone' => 'required|numeric',
            'gopay_amount' => 'required|numeric',
            'gopay_code' => 'required|string', // Pastikan kode produk diterima
        ]);
        $user = auth()->user();

        // Menyimpan data dari form
        $phone = $validated['gopay_phone'];
        $amount = $validated['gopay_amount'];
        $code = $validated['gopay_code'];

        // dd($validated);

        if ($user->balance < $amount) {
            session()->flash('error', 'Saldo tidak mencukupi');
            return back();
        }
        $user->decrement('balance', $amount);

        // Data untuk dikirim ke API portalpulsa
        $url = 'https://portalpulsa.com/api/connect/';
        $header = [
            'portal-userid: P241064',
            'portal-key: a51d2312a04beb8bced992e831383e01', // lihat hasil autogenerate di member area
            'portal-secret: 07da0cfb589f26980973bbb962417f59def6972ffaefe1c9c02c1ab9b603de17', // lihat hasil autogenerate di member area
        ];

        // $no = isset($lastTransactionNumber) ? $lastTransactionNumber + 1 : 1;
        // Data transaksi
        $data = [
            'inquiry' => 'I', // Konstan
            'code' => $code, // Kode produk
            'phone' => $phone, // Nomor telepon dari form
            'idcust' => '', // ID Cust jika diperlukan
            'trxid_api' => uniqid(), // Transaction ID, gunakan ID unik
            'no' => '1', // Urutan
        ];
        // dd($data);

        // Menggunakan Guzzle untuk mengirim request POST ke API portalpulsa

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POSTREDIR, CURL_REDIR_POST_ALL);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        // dd($result);

        if ($result === false) {
            $error = curl_error($ch);
            return back()->withErrors(['error' => "cURL Error: $error"]);
        }

        curl_close($ch);

        // Decode the result
        $response = json_decode($result, true);


        // dd($response);
        if ($response['result'] === 'success') {
            return redirect()->route('customer.gopay')->with('success', 'Top-up berhasil!');
        }
    }

    public function tokenlistrik(Request $request)
    {
        $validated = $request->validate([
            'listrik_phone' => 'required|numeric',
            'listrik_amount' => 'required|numeric',
            'listrik_idcust' => 'required|string',
            // Pastikan kode produk diterima
            'listrik_code' => 'required|string', // Pastikan kode produk diterima
        ]);
        // dd(
        //     $validated
        // );
        $user = auth()->user();

        // Menyimpan data dari form
        $phone = $validated['listrik_phone'];
        $amount = $validated['listrik_amount'];
        $code = $validated['listrik_code'];
        $idcust = $validated['listrik_idcust'];

        // dd($validated);

        if ($user->balance < $amount) {
            session()->flash('error', 'Saldo tidak mencukupi');
            return back();
        }
        $user->decrement('balance', $amount);
        $url = 'https://portalpulsa.com/api/connect/';

        $header = array(
            'portal-userid: P241064',
            'portal-key: a51d2312a04beb8bced992e831383e01', // lihat hasil autogenerate di member area
            'portal-secret: 07da0cfb589f26980973bbb962417f59def6972ffaefe1c9c02c1ab9b603de17', // lihat hasil autogenerate di member area
        );

        $data = array(
            'inquiry' => 'PLN', // konstan
            'code' => $code, // kode produk
            'phone' => $phone, // nohp pembeli
            'idcust' => $idcust, // nomor meter atau id pln
            'trxid_api' => uniqid(), // Trxid / Reffid dari sisi client
            'no' => '1', // untuk isi lebih dari 1x dlm sehari, isi urutan 2,3,4,dst
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POSTREDIR, CURL_REDIR_POST_ALL);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        // dd($result);

        if ($result === false) {
            $error = curl_error($ch);
            return back()->withErrors(['error' => "cURL Error: $error"]);
        }

        curl_close($ch);

        // Decode the result
        $response = json_decode($result, true);

        // dd($response);


        // dd($response);
        if ($response['result'] === 'success') {
            return redirect()->route('customer.belipulsa')->with('success', 'Top-up berhasil!');
        }
    }

    public function cekharga()
    {
        $url = 'https://portalpulsa.com/api/connect/';

        $header = array(
            'portal-userid: P241064',
            'portal-key: a51d2312a04beb8bced992e831383e01', // lihat hasil autogenerate di member area
            'portal-secret: 07da0cfb589f26980973bbb962417f59def6972ffaefe1c9c02c1ab9b603de17', // lihat hasil autogenerate di member area
        );

        $data = array(
            'inquiry' => 'HARGA', // konstan
            'code' => '', // pilihan: pln, pulsa, game
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POSTREDIR, CURL_REDIR_POST_ALL);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);

        if ($result === false) {
            $error = curl_error($ch);
            return back()->withErrors(['error' => "cURL Error: $error"]);
        }

        curl_close($ch);

        // Decode the result
        $response = json_decode($result, true);

        // dd($response);

        // Check if the response is successful
        if ($response['result'] === 'success') {
            return view('customer.belipulsa', ['products' => $response['message']]);
        } else {
            return back()->withErrors(['error' => $response['message']]);
        }
    }
}
