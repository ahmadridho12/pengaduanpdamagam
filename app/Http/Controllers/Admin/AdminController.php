<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use App\Models\Pengaduan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function formLogin()
    {
        return view('Admin.login');
    }

    public function login(Request $request)
    {
        $username = Petugas::where('username', $request->username)->first();

        if (!$username) {
            return redirect()->back()->with(['pesan' => 'Username tidak terdaftar!']);
        }

        $password = Hash::check($request->password, $username->password);

        if (!$password) {
            return redirect()->back()->with(['pesan' => 'Password tidak sesuai!']);
        }

        $auth = Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password]);

        if ($auth) {
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.formLogin');
    }

    public function store(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'nama' => 'required',
        'no_hp' => 'required',
        'judul_laporan' => 'required',
        'tgl_kejadian' => 'required|date',
        'wilayah_kejadian' => 'required',
        'isi_laporan' => 'required',
        'lokasi_kejadian' => 'required',
        // Tambahkan validasi lain sesuai kebutuhan
    ]);

    // Simpan data pengaduan
    $pengaduan = Pengaduan::create($validatedData);

    // Generate kode laporan
    $kodeLaporan = 'LP' . str_pad($pengaduan->id, 5, '0', STR_PAD_LEFT);

    // Update kode laporan
    $pengaduan->update(['kode_laporan' => $kodeLaporan]);

    // Redirect kembali ke halaman yang sama dengan pesan sukses dan kode laporan
    return redirect()->back()->with('success', 'Pengaduan berhasil disimpan. Kode Laporan: ' . $kodeLaporan);
}

}
