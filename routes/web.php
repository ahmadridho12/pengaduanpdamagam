<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TambahController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\MasyarakatController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\TanggapanController;
use App\Http\Controllers\Admin\RayonController;
use App\Http\Controllers\Admin\MouController;
use App\Http\Controllers\Admin\DirekturController;
use App\Http\Controllers\User\EmailController;
use App\Http\Controllers\User\SocialController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

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
#pengaduan tambah
Route::get('admin/pengaduan/tambah', 'PengaduanController@tambah')->name('pengaduan.tambah');
Route::get('/laporan', 'App\Http\Controllers\User\UserController@show')->name('laporan');

Route::get('/', [UserController::class, 'index'])->name('pekat.index');


Route::post('/masyarakat/sendverification', [EmailController::class, 'sendVerification'])->name('pekat.sendVerification');
Route::get('/masyarakat/verify/{nik}', [EmailController::class, 'verify'])->name('pekat.verify');


Route::middleware([])->group(function () {
    // Pengaduan
    Route::post('/store', [UserController::class, 'storePengaduan'])->name('pekat.store');
    
    Route::get('/laporan/{siapa?}', [UserController::class, 'laporan'])->name('pekat.landing');

    // Logout Masyarakat
    Route::get('/logout', [UserController::class, 'logout'])->name('pekat.logout');
});

Route::middleware(['guest'])->group(function () {
    // Login Masyarakat
    Route::post('/login/auth', [UserController::class, 'login'])->name('pekat.login');

    // Register
    Route::get('/register', [UserController::class, 'formRegister'])->name('pekat.formRegister');
    Route::post('/register/auth', [UserController::class, 'register'])->name('pekat.register');

    // Media Sosial
    Route::get('auth/{provider}', [SocialController::class, 'redirectToProvider'])->name('pekat.auth');
    Route::get('auth/{provider}/callback', [SocialController::class, 'handleProviderCallback']);
});

Route::prefix('admin')->group(function () {

    Route::middleware(['isAdmin'])->group(function () {
        // Petugas
        Route::resource('petugas', PetugasController::class);

        //admin
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


        // Masyarakat
        Route::resource('masyarakat', MasyarakatController::class);

        // Laporan
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::post('getLaporan', [LaporanController::class, 'getLaporan'])->name('laporan.getLaporan');
        Route::get('laporan/cetak/{from}/{to}', [LaporanController::class, 'cetakLaporan'])->name('laporan.cetakLaporan');
        Route::get('laporan/cetakexel/{from}/{to}', [LaporanController::class, 'cetakLaporanExcel'])->name('laporan.cetakLaporanExcel');
    });

    
    Route::middleware(['isPetugas'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        
        // Pengaduan
        Route::resource('pengaduan', PengaduanController::class);
        Route::post('/pengaduan/store', [PengaduanController::class, 'store'])->name('pengaduan.store');

        // Taanggapan
        Route::post('tanggapan/createOrUpdate', [TanggapanController::class, 'createOrUpdate'])->name('tanggapan.createOrUpdate');

        // Logout
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });

    Route::middleware(['isGuest'])->group(function () {
        Route::get('/', [AdminController::class, 'formLogin'])->name('admin.formLogin');
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
    });
    //untuk cetak spko
    Route::get('/admin/pengaduan/{id_pengaduan}/cetakspko', [PengaduanController::class, 'cetakPDF'])->name('pengaduan.cetakspko');

    //untuk tracking kode_laporan
    Route::get('/track-laporan', [UserController::class, 'trackLaporan'])->name('pekat.trackLaporan');
    // user ke halaman baru landing
    Route::get('/user/new', [UserController::class, 'create'])->name('user.new');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

   




    //ini route untuk mou//
    Route::get('admin/Arsip/indexmou', [MouController::class, 'indexmou'])->name('indexmou');
    Route::get('mou/create', [MouController::class, 'create'])->name('mou.create');
    Route::post('/storeMou', [MouController::class, 'storeMou'])->name('storeMou');
    //halaman edit
    Route::get('/arsip/editmou/{id}', [MouController::class, 'edit'])->name('Arsip.editmou');

    //mou update
  
    Route::patch('/mou/update/{id}', [MouController::class, 'update'])->name('mou.update');


    //mou delete
    Route::delete('/mou/{id}', [MouController::class, 'destroy'])->name('mou.destroy');



    //mengarahkan dari moucontroller//
    Route::get('admin/Arsip/indexmou', [MouController::class, 'indexmou'])->name('indexmou');

    // Tambahkan route untuk mengarahkan ke halaman createmou.blade.php
    Route::post('mou/create', 'MouController@create')->name('mou.create');
   //ini route untuk editmou//
   Route::get('/mou/edit/{id_mou}', 'MouController@editmou')->name('mou.editmou');


    // Tambahkan route untuk download file
    Route::get('download/{file}', [App\Http\Controllers\Admin\MouController::class, 'downloadFile'])->name('download.file');

    //pindah kehalaman new//
    Route::get('/user/new', [UserController::class, 'pindah'])->name('user.new');

     //untuk rayon//
    // Tambahkan route ini
    Route::get('/get-rayons/{wilayah}', [RayonController::class, 'getRayons']);


    ///untuk halaman direktur//

    Route::get('admin/Arsip/direktur', [App\Http\Controllers\Admin\DirekturController::class, 'indexdirektur'])->name('indexdirektur');

    //mengarahkan kehalaman createdirektur//
    Route::get('/direktur/create', [DirekturController::class, 'create'])->name('direktur.create');

    //mengarahkan storeDirektur//
    Route::post('/direktur/store', [DirekturController::class, 'storeDirektur'])->name('storeDirektur');

});

// routes/api.php


Route::get('/rayon_lubukbasung', [RayonController::class, 'getRayonLubukBasung']);
Route::get('/rayon_tiku', [RayonController::class, 'getRayonTiku']);
Route::get('/rayon_batukambing', [RayonController::class, 'getRayonBatukambing']);
Route::get('/rayon_baso', [RayonController::class, 'getRayonBaso']);