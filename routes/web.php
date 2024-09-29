<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Auth::routes(['verify' => true]);

Route::get('/', 'ExampleController@index');

Route::get('/login-mahasiswa', [AuthenticationController::class, 'login'])->name('login');
Route::post('/login', [AuthenticationController::class, 'actionlogin'])->name('actionlogin');

Route::get('/register-mahasiswa', [RegisterController::class, 'register']);
Route::post('/register', [RegisterController::class, 'actionregister'])->name('actionregister');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
        return redirect()->route('login');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/logout', [AuthenticationController::class, 'actionlogout'])->name('actionlogout');

Route::get('/dashboard', [DashboardController::class, 'index'])
->middleware(['auth', 'verified'])->name('index');

Route::get('/add-mahasiswa', [DashboardController::class, 'create']);
Route::post('/add', [DashboardController::class, 'createproses'])->name('createproses');

Route::get('/edit-mahasiswa/{nrp}', [DashboardController::class, 'edit']);
Route::post('/update/{nrp}', [DashboardController::class, 'editproses'])->name('update');

Route::get('/hapus-mahasiswa/{nrp}', [DashboardController::class, 'hapusproses'])->name('');
