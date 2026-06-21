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
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Obtain the user information from Google and authenticate.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
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

    /**
     * Handle manual registration request.
     */
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'mahasiswa', // default role
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    /**
     * Handle manual login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt login using either email or username (NIM)
        $loginField = filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $authData = [
            $loginField => $credentials['email'],
            'password' => $credentials['password'],
        ];

        if (Auth::attempt($authData, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Kredensial yang Anda masukkan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }
}
