<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\GalleryController;

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

Route::get('/', [PengaduanController::class, 'index']);
// Route::resource('pengaduan','PengaduanController');
Route::post('/pengaduan/store', 'App\Http\Controllers\PengaduanController@store')->name('pengaduan.store');

//login n logout
// Route::middleware(['guest'])->group(function () {
//     Route::get('/login', [AuthController::class, 'login'])->name('login');
//     Route::post('/login', [AuthController::class, 'authenticated']);
// });
Route::get('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::post('/login', 'App\Http\Controllers\AuthController@authenticated');
Route::get('/logout', [AuthController::class, 'logout']);

//admin
Route::get('/dashboard', [PengaduanController::class, 'dashboard']);
Route::get('/pengaduan', [PengaduanController::class, 'showCMS']);

//hapus pengaduan
Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
//admin reply
Route::post('/pengaduan/{id}/tanggapan', [TanggapanController::class, 'reply'])->name('pengaduan.tanggapan');
Route::get('/tanggapan', [TanggapanController::class, 'showTanggapan']);
Route::delete('/tanggapan/{id}', [TanggapanController::class, 'tanggapanDestroy'])->name('tanggapan.destroy');

//galery
Route::get('/galeri', [GalleryController::class, 'index']);
Route::get('/galericms', [GalleryController::class, 'show']);
Route::post('/galericms/store', 'App\Http\Controllers\GalleryController@store')->name('galericms.store');
Route::put('/galericms/update/{id}', 'App\Http\Controllers\GalleryController@update')->name('galericms.update');
Route::delete('/galericms/delete/{id}', 'App\Http\Controllers\GalleryController@destroy')->name('galericms.destroy');
