<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;


// class AuthController extends Controller
// {
//     public function login(Request $request)
//     {
//         return view('login');
//     }
    // public function register()
    // {
    //     return view('register');
    // }

    // public function otentikasi(Request $request)
    // {
    //     // Validasi input
    //     $credentials = $request->validate([
    //         'email' => ['required', 'email', 'max:255'],
    //         'password' => ['required', 'string', 'min:8'],
    //     ]);

    //     // Proses autentikasi
    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate(); // Regenerasi session untuk keamanan

    //         // Redirect sesuai role
    //         if (Auth::user()->role_id == 1) {
    //             return redirect('dashboard');
    //         }

    //         if (Auth::user()->role_id == 2) {
    //             return redirect('customer');
    //         }
    //     }

    //     // Jika login gagal
    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ])->onlyInput('email');
    // }
    //     public function otentikasi(Request $request)
    //     {
    //         // Validasi input
    //         $credentials = $request->validate([
    //             'email' => ['required', 'email', 'max:255'],
    //             'password' => ['required', 'string', 'min:8'],
    //         ]);

    //         // Proses autentikasi
    //         if (Auth::attempt($credentials)) {
    //             $request->session()->regenerate(); // Regenerasi session untuk keamanan

    //             // Redirect sesuai role
    //             if (Auth::user()->role_id == 1) {
    //                 return redirect('dashboard');
    //             }

    //             if (Auth::user()->role_id == 2) {
    //                 return redirect('customer');
    //             }
    //         }

    //         // Jika login gagal, kirimkan pesan error ke session
    //         return back()->with('error', 'The provided credentials do not match our records.');
    //     }

    //     public function logout(Request $request)
    //     {
    //         Auth::logout();
    //         $request->session()->invalidate();
    //         $request->session()->regenerateToken();

    //         return redirect()->route('login');
    //     }
// }
