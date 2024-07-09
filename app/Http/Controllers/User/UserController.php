<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\VerifikasiEmailUntukRegistrasiPengaduanMasyarakat;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class UserController extends Controller
{
    public function index()
    {
        // Menghitung jumlah pengaduan yang ada di table
        $pengaduan = Pengaduan::all()->count();

        // Arahkan ke file user/landing.blade.php
        return view('user.landing', ['pengaduan' => $pengaduan]);
    }

    // public function login(Request $request)
    // {
    //     // Pengecekan $request->username isinya email atau username
    //     if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
    //         // jika isinya string email, cek email nya di table masyarakat
    //         $email = Masyarakat::where('email', $request->username)->first();

    //         // Pengecekan variable $email jika tidak ada di table masyarakat
    //         if (!$email) {
    //             return redirect()->back()->with(['pesan' => 'Email tidak terdaftar']);
    //         }

    //         // jika email ada, langsung check password yang dikirim di form dan di table, hasilnya sama atau tidak
    //         $password = Hash::check($request->password, $email->password);

    //         // Pengecekan variable $password jika password tidak sama dengan yang dikirimkan
    //         if (!$password) {
    //             return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
    //         }

    //         // Jalankan fungsi auth jika berjasil melewati validasi di atas
    //         if (Auth::guard('masyarakat')->attempt(['email' => $request->username, 'password' => $request->password])) {
    //             // Jika login berhasil
    //             return redirect()->back();
    //         } else {
    //             // Jika login gagal
    //             return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
    //         }
    //     } else {
    //         // jika isinya string username, cek username nya di table masyarakat
    //         $username = Masyarakat::where('username', $request->username)->first();

    //         // Pengecekan variable $username jika tidak ada di table masyarakat
    //         if (!$username) {
    //             return redirect()->back()->with(['pesan' => 'Username tidak terdaftar']);
    //         }

    //         // jika username ada, langsung check password yang dikirim di form dan di table, hasilnya sama atau tidak
    //         $password = Hash::check($request->password, $username->password);

    //         // Pengecekan variable $password jika password tidak sama dengan yang dikirimkan
    //         if (!$password) {
    //             return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
    //         }

    //         // Jalankan fungsi auth jika berjasil melewati validasi di atas
    //         if (Auth::guard('masyarakat')->attempt(['username' => $request->username, 'password' => $request->password])) {
    //             // Jika login berhasil
    //             return redirect()->back();
    //         } else {
    //             // Jika login gagal
    //             return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
    //         }
    //     }
    // }

    // public function formRegister()
    // {
    //     // Arahkan ke file user/register.blade.php
    //     return view('user.register');
    // }

    // public function register(Request $request)
    // {
    //     // Masukkan semua data yg dikirim ke variable $data 
    //     $data = $request->all();

    //     // Buat variable $validate kemudian isinya Validator::make(datanya, [nama_field => peraturannya])
    //     $validate = Validator::make($data, [
    //         'no_index' => ['required', 'unique:masyarakat'],
    //         'nama' => ['required', 'string'],
    //         'email' => ['required', 'email', 'string', 'unique:masyarakat'],
    //         'username' => ['required', 'string', 'regex:/^\S*$/u', 'unique:masyarakat'],
    //         'password' => ['required', 'min:6'],
    //         'telp' => ['required'],
    //     ]);

    //     // Pengecekan jika validate fails atau gagal
    //     if ($validate->fails()) {
    //         return redirect()->back()->withErrors($validate)->withInput();
    //     }

    //     // Mengecek email
    //     $email = Masyarakat::where('email', $request->username)->first();

    //     // Pengecekan jika email sudah terdaftar
    //     if ($email) {
    //         return redirect()->back()->with(['pesan' => 'Email sudah terdaftar'])->withInput(['email' => 'asd']);
    //     }

    //     // Mengecek username
    //     $username = Masyarakat::where('username', $request->username)->first();

    //     // Pengecekan jika username sudah terdaftar
    //     if ($username) {
    //         return redirect()->back()->with(['pesan' => 'Username sudah terdaftar'])->withInput(['username' => null]);
    //     }

    //     // Memasukkan data kedalam table Masyarakat
    //     Masyarakat::create([
    //         'no_index' => $data['no_index'],
    //         'nama' => $data['nama'],
    //         'email' => $data['email'],
    //         'username' => $data['username'],
    //         'password' => Hash::make($data['password']),
    //         'telp' => $data['telp'],
    //     ]);

    //     // Kirim link verifikasi email
    //     // $link = URL::temporarySignedRoute('pekat.verify', now()->addMinutes(30), ['nik' => $data['nik']]);
    //     // Mail::to($data['email'])->send(new VerifikasiEmailUntukRegistrasiPengaduanMasyarakat($data['nama'], $link));

    //     // Arahkan ke route pekat.index
    //     return redirect()->route('pekat.index');
    // }

    // public function logout()
    // {
    //     // Fungsi logout dengan guard('masyarakat')
    //     Auth::guard('masyarakat')->logout();

    //     // Arahkan ke route pekat.index
    //     return redirect()->route('pekat.index');
    // }
    public function show($id_pengaduan)
    {
        $laporan = Pengaduan::with('tanggapan')->where('id_pengaduan', $id_pengaduan)->first();

        return view('User.laporan', compact('laporan'));
    }

    public function trackLaporan(Request $request)
{
    $kode_laporan = $request->kode_laporan;
    $laporan = Pengaduan::where('kode_laporan', $kode_laporan)->first();

    if (!$laporan) {
        return back()->with('error', 'Laporan tidak ditemukan.');
    }

    return view('User.laporan', compact('laporan'));
}

    public function storePengaduan(Request $request)
    {
        // Masukkan semua data yg dikirim ke variable $data 
        $data = $request->all();

        // Log data yang diterima
        Log::info('Data Received:', $data);

        // Buat variable $validate kemudian isinya Validator::make(datanya, [nama_field => peraturannya])
        $validate = Validator::make($data, [
            'judul_laporan' => ['required'],
            'no_hp' => ['required'],
            'isi_laporan' => ['required'],
            'tgl_kejadian' => ['required'],
            'lokasi_kejadian' => ['required'],
            'wilayah_kejadian' => ['required'],
        ]);

        // Log hasil validasi
        if ($validate->fails()) {
            Log::error('Validation Errors:', $validate->errors()->toArray());
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Pengecekan jika ada file foto yang dikirim
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension(); // Mendapatkan ekstensi asli file
            $filename = time() . '.' . $extension; // Membuat nama file baru dengan ekstensi asli
            $data['foto'] = $file->storeAs('assets/pengaduan', $filename, 'public');
        }

        // Set timezone waktu ke Asia/Bangkok
        date_default_timezone_set('Asia/Bangkok');

        // Membuat variable $pengaduan isinya Memasukkan data kedalam table Pengaduan
        $pengaduan = Pengaduan::create([
            'tgl_pengaduan' => date('Y-m-d h:i:s'),
            'nama' => $data['nama'],
            'no_hp' => $data['no_hp'],
            'no_index' => $data['no_index'],
            'kode_laporan' => substr(uniqid(), -5), // Mengambil 5 karakter terakhir dari uniqid
            'judul_laporan' => $data['judul_laporan'],
            'isi_laporan' => $data['isi_laporan'],
            'tgl_kejadian' => $data['tgl_kejadian'],
            'wilayah_kejadian' => $data['wilayah_kejadian'],
            'lokasi_kejadian' => $data['lokasi_kejadian'],
            'foto' => $data['foto'] ?? '',
            'status' => '0',
        ]);

        // Log hasil pembuatan pengaduan
        if ($pengaduan) {
            Log::info('Pengaduan Created:', $pengaduan->toArray());
            return redirect()->route('pekat.index', 'me')->with([
                'pengaduan' => 'Berhasil terkirim! Kode Laporan: ' . $pengaduan->kode_laporan,
                'kode_laporan' => $pengaduan->kode_laporan,
                'type' => 'success'
            ]);
        } else {
            Log::error('Failed to create pengaduan');
            return redirect()->back()->with(['pengaduan' => 'Gagal terkirim!', 'type' => 'danger']);
        }
    }

    public function laporan($kode_laporan = '')
{
    // Membuat variable $terverifikasi isinya menghitung pengaduan status pending
    $terverifikasi = Pengaduan::where('status', '!=', '0')->count();
    // Membuat variable $proses isinya menghitung pengaduan status proses
    $proses = Pengaduan::where('status', 'proses')->count();
    // Membuat variable $selesai isinya menghitung pengaduan status selesai
    $selesai = Pengaduan::where('status', 'selesai')->count();

    // Masukkan 3 variable diatas ke dalam variable array $hitung
    $hitung = [$terverifikasi, $proses, $selesai];

    // Pengecekan jika ada parameter $kode_laporan yang dikirimkan di url
    if (!empty($kode_laporan)) {
        // Jika $kode_laporan diberikan, ambil pengaduan berdasarkan kode_laporan yang unik
        $pengaduan = Pengaduan::where('kode_laporan', $kode_laporan)->orderBy('tgl_pengaduan', 'desc')->get();

        // Arahkan ke file user/laporan.blade.php sebari kirim data pengaduan, hitung, kode_laporan
        return view('user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'kode_laporan' => $kode_laporan]);
    } else {
        // Jika $kode_laporan kosong, ambil semua pengaduan yang statusnya bukan '0'
        $pengaduan = Pengaduan::where('status', '!=', '0')->orderBy('tgl_pengaduan', 'desc')->get();

        // Arahkan ke file user/laporan.blade.php sebari kirim data pengaduan, hitung, kode_laporan
        return view('user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'kode_laporan' => '']);
    }
}
}
