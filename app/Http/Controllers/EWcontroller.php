<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EWcontroller extends Controller
{
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
            return view('servis', ['products' => $response['message']]);
        } else {
            return back()->withErrors(['error' => $response['message']]);
        }
    }
}
