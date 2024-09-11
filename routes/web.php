<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;

Route::get('/', 'ExampleController@index');

Route::get('/login-mahasiswa', [AuthenticationController::class, 'login']);
Route::post('/login', [AuthenticationController::class, 'actionlogin'])->name('actionlogin');

Route::get('/register-mahasiswa', [RegisterController::class, 'register']);
Route::post('/register', [RegisterController::class, 'actionregister'])->name('actionregister');

Route::post('/logout', [AuthenticationController::class, 'actionlogout'])->name('actionlogout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');

Route::get('/add-mahasiswa', [DashboardController::class, 'create']);
Route::post('/add', [DashboardController::class, 'createproses'])->name('createproses');

Route::get('/edit-mahasiswa/{nrp}', [DashboardController::class, 'edit']);
Route::post('/update/{nrp}', [DashboardController::class, 'editproses'])->name('update');

Route::get('/hapus-mahasiswa/{nrp}', [DashboardController::class, 'hapusproses'])->name('');
