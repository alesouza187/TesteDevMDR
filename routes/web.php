<?php

use App\Http\Controllers\DeshbordController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->get('/', [MaterialController::class, 'index']);
Route::middleware(['auth', 'verified'])->get('/dashboard', [MaterialController::class, 'index'])->name('dashboard');
Route::middleware(['auth', 'verified'])->resource('/material', MaterialController::class)->only('index', 'create', 'store', 'edit', 'update');
Route::middleware(['auth', 'verified'])->post('/material/destroy/{id}', [MaterialController::class, 'destroy'])->name('material.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
