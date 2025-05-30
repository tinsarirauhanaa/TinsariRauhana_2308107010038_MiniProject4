<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'username' => ['required', 'string'],
                'password' => ['required', 'string'],
            ]);

            Log::info('Login attempt with credentials: ', $credentials);

            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                $request->session()->regenerate();
                Log::info('Login successful for username: ' . $request->username);

                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil!',
                    'redirect' => route('dashboard')
                ], 200);
            }

            Log::warning('Login failed for username: ' . $request->username);

            return response()->json([
                'success' => false,
                'message' => 'Login Gagal, periksa kembali data Anda.'
            ], 401);

        } catch (\Exception $e) {
            Log::error('Login Error at ' . now()->toDateTimeString() . ': ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Login Gagal, periksa kembali data Anda.'
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Log::info('User logged out');
        return redirect('/login');
    }
}