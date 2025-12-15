<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/explore', [ExploreController::class, 'index'])->name('explore');

// Route Login & Logout
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', function () {
    return "<h1>Selamat Datang di Dashboard Admin!</h1> <p>Fitur CRUD Wisata akan dibuat di sini.</p> 
            <form action='/logout' method='POST'><input type='hidden' name='_token' value='".csrf_token()."'>
            <button type='submit'>Logout</button></form>";
})->middleware('auth');