<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function register_store()
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
        ]);

        try {
            if (request()->password != request()->password_confirmation) {
                return back()->with('fail', ['password' => 'Password anda tidak sama.']);
            }

            User::create([
                'name' => request()->name,
                'email' => request()->email,
                'password' => Hash::make(request()->password),
                'role' => 'user'
            ]);

            Auth::attempt(request()->only('email', 'password'));
            return redirect()->route('produk.etalase');
        } catch (QueryException $error) {
            return $error;
        }
    }

    public function login_store()
    {
        $this->validate(request(), [
            'email' => 'required',
        ]);

        try {
            $user = User::where('email', request()->email)->first();
            if ($user == null) {
                return back()->with('fail', ['email' => 'Email anda belum terdaftar.'])->with('email', request()->email);
            } else {
                if (Hash::check(request()->password, $user->password)) {
                    Auth::attempt(request()->only('email', 'password'));
                    return redirect()->route('produk.etalase');
                } else {
                    return back()->with('fail', ['password' => 'Password yang anda masukan salah'])->with('email', request()->email);
                }
            }
        } catch (QueryException $errror) {
            return $errror;
        }
    }

    public function logout()
    {
        try {
            Auth::logout();
            return redirect()->route('home');
        } catch (QueryException $errror) {
            return $errror;
        }
    }
}
