<?php

use App\Http\Controllers\CsdmController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\KarirController;
use App\Http\Controllers\KelasDiklatController;
use App\Http\Controllers\ModulDiklatController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PosisiLamaranController;
use App\Http\Controllers\TugasDiklatController;
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
    Route::post('/login', [KarirController::class, 'store_login'])->name('karir.store_login');
    Route::post('/verifikasi', [KarirController::class, 'store_verifikasi'])->name('karir.store_verifikasi');
    Route::post('logout', [KarirController::class, 'logout'])->name('karir.logout');
    Route::get('/profile', [KarirController::class, 'profile'])->name('karir.profile');
    Route::get('/profile/{id}', [KarirController::class, 'profile_by_id'])->name('karir.profile_by_id');
    Route::post('profile/{id}', [KarirController::class, 'store_profile'])->name('karir.store_profile');
    Route::put('/profile/{id}', [KarirController::class, 'edit_profile'])->name('karir.edit_profile');
    Route::get('/kelas', [KelasDiklatController::class, 'index'])->name('karir.kelas');
    Route::get('/kelas/pertemuan/{pertemuan}', [KelasDiklatController::class, 'get_kelas_by_pertemuan_id'])->name('karir.kelas_pertemuan');
    Route::get('/kelas/tugas/download/{id}', [KelasDiklatController::class, 'getDownloadTugas'])->name('download_tugas');
    Route::post('/kelas/tugas/upload', [KelasDiklatController::class, 'upload_tugas'])->name('upload_tugas');
    Route::get('/kelas/modul/download/{id}', [KelasDiklatController::class, 'getDownloadModul'])->name('download_modul');


    Route::prefix('admin')->group(function () {
        Route::get('/', [KarirController::class, 'admin'])->name('karir.admin');
        Route::get('/kelas', [KelasDiklatController::class, 'admin_kelas'])->name('karir.admin.kelas');
        Route::get('/kelas/create', [KelasDiklatController::class, 'admin_create_kelas'])->name('admin.create_kelas');
        Route::post('/kelas/create', [KelasDiklatController::class, 'admin_store_kelas'])->name('admin.store_kelas');
        Route::get('/kelas/{id}', [KelasDiklatController::class, 'admin_edit_kelas'])->name('admin.edit_kelas');
        Route::put('/kelas/{id}', [KelasDiklatController::class, 'admin_update_kelas'])->name('admin.update_kelas');
        Route::delete('/kelas/{id}', [KelasDiklatController::class, 'admin_delete_kelas'])->name('admin.delete_kelas');

        Route::get('/posisi', [PosisiLamaranController::class, 'index'])->name('karir.admin.posisi');
        Route::get('/posisi/create', [PosisiLamaranController::class, 'create'])->name('admin.create_posisi');
        Route::post('/posisi/create', [PosisiLamaranController::class, 'store'])->name('admin.store_posisi');
        Route::get('/posisi/{id}', [PosisiLamaranController::class, 'edit'])->name('admin.edit_posisi');
        Route::put('/posisi/{id}', [PosisiLamaranController::class, 'update'])->name('admin.update_posisi');
        Route::delete('/posisi/{id}', [PosisiLamaranController::class, 'destroy'])->name('admin.delete_posisi');


        Route::get('/modul', [ModulDiklatController::class, 'index'])->name('karir.admin.modul');
        Route::get('/modul/create', [ModulDiklatController::class, 'create'])->name('admin.create_modul');
        Route::post('/modul/create', [ModulDiklatController::class, 'store'])->name('admin.store_modul');
        Route::get('/modul/{id}', [ModulDiklatController::class, 'edit'])->name('admin.edit_modul');
        Route::put('/modul/{id}', [ModulDiklatController::class, 'update'])->name('admin.update_modul');
        Route::delete('/modul/{id}', [ModulDiklatController::class, 'destroy'])->name('admin.delete_modul');

        Route::get('/tugas', [TugasDiklatController::class, 'index'])->name('karir.admin.tugas');
        Route::get('/tugas/create', [TugasDiklatController::class, 'create'])->name('admin.create_tugas');
        Route::post('/tugas/create', [TugasDiklatController::class, 'store'])->name('admin.store_tugas');
        Route::get('/tugas/{id}', [TugasDiklatController::class, 'edit'])->name('admin.edit_tugas');
        Route::put('/tugas/{id}', [TugasDiklatController::class, 'update'])->name('admin.update_tugas');
        Route::delete('/tugas/{id}', [TugasDiklatController::class, 'destroy'])->name('admin.delete_tugas');

        Route::get('/csdm', [CsdmController::class, 'index'])->name('karir.admin.csdm');
        Route::get('/csdm/create', [CsdmController::class, 'create'])->name('admin.create_csdm');
        Route::post('/csdm/create', [CsdmController::class, 'store'])->name('admin.store_csdm');
        Route::post('/csdm/import', [CsdmController::class, 'import_excel'])->name('admin.import_csdm');
        Route::get('/csdm/{id}', [CsdmController::class, 'edit'])->name('admin.edit_csdm');
        Route::put('/csdm/{id}', [CsdmController::class, 'update'])->name('admin.update_csdm');
        Route::delete('/csdm/{id}', [CsdmController::class, 'destroy'])->name('admin.delete_csdm');

        Route::get('/kelas/pertemuan/{pertemuan}', [KelasDiklatController::class, 'admin_kelas_by_pertemuan_id'])->name('karir.admin.kelas_pertemuan');
        Route::get('/kelas/pertemuan/{pertemuan}/tugas', [KelasDiklatController::class, 'admin_kelas_tugas'])->name('karir.admin.kelas_tugas');
        Route::get('/kelas/pertemuan/{pertemuan}/tugas/{id}', [KelasDiklatController::class, 'admin_kelas_tugas_by_id'])->name('karir.admin.kelas_tugas_by_id');
        Route::get('/kelas/pertemuan/{pertemuan}/tugas/{id}/edit', [KelasDiklatController::class, 'admin_kelas_tugas_edit'])->name('karir.admin.kelas_tugas_edit');
        Route::put('/kelas/pertemuan/{pertemuan}/tugas/{id}', [KelasDiklatController::class, 'admin_kelas_tugas_update'])->name('karir.admin.kelas_tugas_update');
        Route::get('/kelas/pertemuan/{pertemuan}/tugas/{id}/delete', [KelasDiklatController::class, 'admin_kelas_tugas_delete'])->name('karir.admin.kelas_tugas_delete');
        Route::get('/kelas/pertemuan/{pertemuan}/tugas/create', [KelasDiklatController::class, 'admin_kelas_tugas_create'])->name('karir.admin.kelas_tugas_create');
    });

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
