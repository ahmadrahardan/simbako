<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_Login;
use App\Http\Controllers\C_Register;
use App\Http\Controllers\C_Pengajuan;
use App\Http\Controllers\C_Riwayat;
use App\Http\Controllers\C_Profil;
use App\Http\Controllers\C_Verifikasi;
use App\Http\Controllers\C_Jadwal;
use App\Http\Controllers\C_Edukasi;
use App\Http\Controllers\C_Chatbot;
use App\Http\Controllers\DokumenController;

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

Route::get('/', function () {
    return view('auth.V_Landing');})->name('landing');

//Route Register
Route::get('/register', [C_Register::class ,'daftar'])->name('register');
Route::post('/register', [C_Register::class, 'daftarUser']);

//Route Login
Route::get('/login', [C_Login::class ,'masuk'])->name('login');
Route::post('/login',[C_Login::class, 'cekData']);
Route::post('/logout', [C_Login::class, 'logout'])->name('logout');

// Route Dashboard
Route::get('/dashboard', function () {
    return view('master.V_Dashboard');
})->middleware('auth')->name('V_Dashboard');

// Route Profil
Route::middleware('auth')->group(function () {
    Route::get('/profil', [C_Profil::class, 'profil'])->name('V_Profil');
    Route::put('/profil', [C_Profil::class, 'update'])->name('profil.update');
});

// Route Pengajuan
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/pengajuan', [C_Pengajuan::class, 'pengajuan'])->name('V_Pengajuan');
    Route::post('/pengajuan/simpan', [C_Pengajuan::class, 'simpan'])->name('pengajuan.simpan');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/pengajuan', [C_Pengajuan::class, 'adminPengajuan'])->name('admin.pengajuan');
    Route::put('/admin/pengajuan/update-status/{id}', [C_Pengajuan::class, 'ubahStatus']);
});

// Route Jadwal
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/jadwal', [C_Jadwal::class, 'jadwal'])->name('V_Jadwal');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/jadwal', [C_Jadwal::class, 'adminJadwal'])->name('admin.jadwal');
});

// Route Edukasi
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/edukasi', [C_Edukasi::class, 'edukasi'])->name('V_Edukasi');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/edukasi', [C_Edukasi::class, 'adminEdukasi'])->name('admin.edukasi');
    Route::post('/edukasi/simpan', [C_Edukasi::class, 'simpan'])->name('edukasi.simpan');
    Route::put('/edukasi/{id}', [C_Edukasi::class, 'update'])->name('edukasi.update');
    Route::delete('/edukasi/{id}', [C_Edukasi::class, 'hapus'])->name('edukasi.hapus');
});

Route::get('/edukasi/{slug}', [C_Edukasi::class, 'konten'])->middleware(['auth'])->name('edukasi.konten');

// Route Chatbot
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/chatbot', [C_Chatbot::class, 'chatbot'])->name('V_Chatbot');
});

// Route Riwayat
Route::get('/riwayat', [C_Riwayat::class, 'riwayat'])->middleware(['auth', 'user'])->name('V_Riwayat');

// Route Verifikasi
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/verifikasi', [C_Verifikasi::class, 'verifikasi'])->name('V_Verifikasi');
    Route::put('/admin/verifikasi/{id}', [C_Verifikasi::class, 'verifikasiUser']);
});

// Route Download
Route::get('/dokumen/download/{filename}', [DokumenController::class, 'download'])->name('dokumen.download');
