<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::orderBy('tgl_pengaduan', 'desc')->get();

        return view('Admin.Pengaduan.index', ['pengaduan' => $pengaduan]);
    }

    public function show($id_pengaduan)
    {
    $pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan)->first();
    $tanggapan = Tanggapan::where('id_pengaduan', $id_pengaduan)->first();

    if ($tanggapan) {
        $tanggapan->tgl_tanggapan = Carbon::parse($tanggapan->tgl_tanggapan);
    }

    return view('Admin.Pengaduan.show', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan]);
    }

    public function storePengaduan(Request $request)
    {
        // Masukkan semua data yg dikirim ke variable $data 
        $data = $request->all();

         // Set default value for no_index if it's null
         $data['no_index'] = $data['no_index'] ?? '';

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
            'no_index' => ['nullable'],
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
            return redirect()->route('pekat.indexx', 'me')->with([
                'pengaduan' => 'Berhasil terkirim! Kode Laporan: ' . $pengaduan->kode_laporan,
                'kode_laporan' => $pengaduan->kode_laporan,
                'type' => 'success'
            ]);
        } else {
            Log::error('Failed to create pengaduan');
            return redirect()->back()->with(['pengaduan' => 'Gagal terkirim!', 'type' => 'danger']);
        }
    }
    public function cetakPDF($id_pengaduan)
    {
        // Tingkatkan batas waktu eksekusi
        set_time_limit(120);

        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        $tanggapan = Tanggapan::where('id_pengaduan', $id_pengaduan)->first();

        $pdf = PDF::loadView('Admin.pengaduan.cetakspko', compact('pengaduan', 'tanggapan'));
        $fileName = 'SPKO/' . str_replace(' ', '_', $pengaduan->nama) . '.pdf';
        return $pdf->download($fileName);
    }
    public function create()
    {
        return view('Admin.Pengaduan.create');
    }
}
