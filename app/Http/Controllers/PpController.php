<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PpController extends Controller
{

    public function ceksaldo(Request $request)
    {
        $url = 'https://portalpulsa.com/api/connect/';

        $header = array(
            'portal-userid: P241064',
            'portal-key: a51d2312a04beb8bced992e831383e01',
            'portal-secret: 07da0cfb589f26980973bbb962417f59def6972ffaefe1c9c02c1ab9b603de17',
        );

        $data = array(
            'inquiry' => 'S', // konstan
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

        // Check if the response is successful
        if ($response['result'] === 'success') {
            $message = $response['message'];
            $balance = $response['balance'];
        } else {
            $message = "Gagal mendapatkan saldo.";
            $balance = null;
        }

        return view('admin.ceksaldopulsa', compact('message', 'balance'));
    }

    public function depo(Request $request)
    {
        if ($request->isMethod('post')) {
            // Mengambil input dari form
            $nominal = $request->input('nominal');
            $bank = $request->input('bank');

            // Menyiapkan URL dan header
            $url = 'https://portalpulsa.com/api/connect/';

            $header = array(
                'portal-userid: P241064',
                'portal-key: a51d2312a04beb8bced992e831383e01',
                'portal-secret: 07da0cfb589f26980973bbb962417f59def6972ffaefe1c9c02c1ab9b603de17',
            );

            // Menyiapkan data request
            $data = array(
                'inquiry' => 'D',
                'bank' => $bank,
                'nominal' => $nominal,
            );

            // Melakukan cURL request
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

            // Decode JSON response
            $response = json_decode($result, true);

            // Periksa apakah response sukses
            if ($response['result'] === 'success') {
                $message = $response['message'];
            } else {
                $message = 'Gagal melakukan request deposit.';
            }

            return view('admin.ceksaldopulsa', compact('message'));
        }

        return view('admin.ceksaldopulsa');
    }
}
