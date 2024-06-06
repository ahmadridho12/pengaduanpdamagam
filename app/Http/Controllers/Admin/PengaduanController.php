<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

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

}
