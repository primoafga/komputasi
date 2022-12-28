<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('/');
Route::get('Llogin', [LoginController::class, 'index'])->name('Llogin');
Route::POST('login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('/logout');

//SISWA
Route::resource('Siswa', SiswaController::class);
Route::get('/jadwal', [SiswaController::class, 'jadwal'])->name('/jadwal');
Route::get('/nilaiSiswa/{id}', [SiswaController::class, 'tabel_nilai'])->name('/nilaiSiswa/{id}');

//GURU
Route::resource('Guru', GuruController::class);
Route::get('kelas/{id}', [GuruController::class, 'daftar_siswa']);
Route::get('/data_uas', [GuruController::class, 'data_uas'])->name('/data_uas');
Route::get('Det_Uas/{id}', [GuruController::class, 'Det_Uas']);
Route::PUT('Upd_Uas/{id}', [GuruController::class, 'Upd_Uas']);

Route::get('/data_uts', [GuruController::class, 'data_uts'])->name('/data_uts');
Route::get('Det_Uts/{id}', [GuruController::class, 'Det_Uts']);
Route::PUT('Upd_Uts/{id}', [GuruController::class, 'Upd_Uts']);

Route::get('/data_uh/{id}', [GuruController::class, 'tes'])->name('/data_uh/{id}');
Route::get('/data_uh', [GuruController::class, 'data_uh'])->name('/data_uh');
Route::get('/tabel/{id}', [GuruController::class, 'tabel'])->name('/tabel/{id}');
Route::get('Det_Uh/{id}', [GuruController::class, 'Det_Uh']);
Route::PUT('Upd_Uh/{id}', [GuruController::class, 'Upd_Uh']);

Route::get('/data_tugas/{id}', [GuruController::class, 'get_tugas'])->name('/data_tugas/{id}');
Route::get('/data_tugas', [GuruController::class, 'data_tugas'])->name('/data_tugas');
Route::get('Det_Tug/{id}', [GuruController::class, 'Det_Tug']);
Route::PUT('Upd_Tug/{id}', [GuruController::class, 'Upd_Tug']);


//ADMIN
Route::resource('Admin', AdminController::class);
Route::get('/data_guru', [AdminController::class, 'data_guru'])->name('/data_guru');
Route::get('Det_Gur/{id}', [AdminController::class, 'Det_Gur']);
Route::PUT('Upd_Gur/{id}', [AdminController::class, 'Upd_Gur']);

Route::get('/siswa/{id}', [AdminController::class, 'get_siswa']);
Route::get('/siswa', [AdminController::class, 'daftar_siswa'])->name('/siswa');
Route::get('Det_Sis/{id}', [AdminController::class, 'Det_Sis']);
Route::PUT('Upd_Sis/{id}', [AdminController::class, 'Upd_Sis']);

Route::get('/kbm_guru', [AdminController::class, 'show_kbm'])->name('/kbm_guru');
Route::get('Det_Kbm/{id}', [AdminController::class, 'Det_Kbm']);
Route::PUT('Upd_Kbm/{id}', [AdminController::class, 'Upd_Kbm']);

Route::get('/data_mapel', [AdminController::class, 'show_mapel'])->name('/data_mapel');
Route::get('Det_Map/{id}', [AdminController::class, 'Det_Map']);
Route::PUT('Upd_Map/{id}', [AdminController::class, 'Upd_Map']);

Route::get('/data_kelas', [AdminController::class, 'show_kelas'])->name('/data_kelas');
Route::get('Det_Kel/{id}', [AdminController::class, 'Det_Kel']);
Route::PUT('Upd_Kel/{id}', [AdminController::class, 'Upd_Kel']);
