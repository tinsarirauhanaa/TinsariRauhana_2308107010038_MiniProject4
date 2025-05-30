<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    public function register(Request $request)
    {
        try {
            $validator = $this->validator($request->all());
            if ($validator->fails()) {
                $errors = $validator->errors();
                $message = 'Terjadi Kesalahan, periksa kembali data Anda, data telah digunakan.';
                return response()->json([
                    'success' => false,
                    'message' => $message
                ], 422);
            }

            $data = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];

            $user = User::create($data);

            if (!$user || !$user->exists) {
                \Log::error('User gagal disimpan ke database.');
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi Kesalahan, periksa kembali data Anda, data telah digunakan.'
                ], 500);
            }

            \Log::info('User created: ' . $user->username);

            return response()->json([
                'success' => true,
                'message' => 'Berhasil daftar, silakan masuk.'
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Register Error at ' . now()->toDateTimeString() . ': ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi Kesalahan, periksa kembali data Anda, data telah digunakan.'
            ], 500);
        }
    }
}