<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;  // Pastikan untuk mengimpor Str

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google and either log them in or register them.
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            dd($googleUser);

            // Check if the user already exists by google_id
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                Auth::login($user);
                return redirect()->route('customer.dashboard');
            } else {
                $userData = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'balance' => 0,
                    'password' => Hash::make(Str::random(16)), // Generate a random password for new users
                    'phone' => '000000', // Generate a random password for new users
                ]);

                if ($userData) {
                    Auth::login($userData);
                    return redirect()->route('customer.dashboard');
                }
            }
        } catch (Exception $e) {
            dd($e);
        }
        // Retrieve user from Google

    }
}
