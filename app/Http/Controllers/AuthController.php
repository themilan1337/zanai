<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Find or create user
            $user = User::updateOrCreate(
                ['google_id' => $googleUser->id],
                [
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'email_verified_at' => now(),
                ]
            );

            Auth::login($user);

            return redirect()->route('dashboard');
            
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Authentication failed. Please try again.');
        }
    }

    /**
     * Redirect the user to the Telegram authentication page.
     */
    public function redirectToTelegram()
    {
        return Socialite::driver('telegram')->redirect();
    }

    /**
     * Obtain the user information from Telegram.
     */
    public function handleTelegramCallback()
    {
        try {
            $telegramUser = Socialite::driver('telegram')->user();
            
            // Find or create user
            $user = User::updateOrCreate(
                ['telegram_id' => $telegramUser->id],
                [
                    'name' => $telegramUser->name ?? $telegramUser->first_name . ' ' . ($telegramUser->last_name ?? ''),
                    'email' => $telegramUser->email ?? null,
                    'telegram_id' => $telegramUser->id,
                    'telegram_username' => $telegramUser->username ?? null,
                    'avatar' => $telegramUser->avatar ?? null,
                    'email_verified_at' => now(),
                ]
            );

            Auth::login($user);

            return redirect()->route('dashboard');
            
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Telegram authentication failed. Please try again.');
        }
    }

    /**
     * Show the dashboard with user details.
     */
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('dashboard', ['user' => Auth::user()]);
    }

    /**
     * Show the login page.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}