<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\PegawaiController;

use App\Http\Controllers\QuestionController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;


Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');

Route::get('/', function () {
    return view('welcome');
});


Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});

Route::get('/nama/{param1}', function ($param1) {
    return 'Nama saya: '.$param1;
});

Route::get('/nim/{param1?}', function ($param1 = '') {
    return 'NIM saya: '.$param1;
});

Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);

Route::get('/about', function () {
    return view('halaman-about');
});

Route::get('/home',[HomeController::class,'index']);

Route::post('question/store', [QuestionController::class, 'store'])
		->name('question.store');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('checkislogin');

Route::resource('pelanggan', PelangganController::class);

Route::resource('user', UserController::class);

Route::get('/login',[AuthController::class,'index'])->name('login.index');
Route::post('/login/auth', [AuthController::class, 'login'])
		->name('auth.login');

Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::group(['middleware' => ['checkrole:Super Admin']], function () {
    Route::get('user', [UserController::class, 'index'])->name('user.list');
});
