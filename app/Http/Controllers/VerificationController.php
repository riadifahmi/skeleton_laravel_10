<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    // Menampilkan halaman pemberitahuan verifikasi
    public function notice()
    {
        return view('auth.verify-email');
    }

    // Proses verifikasi email
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();  // Memverifikasi email user

        return redirect()->route('login')->with('verified', 'Email berhasil diverifikasi!');
    }

    // Mengirim ulang email verifikasi
}
