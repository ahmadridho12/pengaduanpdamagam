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
use Illuminate\Support\Facades\Schema;


use Illuminate\Support\Facades\DB; // Tambahkan ini


class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::query();
    
        // Terapkan filter jika ada
        if ($request->has('judul_laporan') && $request->judul_laporan != '') {
            $query->where('judul_laporan', $request->judul_laporan);
        }
    
        if ($request->has('wilayah_kejadian') && $request->wilayah_kejadian != '') {
            $query->where('wilayah_kejadian', $request->wilayah_kejadian);
        }
    
        if ($request->has('tgl_pengaduan_awal') && $request->tgl_pengaduan_awal != '') {
            $query->where('tgl_pengaduan', '>=', $request->tgl_pengaduan_awal);
        }
    
        if ($request->has('tgl_pengaduan_akhir') && $request->tgl_pengaduan_akhir != '') {
            $query->where('tgl_pengaduan', '<=', $request->tgl_pengaduan_akhir);
        }
    
        // Urutkan berdasarkan tanggal menurun
        $pengaduan = $query->orderBy('tgl_pengaduan', 'desc')->get();
    
        $judulList = Pengaduan::select('judul_laporan')->distinct()->get();
        $wilayahList = Pengaduan::select('wilayah_kejadian')->distinct()->get();
    
        return view('Admin.Pengaduan.index', compact('pengaduan', 'judulList', 'wilayahList'));
    }
    
    

    public function show($id_pengaduan)
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan)->first();
        $tanggapan = Tanggapan::where('id_pengaduan', $id_pengaduan)->first();

        if ($tanggapan) {
            $tanggapan->tgl_tanggapan = Carbon::parse($tanggapan->tgl_tanggapan);
        }
        Log::info('Pengaduan foto path:', ['foto' => $pengaduan->foto]);

        return view('Admin.Pengaduan.show', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan]);
    }

    public function store(Request $request)
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


    public function destroy($id_pengaduan)
    {
        // Cek apakah ada tanggapan yang terkait dengan pengaduan
        $tanggapanCount = Tanggapan::where('id_pengaduan', $id_pengaduan)->count();

        if ($tanggapanCount > 0) {
            return redirect()->route('pengaduan.index')->withErrors(['error' => 'Pengaduan tidak bisa dihapus karena memiliki tanggapan terkait.']);
        }

        // Hapus pengaduan
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        $pengaduan->delete();

        return redirect()->route('pengaduan.index');
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

    // public function getRayonsByWilayah($wilayah)
    // {
    //     $tableName = '';

    //     // Define table names based on wilayah_kejadian
    //     switch ($wilayah) {
    //         case 'lubuk basung':
    //             $tableName = 'rayon_lubukbasung';
    //             break;
    //         case 'tiku':
    //             $tableName = 'rayon_tiku';
    //             break;
    //         case 'batukambing':
    //             $tableName = 'rayon_batukambing';
    //             break;
    //         case 'baso':
    //             $tableName = 'rayon_baso';
    //             break;
    //         // Add more cases as needed
    //         default:
    //             return response()->json(['error' => 'Wilayah tidak ditemukan'], 404);
    //     }

    //     try {
    //         // Check if the table exists
    //         if (!Schema::hasTable($tableName)) {
    //             return response()->json(['error' => 'Table not found'], 404);
    //         }

    //         // Fetch rayon values from the determined table
    //         $rayons = DB::table($tableName)->pluck('rayon');

    //         // Ensure `rayon` column exists in the table
    //         if ($rayons->isEmpty()) {
    //             return response()->json(['error' => 'Rayon column not found or empty'], 404);
    //         }

    //         return response()->json($rayons);
    //     } catch (\Exception $e) {
    //         // Log and handle any unexpected errors
    //         Log::error('Database query error:', ['message' => $e->getMessage()]);
    //         return response()->json(['error' => 'An error occurred'], 500);
    //     }


    }