<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanController extends Controller
{
    public function index()
    {
        // Get all unique wilayah_kejadian from the Pengaduan table
        $wilayah = Pengaduan::select('wilayah_kejadian')->distinct()->get();

        return view('Admin.Laporan.index', [
            'wilayah' => $wilayah,
            'wilayah_kejadian' => null,
            'from' => null,
            'to' => null
        ]);
    }

    public function getLaporan(Request $request)
    {
        $from = $request->from . ' 00:00:00';
        $to = $request->to . ' 23:59:59';
        $wilayah_kejadian = $request->wilayah_kejadian;

        $query = Pengaduan::whereBetween('tgl_pengaduan', [$from, $to]);

        if ($wilayah_kejadian && $wilayah_kejadian !== '') {
            $query->where('wilayah_kejadian', $wilayah_kejadian);
        }

        $pengaduan = $query->get();

        $wilayah = Pengaduan::select('wilayah_kejadian')->distinct()->get();

        return view('Admin.Laporan.index', [
            'pengaduan' => $pengaduan,
            'from' => $request->from,
            'to' => $request->to,
            'wilayah' => $wilayah,
            'wilayah_kejadian' => $wilayah_kejadian
        ]);
    }

    public function cetakLaporan(Request $request)
{
    $from = $request->from ? $request->from . ' 00:00:00' : null;
    $to = $request->to ? $request->to . ' 23:59:59' : null;

    // Filter berdasarkan wilayah kejadian jika wilayah dipilih
    $query = Pengaduan::query();
    if ($from && $to) {
        $query->whereBetween('tgl_pengaduan', [$from, $to]);
    }
    if ($request->wilayah_kejadian && $request->wilayah_kejadian !== '') {
        $query->where('wilayah_kejadian', $request->wilayah_kejadian);
    }

    $pengaduan = $query->get();

    // Load the view and generate PDF
    $dompdf = new Dompdf();
    $dompdf->loadHtml(view('Admin.Laporan.cetak', [
        'pengaduan' => $pengaduan,
        'from' => $request->from,
        'to' => $request->to,
        'wilayah_kejadian' => $request->wilayah_kejadian
    ])->render());

    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    // Stream the PDF to the browser
    }
    

    public function cetakLaporanExcel(Request $request)
    {
        // Ambil parameter dari request
        $from = $request->from ? $request->from . ' 00:00:00' : null;
        $to = $request->to ? $request->to . ' 23:59:59' : null;
        $wilayah_kejadian = $request->wilayah_kejadian;
    
        // Query data pengaduan berdasarkan filter
        $query = Pengaduan::query();
        if ($from && $to) {
            $query->whereBetween('tgl_pengaduan', [$from, $to]);
        }
        if ($wilayah_kejadian && $wilayah_kejadian !== '') {
            $query->where('wilayah_kejadian', $wilayah_kejadian);
        }
        $pengaduan = $query->get();
    
        // Buat objek Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        
        // Worksheet 1 - Laporan Pengaduan
        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet1->setTitle('Laporan Pengaduan');
    
        // Menambahkan judul laporan
        $sheet1->mergeCells('A1:M1');
        $sheet1->setCellValue('A1', 'Laporan Pengaduan Pelanggan');
        $sheet1->mergeCells('A2:M2');
        $sheet1->setCellValue('A2', 'TIRTA ANTOKAN');
    
        // Menambahkan informasi periode, wilayah, total data, dan tanggal cetak
        $row = 3;
        if ($from && $to) {
            $sheet1->mergeCells('A'.$row.':M'.$row);
            $sheet1->setCellValue('A'.$row, 'Periode: ' . \Carbon\Carbon::parse($from)->format('d-M-Y') . ' - ' . \Carbon\Carbon::parse($to)->format('d-M-Y'));
            $row++;
        }
        if ($wilayah_kejadian && $wilayah_kejadian !== '') {
            $sheet1->mergeCells('A'.$row.':M'.$row);
            $sheet1->setCellValue('A'.$row, 'Wilayah Kejadian: ' . $wilayah_kejadian);
            $row++;
        }
        $sheet1->mergeCells('A'.$row.':M'.$row);
        $sheet1->setCellValue('A'.$row, 'Total Data: ' . $pengaduan->count());
        $row++;
        $sheet1->mergeCells('A'.$row.':M'.$row);
        $sheet1->setCellValue('A'.$row, 'Dicetak pada: ' . now()->format('d-M-Y H:i:s'));
        $row++;
    
        // Menambahkan baris kosong
        $row++;
    
        // Menambahkan header tabel
        $sheet1->setCellValue('A'.$row, 'No');
        $sheet1->setCellValue('B'.$row, 'Tanggal');
        $sheet1->setCellValue('C'.$row, 'Nama');
        $sheet1->setCellValue('D'.$row, 'No Telepon');
        $sheet1->setCellValue('E'.$row, 'No Sambungan');
        $sheet1->setCellValue('F'.$row, 'Kode Laporan');
        $sheet1->setCellValue('G'.$row, 'Judul Laporan');
        $sheet1->setCellValue('H'.$row, 'Isi Laporan');
        $sheet1->setCellValue('I'.$row, 'Tanggal Kejadian');
        $sheet1->setCellValue('J'.$row, 'Wilayah Kejadian');
        $sheet1->setCellValue('K'.$row, 'Lokasi Kejadian');
        $sheet1->setCellValue('L'.$row, 'Tanggal Dikerjakan');
        $sheet1->setCellValue('M'.$row, 'Status');
        $row++;
    
        // Menambahkan data pengaduan
        foreach ($pengaduan as $k => $v) {
            $sheet1->setCellValue('A'.$row, $k + 1);
            $sheet1->setCellValue('B'.$row, $v->tgl_pengaduan->format('d-M-Y'));
            $sheet1->setCellValue('C'.$row, $v->nama);
            $sheet1->setCellValue('D'.$row, $v->no_hp);
            $sheet1->setCellValue('E'.$row, $v->no_index);
            $sheet1->setCellValue('F'.$row, $v->kode_laporan);
            $sheet1->setCellValue('G'.$row, $v->judul_laporan);
            $sheet1->setCellValue('H'.$row, $v->isi_laporan);
            $sheet1->setCellValue('I'.$row, $v->tgl_kejadian->format('d-M-Y'));
            $sheet1->setCellValue('J'.$row, $v->wilayah_kejadian);
            $sheet1->setCellValue('K'.$row, $v->lokasi_kejadian);
            $sheet1->setCellValue('L'.$row, $v->tanggapan && $v->tanggapan->tgl_tanggapan ? date('d-M-Y', strtotime($v->tanggapan->tgl_tanggapan)) : '');
            $sheet1->setCellValue('M'.$row, $v->status == '0' ? 'Pending' : ucwords($v->status));
            $row++;
        }
    
        // Menambahkan border pada seluruh data tabel
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet1->getStyle('A3:M'.$row)->applyFromArray($styleArray);
    
        // Mengatur lebar kolom secara otomatis
        foreach(range('A','M') as $columnID) {
            $sheet1->getColumnDimension($columnID)->setAutoSize(true);
        }
    
        // Worksheet 2 - Laporan Jenis Keluhan
        $sheet2 = $spreadsheet->createSheet();
        $sheet2->setTitle('Laporan Jenis Keluhan');

        // Menambahkan judul laporan pada worksheet 2
        $sheet2->setCellValue('A1', 'Laporan Jenis Keluhan');

        // Menghitung jumlah pengaduan
        $jumlahPengaduan = $pengaduan->count();
        $sheet2->setCellValue('B1', 'Jumlah Pengaduan:');
        $sheet2->setCellValue('C1', $jumlahPengaduan);

        // Inisialisasi array untuk menghitung jenis keluhan
        $jenisKeluhan = [
            'air keruh' => 0,
            'kebocoran' => 0,
            'meteran' => 0,
            'pemakaian' => 0,
            'tidak dapat air' => 0,
            'lainnya' => 0
        ];

        // Menghitung jumlah untuk setiap jenis keluhan
        foreach ($pengaduan as $v) {
            $judulLaporan = strtolower($v->judul_laporan);
            $found = false;
            foreach ($jenisKeluhan as $jenis => $count) {
                if (strpos($judulLaporan, $jenis) !== false) {
                    $jenisKeluhan[$jenis]++;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $jenisKeluhan['lainnya']++;
            }
        }

        Log::info('Hasil perhitungan jenis keluhan:', $jenisKeluhan);

        // Menambahkan header untuk tabel jenis keluhan
        $sheet2->setCellValue('A3', 'Jenis Keluhan');
        $sheet2->setCellValue('B3', 'Jumlah');

        // Menambahkan data judul laporan dan jumlah keluhan ke dalam tabel pada worksheet 2
        $row = 4;
        foreach ($jenisKeluhan as $jenis => $jumlah) {
            $sheet2->setCellValue('A' . $row, ucwords($jenis));
            $sheet2->setCellValue('B' . $row, $jumlah);
            $row++;
        }

        

        // Membuat objek Writer untuk menulis ke file
        $writer = new Xlsx($spreadsheet);
    
        // Mendapatkan nama file
        $filename = 'laporan_pengaduan_'.$from.'_'.$to.'.xlsx';
    
        // Mengatur header untuk respons
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
    
        // Menulis file Excel ke output
        $writer->save('php://output');
    }
    
}