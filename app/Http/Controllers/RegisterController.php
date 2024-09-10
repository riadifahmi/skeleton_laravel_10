<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::insert($validatedData);

        if ($validatedData) {
            return redirect()->intended('/login-mahasiswa')->with('registerSuccess', 'Registration successful!');
        } else {
            return redirect()->with('registerError', 'Registrasi failed!');
        }
    }
}
