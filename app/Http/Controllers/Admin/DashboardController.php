<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengaduan;
use App\Models\Complaint;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Menghitung jumlah semua pengaduan
        $totalComplaints = Complaint::count(); 

        // Menghitung jumlah pengaduan dengan status '0' (pending)
        $pendingComplaints = Complaint::where('status', '0')->count(); 

        // Menghitung jumlah pengaduan dengan status 'proses'
        $processingComplaints = Complaint::where('status', 'proses')->count(); 

        // Menghitung jumlah pengaduan dengan status 'selesai'
        $completedComplaints = Complaint::where('status', 'selesai')->count(); 

        $airkeruhComplaints = Complaint::where('judul_laporan', 'air keruh')->count(); 

        $kebocoranComplaints = Complaint::where('judul_laporan', 'kebocoran')->count(); 

        $meteranComplaints = Complaint::where('judul_laporan', 'meteran')->count(); 

        $pemakaianComplaints = Complaint::where('judul_laporan', 'pemakaian')->count(); 

        $tidakdapatairComplaints = Complaint::where('judul_laporan', 'tidak dapat air')->count(); 

        $lainnyaComplaints = Complaint::where('judul_laporan', 'lainnya')->count(); 

        $groupBy = $request->input('group_by', 'day');
        $wilayahKejadian = $request->input('wilayah_kejadian');
        $judulLaporan = $request->input('judul_laporan');
    
        // Ambil opsi filter dari database
        $wilayahKejadianOptions = Pengaduan::select('wilayah_kejadian')->distinct()->pluck('wilayah_kejadian');
        $judulLaporanOptions = Pengaduan::select('judul_laporan')->distinct()->pluck('judul_laporan');
    
        $query = Pengaduan::query();
    
        if ($wilayahKejadian) {
            $query->where('wilayah_kejadian', $wilayahKejadian);
        }
    
        if ($judulLaporan) {
            $query->where('judul_laporan', $judulLaporan);
        }
    
        // Group by sesuai pilihan (day, week, month)
        if ($groupBy == 'day') {
            $query->selectRaw('DATE(created_at) as date, judul_laporan, COUNT(*) as count')
                  ->groupBy('date', 'judul_laporan');
        } elseif ($groupBy == 'week') {
            $query->selectRaw('YEARWEEK(created_at) as date, judul_laporan, COUNT(*) as count')
                  ->groupBy('date', 'judul_laporan');
        } elseif ($groupBy == 'month') {
            $query->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, judul_laporan, COUNT(*) as count')
                  ->groupBy('year', 'month', 'judul_laporan');
        }
    
        $results = $query->get();
        $dates = $results->pluck('date')->unique();
        $jumlahLaporan = [];
    
        foreach ($judulLaporanOptions as $option) {
            $jumlahLaporan[$option] = $results->where('judul_laporan', $option)->pluck('count', 'date')->toArray();
        }
    
        return view('admin.dashboard.index', compact('dates', 'jumlahLaporan', 'groupBy', 'wilayahKejadianOptions', 'judulLaporanOptions', 'totalComplaints', 'pendingComplaints', 'processingComplaints', 'completedComplaints', 'airkeruhComplaints', 'kebocoranComplaints', 'meteranComplaints', 'pemakaianComplaints', 'tidakdapatairComplaints', 'lainnyaComplaints'));
    }
    
}

?>