<?php

// namespace App\Http\Controllers;

// use App\Models\User;
// use App\Models\Saldo;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Response;

// class CallbackController extends Controller
// {
//     // Isi dengan private key anda
//     protected $privateKey = 'A22kU-8y0Te-QsKoP-DG1gD-pCvjA';

//     public function handle(Request $request)
//     {
//         $json = $request->getContent();
//         $data = json_decode($json);

//         if (JSON_ERROR_NONE !== json_last_error()) {
//             return Response::json([
//                 'success' => false,
//                 'message' => 'Invalid data sent by Tripay',
//             ]);
//         }

//         $reference = $data->reference;

//         // dd($reference);
//         $merchantRef = $data->merchant_ref;
//         $status = strtoupper((string) $data->status);

//         $saldokuy = Saldo::where('reference', $reference)->first();

//         // dd($saldokuy);

//         // Mencari saldo yang sesuai dengan merchant_ref
//         $saldo = Saldo::where('merchant_ref', $merchantRef)->first();

//         // if (! $saldokuy) {
//         //     return Response::json([
//         //         'success' => false,
//         //         'message' => 'No saldo found for tripay_ref: ' . $reference,
//         //     ]);
//         // }

//         if (! $saldo) {
//             return Response::json([
//                 'success' => false,
//                 'message' => 'No saldo found for merchant_ref: ' . $merchantRef,
//             ]);
//         }

//         // Update status saldo berdasarkan status pembayaran
//         switch ($status) {
//             case 'PAID':
//                 $saldo->update(['status' => 'PAID']);
//                 break;
//             case 'UNPAID':
//                 $saldo->update(['status' => 'UNPAID']);
//                 break;
//             case 'EXPIRED':
//                 $saldo->update(['status' => 'UNPAID']);
//                 break;
//             case 'FAILED':
//                 $saldo->update(['status' => 'UNPAID']);
//                 break;
//             default:
//                 return Response::json([
//                     'success' => false,
//                     'message' => 'Unrecognized payment status',
//                 ]);
//         }

//         return Response::json(['success' => true]);
//     }

//     public function updateBalance($userId, $amount)
//     {
//         $user = User::find($userId);
//         if ($user) {
//             $user->balance += $amount;
//             $user->save();
//         }
//     }
// }
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CallbackController extends Controller
{
    protected $privateKey;

    public function __construct()
    {
        $this->privateKey = env('TRIPAY_PRIVATE_KEY');
    }

    public function handle(Request $request)
    {
        $json = $request->getContent();
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return Response::json(['success' => false, 'message' => 'Invalid data sent by Tripay']);
        }

        $reference = $data['reference'];
        $merchantRef = $data['merchant_ref'];
        $status = strtoupper($data['status']);

        $saldo = Saldo::where('merchant_ref', $merchantRef)->first();

        if (!$saldo) {
            return Response::json(['success' => false, 'message' => 'No saldo found for tripay_ref: ' . $reference]);
        }

        switch ($status) {
            case 'PAID':
                $saldo->update(['status' => 'PAID']);
                $this->updateBalance($saldo->user_id, $saldo->amount);
                break;
            case 'UNPAID':
            case 'EXPIRED':
            case 'FAILED':
                $saldo->update(['status' => 'UNPAID']);
                break;
            default:
                return Response::json(['success' => false, 'message' => 'Unrecognized payment status']);
        }

        return Response::json(['success' => true]);
    }

    public function updateBalance($userId, $amount)
    {
        try {
            $user = User::find($userId);
            if ($user) {
                $user->balance += $amount;
                $user->save();
            }
        } catch (\Exception $e) {
            // Log kesalahan
        }
    }
}
