<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function handleLogin(Request $request)
    {
        $credentials = $request->validate([
            'nama_pengguna' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['nama_pengguna' => $credentials['nama_pengguna'], 'password' => $credentials['password']], $request->remember_me)) {
            return redirect()->intended();
        } else {
            throw ValidationException::withMessages([
                'error' => 'Kredensial yang Anda berikan tidak dapat diverifikasi.'
            ]);
        }

        return redirect()->back();
    }

    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
