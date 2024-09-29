<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthenticationController extends Controller


{
    public function login()
    {
        $data['title'] = 'Login Mahasiswa';


        return
            view('template/header', $data) .
            view('login', $data) .
            view('template/footer');
    }
    
    public function actionlogin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            // Hash ulang password yang dimasukkan user menggunakan MD5 + SHA-256
            $hashedInputPassword = md5($request->password); // Hash MD5
            $hashedInputPassword = hash('sha256', $hashedInputPassword); // Hash SHA-256
    
            if (Hash::check($hashedInputPassword, $user->password)) {
                Auth::loginUsingId($user->id_user);
                $request->session()->regenerate();
                return redirect('/dashboard');
            }
        }
    
        return back()->with('loginError', 'Login Failed!');
    }
    
    
    

    public function actionlogout()
    {
        Auth::logout();
 
        request()->session()->invalidate();
     
        request()->session()->regenerateToken();
     
        return redirect('/login-mahasiswa');
    }
}
