<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');
Route::get('/explore', [ExploreController::class, 'index'])->name('explore');

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');
Route::get('/explore/{id}', [ExploreController::class, 'show'])->name('explore.show');
Route::view('/contact', 'contact')->name('contact');

Route::middleware(['auth'])->group(function () {
    

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    

    Route::get('/dashboard/wisata', [DashboardController::class, 'wisata'])->name('dashboard.wisata');

    Route::get('/dashboard/wisata/create', [DashboardController::class, 'create'])->name('wisata.create');
    Route::post('/dashboard/wisata', [DashboardController::class, 'store'])->name('wisata.store');

    Route::get('/dashboard/wisata/{id}/edit', [DashboardController::class, 'edit'])->name('wisata.edit');
    Route::put('/dashboard/wisata/{id}', [DashboardController::class, 'update'])->name('wisata.update');
    

    Route::delete('/dashboard/wisata/{id}', [DashboardController::class, 'destroy'])->name('wisata.destroy');
    
Route::delete('/dashboard/galeri/{id}', [DashboardController::class, 'deleteGaleri'])->name('galeri.destroy');

    });