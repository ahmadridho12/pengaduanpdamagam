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
        $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date',
            'wilayah_kejadian' => 'nullable|string'
        ]);

        $from = $request->from ? $request->from . ' 00:00:00' : null;
        $to = $request->to ? $request->to . ' 23:59:59' : null;
        $wilayah_kejadian = $request->wilayah_kejadian;

        Log::info('Received input:', [
            'from' => $from,
            'to' => $to,
            'wilayah_kejadian' => $wilayah_kejadian
        ]);

        $wilayah = Pengaduan::select('wilayah_kejadian')->distinct()->get();

        $query = Pengaduan::query();

        if ($from && $to) {
            $query->whereBetween('tgl_pengaduan', [$from, $to]);
        }

        if ($wilayah_kejadian && $wilayah_kejadian !== '') {
            $query->where('wilayah_kejadian', $wilayah_kejadian);
        }

        Log::info('Query debugging:', [
            'sql' => $query->toSql(),
            'bindings' => $query->getBindings()
        ]);

        $pengaduan = $query->get();

        Log::info('Query result:', [
            'count' => $pengaduan->count(),
            'results' => $pengaduan->toArray()
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('Admin.Laporan.cetak', [
            'pengaduan' => $pengaduan,
            'from' => $request->from,
            'to' => $request->to,
            'wilayah' => $wilayah,
            'wilayah_kejadian' => $wilayah_kejadian
        ])->render());

        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();
        return $dompdf->stream('laporan-pengaduan.pdf');
    }

    
    public function cetakLaporanExcel(Request $request)
    {
        $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date',
            'wilayah_kejadian' => 'nullable|string',
        ]);
    
        $from = $request->from ? $request->from . ' 00:00:00' : null;
        $to = $request->to ? $request->to . ' 23:59:59' : null;
        $wilayah_kejadian = $request->wilayah_kejadian;
    
        $query = Pengaduan::query();
    
        if ($from && $to) {
            $query->whereBetween('tgl_pengaduan', [$from, $to]);
        }
    
        if ($wilayah_kejadian && $wilayah_kejadian !== '') {
            $query->where('wilayah_kejadian', $wilayah_kejadian);
        }
    
        $pengaduan = $query->get();
    
        // Membuat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Pengaduan');
    
        // Set judul laporan untuk sheet pertama
        $sheet->setCellValue('A1', 'Laporan Pengaduan Pelanggan');
        $sheet->setCellValue('A2', 'TIRTA ANTOKAN');
    
        // Merge cells for title
        $sheet->mergeCells('A1:L1');
        $sheet->mergeCells('A2:L2');
    
        // Set style for title
        $sheet->getStyle('A1:A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:A2')->getFont()->setSize(16)->setBold(true)->getColor()->setARGB('FFFFFFFF');
        $sheet->getStyle('A1:A2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF1F497D');
    
        // Set header column names untuk sheet pertama
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Tanggal Pengaduan');
        $sheet->setCellValue('C3', 'Nama Pelapor');
        $sheet->setCellValue('D3', 'No Telepon');
        $sheet->setCellValue('E3', 'No Sambungan');
        $sheet->setCellValue('F3', 'Kode Laporan');
        $sheet->setCellValue('G3', 'Judul Laporan');
        $sheet->setCellValue('H3', 'Isi Laporan');
        $sheet->setCellValue('I3', 'Tanggal Kejadian');
        $sheet->setCellValue('J3', 'Wilayah Kejadian');
        $sheet->setCellValue('K3', 'Lokasi Kejadian');
        $sheet->setCellValue('L3', 'Status');
    
        // Apply styles to header row untuk sheet pertama
        $headerCells = 'A3:L3';
        $sheet->getStyle($headerCells)->getFont()->setBold(true);
        $sheet->getStyle($headerCells)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle($headerCells)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFD9D9D9');
    
        // Fill data rows untuk sheet pertama
        $row = 4;
        foreach ($pengaduan as $key => $data) {
            $sheet->setCellValue('A' . $row, $key + 1);
            $sheet->setCellValue('B' . $row, $data->tgl_pengaduan->format('d-M-Y'));
            $sheet->setCellValue('C' . $row, $data->nama);
            $sheet->setCellValue('D' . $row, $data->no_hp);
            $sheet->setCellValue('E' . $row, $data->no_index);
            $sheet->setCellValue('F' . $row, $data->kode_laporan);
            $sheet->setCellValue('G' . $row, $data->judul_laporan);
            $sheet->setCellValue('H' . $row, $data->isi_laporan);
            $sheet->setCellValue('I' . $row, $data->tgl_kejadian->format('d-M-Y'));
            $sheet->setCellValue('J' . $row, $data->wilayah_kejadian);
            $sheet->setCellValue('K' . $row, $data->lokasi_kejadian);
            $sheet->setCellValue('L' . $row, $data->status == '0' ? 'Pending' : ucwords($data->status));
    
            // Set border untuk setiap sel pada sheet pertama
            $borderRange = 'A' . $row . ':L' . $row;
            $sheet->getStyle($borderRange)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ]);
    
            $row++;
        }
    
        // Auto size columns untuk sheet pertama
        foreach(range('A','L') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    
        // Menambahkan sheet baru untuk jumlah laporan
        $newSheet = $spreadsheet->createSheet();
        $newSheet->setTitle('Jumlah Laporan');
    
        // Set judul laporan untuk sheet kedua
        $newSheet->setCellValue('A1', 'Judul Laporan');
        $newSheet->setCellValue('B1', 'Jumlah');
    
        // Auto size kolom untuk sheet kedua
        foreach (range('A', 'B') as $column) {
            $newSheet->getColumnDimension($column)->setAutoSize(true);
        }
    
        // Mendapatkan semua judul laporan yang ada
        $allJudulLaporan = Pengaduan::select('judul_laporan')->distinct()->pluck('judul_laporan');
    
        // Menginisialisasi baris awal untuk sheet kedua
        $row = 2;
    
        // Total laporan counter
        $totalLaporan = 0;
    
        // Iterasi melalui setiap judul laporan
        foreach ($allJudulLaporan as $judul) {
            // Menghitung jumlah laporan untuk judul tertentu
            $count = $pengaduan->where('judul_laporan', $judul)->count();
    
            // Menulis judul laporan dan jumlahnya ke sheet kedua
            $newSheet->setCellValue('A' . $row, $judul);
            $newSheet->setCellValue('B' . $row, $count);
    
            // Increment total laporan
            $totalLaporan += $count;
    
            $row++;
        }
    
        // Menambahkan total jumlah laporan
        $newSheet->setCellValue('A' . $row, 'Total');
        $newSheet->setCellValue('B' . $row, $totalLaporan);
        $newSheet->getStyle('A' . $row . ':B' . $row)->getFont()->setBold(true);
    
        // Set judul laporan untuk tabel di sheet kedua
        $newSheet->getStyle('A1:B1')->getFont()->setBold(true);
        $newSheet->getStyle('A1:B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $newSheet->getStyle('A1:B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFD9D9D9');
    
        // Menambahkan border untuk seluruh data pada sheet kedua
        $borderRange = 'A1:B' . ($row); // Menghitung total baris untuk border
    
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
    
        $newSheet->getStyle($borderRange)->applyFromArray($styleArray);
    
        // Simpan file Excel ke storage
        $fileName = 'laporan_pengaduan.xlsx';
        $filePath = public_path($fileName);
    
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);
    
        // Download file
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
    
    
}
