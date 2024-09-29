<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function register()
    {
        $data['title'] = 'Register Mahasiswa';


        return
            view('template/header', $data) .
            view('register', $data) .
            view('template/footer');
    }

    public function actionregister(Request $request)
    {
        $validatedData = $request->validate([
            'username' => ['required', 'unique:users', 'max:255', 'min:3'],
            'password' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
        ]);
    
        $user = new User();
        $user->username = $validatedData['username'];
        
        // Menggabungkan MD5 dan SHA-256
        $hashedPassword = md5($validatedData['password']); // Hash MD5
        $hashedPassword = hash('sha256', $hashedPassword); // Hash SHA-256
        $user->password = Hash::make($hashedPassword); // Masukkan ke dalam hash Laravel
    
        $user->email = $validatedData['email'];
        $user->save();
    
        event(new Registered($user));
    
        Auth::login($user);
    
        return redirect()->route('login')->with('registerSuccess', 'Registration successful! Please check your email for verification.');
    }
}
