<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SuratController;


Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [SuratController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('surat/export', [SuratController::class, 'export'])
    ->middleware(['auth', 'verified'])
    ->name('surat.export');

Route::resource('surat', SuratController::class)->middleware(['auth', 'verified']);

Route::get('surat/{surat}/stream', [SuratController::class, 'stream'])
    ->middleware(['auth', 'verified'])
    ->name('surat.stream');

Route::get('surat/{surat}/download', [SuratController::class, 'download'])
    ->middleware(['auth', 'verified'])
    ->name('surat.download');

Route::resource('kategori', KategoriController::class)->middleware(['auth', 'verified']);

Route::get('/about', function () {
    return view('about');
})->middleware(['auth', 'verified'])->name('about');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
