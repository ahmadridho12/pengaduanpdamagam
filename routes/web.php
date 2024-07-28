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
use App\Http\Controllers\Admin\InfogangguanController;
use App\Http\Controllers\Admin\BeritaController;
use App\Models\Berita;
use App\Models\Infogangguan;
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
// Pengaduan

Route::get('/pengaduan/data', [PengaduanController::class, 'getData'])->name('pengaduan.data');
Route::get('/admin/pengaduan/recent', [PengaduanController::class, 'getRecentPengaduan'])->name('admin.pengaduan.recent');

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

    //pindah kehalaman new//
    Route::get('/user/new', [UserController::class, 'pindah'])->name('user.new');

    //pindah kehalaman sejarah//
    Route::get('/user/sejarah', [UserController::class, 'sejarah'])->name('user.sejarah');

    //pindah kehalaman visimisi//
    Route::get('/user/visimisi', [UserController::class, 'visimisi'])->name('user.visimisi');

    //pindah kehalaman visimisi//
    Route::get('/user/pemasanganbaru', [UserController::class, 'pemasanganbaru'])->name('user.pemasanganbaru');

     //untuk tracking kode_laporan
     Route::get('/track-laporan', [UserController::class, 'trackLaporan'])->name('pekat.trackLaporan');

       //menampilkan ke user halaman new
    // routes/web.php
    // // route supaya infogangguan nampil dihalaman new
    // Route::get('/new', [UserController::class, 'showInfogangguan'])->name('user.new');
    // // route supaya berita nampil dihalaman new
    // Route::get('/new', [UserController::class, 'showBerita'])->name('user.new');

    Route::get('/new', [UserController::class, 'new'])->name('user.new');

    //mengambil id_berita
 
    Route::get('User/detailberita/{id_berita}', [UserController::class, 'show2'])->name('user.show2');

    // kekhalaman berita
    // In routes/web.php
    Route::get('/berita', [UserController::class, 'berita'])->name('user.berita');

    Route::get('user/berita', [UserController::class, 'show3'])->name('user.show3');

    //pindah halaman alamat kantor
    Route::get('/user/alamatkantor', [UserController::class, 'alamatkantor'])->name('user.alamatkantor');
    //pindah halaman media sosial
    Route::get('/user/mediasosial', [UserController::class, 'mediasosial'])->name('user.mediasosial');



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

        //route ke halaman info gangguan
        
        Route::post('/admin/pengaduan', [PengaduanController::class, 'storePengaduan'])->name('admin.pengaduan.store');
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

   
    // user ke halaman baru landing
    

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

    
   

     //untuk rayon//
    // Tambahkan route ini
    Route::get('/get-rayons/{wilayah}', [RayonController::class, 'getRayons']);


    ///untuk halaman direktur//

    Route::get('admin/Arsip/direktur', [App\Http\Controllers\Admin\DirekturController::class, 'indexdirektur'])->name('indexdirektur');

    //mengarahkan kehalaman createdirektur//
    Route::get('/direktur/create', [DirekturController::class, 'create'])->name('direktur.create');

    //mengarahkan storeDirektur//
    Route::post('/direktur/store', [DirekturController::class, 'storeDirektur'])->name('storeDirektur');

    //ini untuk mengarahkan ke halman infogangguan
    Route::get('admin/Cs/infogangguan', [InfogangguanController::class, 'indexInfogangguan'])->name('indexInfogangguan');

      // Tambahkan route untuk mengarahkan ke halaman createinfogangguan.blade.php

    Route::get('/infogangguan/create', [InfogangguanController::class, 'create'])->name('infogangguan.create');
      

       //mengarahkan storeinfogangguan//
    Route::post('/infogangguan/store', [InfogangguanController::class, 'storeInfogangguan'])->name('storeInfogangguan');

    //mengarahkan kehalaman editinfogangguan//
    Route::get('admin/Cs/editinfogangguan/{id_gangguan}', [InfogangguanController::class, 'edit'])->name('Cs.editinfogangguan');
    // mengarahkan update infogangguan
    Route::patch('/infogangguan/update/{id}', [InfogangguanController::class, 'update'])->name('infogangguan.update');


    //mou delete
    Route::delete('/infogangguan/{id}', [InfogangguanController::class, 'destroy'])->name('infogangguan.destroy');
  
    //mengarahkan ke halaman berita
    Route::get('admin/Cs/berita', [BeritaController::class, 'indexBerita'])->name('indexBerita');
    //mengarahkan kehalaman create berita
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    
      

       //mengarahkan storeberita//
    Route::post('/berita/store', [BeritaController::class, 'storeBerita'])->name('storeBerita');

      //mengarahkan kehalaman editberita//
      Route::get('admin/Cs/editberita/{id_berita}', [BeritaController::class, 'edit'])->name('Cs.editberita');

      // mengarahkan update berita
    Route::patch('/berita/update/{id}', [BeritaController::class, 'update'])->name('berita.update');

     //berita delete
     Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');
});

// routes/api.php


Route::get('/rayon_lubukbasung', [RayonController::class, 'getRayonLubukBasung']);
Route::get('/rayon_tiku', [RayonController::class, 'getRayonTiku']);
Route::get('/rayon_batukambing', [RayonController::class, 'getRayonBatukambing']);
Route::get('/rayon_baso', [RayonController::class, 'getRayonBaso']);