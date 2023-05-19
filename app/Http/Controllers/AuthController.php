<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])
            ->where('password', hash('sha256', $credentials['password']))->first();

        // dd($credentials);
        if (empty($user)) {
            // return redirect()->route('login');
            return back()->withErrors([
                'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
            ]);
        } else {
            Auth::login($user);
            return redirect('/users');
        }
        // return back()->withErrors([
        //     'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        // ]);
    }
}
