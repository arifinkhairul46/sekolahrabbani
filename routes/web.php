<?php

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\KarirController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('index');
});

Route::get('/home', function () {
    return view('index');
});

Route::get('/visi-misi', function () {
    return view('profile.visi-misi');
});

Route::get('/kurikulum', function () {
    return view('kurikulum.index');
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

//login google
Route::controller(GoogleController::class)->group(function () {
    Route::get('/auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('/auth/google/callback', 'handleGoogleCallback');
});

Route::prefix('karir')->group(function () {
    Route::get('/', [KarirController::class, 'index'])->name('karir');
    Route::get('/login', [KarirController::class, 'login'])->name('karir.login');
    Route::get('/verifikasi', [KarirController::class, 'verifikasi'])->name('karir.verifikasi');
    Route::post('/verifikasi', [KarirController::class, 'store_verifikasi'])->name('karir.store_verifikasi');
});

Route::prefix('pendaftaran')->group(function () {
    Route::get('/', [PendaftaranController::class, 'index'])->name('pendaftaran');
});
// Route::get('/login', function () {
//     return view('auth.login');
// });

// Route::get('/register', function () {
//     return view('auth.register');
// });
