<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google and authenticate.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal melakukan login dengan Google: ' . $e->getMessage());
        }

        // 1. Check if a user with the given google_id already exists.
        $user = User::where('google_id', $googleUser->getId())->first();

        if ($user) {
            // Update token if it has changed
            $user->update([
                'google_token' => $googleUser->token,
            ]);
            
            Auth::login($user);
            return redirect()->intended('/dashboard');
        }

        // 2. If not, check if the email already exists in the database.
        $existingUser = User::where('email', $googleUser->getEmail())->first();

        if ($existingUser) {
            $existingUser->update([
                'google_id' => $googleUser->getId(),
                'google_token' => $googleUser->token,
            ]);

            Auth::login($existingUser);
            return redirect()->intended('/dashboard');
        }

        // 3. If the user is completely new, create a new record.
        // Extract a default username from the email
        $baseUsername = explode('@', $googleUser->getEmail())[0];
        $username = $baseUsername;
        
        // Ensure username uniqueness
        $count = 1;
        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $count;
            $count++;
        }

        $newUser = User::create([
            'username' => $username,
            'nama' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => bcrypt(Str::random(16)), // Dummy password
            'role' => 'mahasiswa', // Default role
            'google_id' => $googleUser->getId(),
            'google_token' => $googleUser->token,
        ]);

        Auth::login($newUser);
        return redirect()->intended('/dashboard');
    }
}
