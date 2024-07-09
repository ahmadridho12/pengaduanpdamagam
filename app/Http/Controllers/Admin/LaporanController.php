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
        $wilayah_kejadian = $request->wilayah_kejadian;

        Log::info('Request parameters:', [
            'from' => $from,
            'to' => $to,
            'wilayah_kejadian' => $wilayah_kejadian
        ]);

        $query = Pengaduan::query();

        if ($from && $to) {
            $query->whereBetween('tgl_pengaduan', [$from, $to]);
        }

        if ($wilayah_kejadian && $wilayah_kejadian !== '') {
            $query->where('wilayah_kejadian', $wilayah_kejadian);
        }

        $pengaduan = $query->get();

        Log::info('Query result:', [
            'sql' => $query->toSql(),
            'bindings' => $query->getBindings(),
            'count' => $pengaduan->count()
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('Admin.Laporan.cetak', [
            'pengaduan' => $pengaduan,
            'from' => $request->from,
            'to' => $request->to,
            'wilayah_kejadian' => $wilayah_kejadian
        ])->render());
    
        $dompdf->setPaper('A4', 'landscape');
    
        $dompdf->render();
        return $dompdf->stream('laporan-pengaduan.pdf');
    }
    

    public function cetakLaporanExcel(Request $request)
    {
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

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menambahkan judul laporan
        $sheet->mergeCells('A1:M1');
        $sheet->setCellValue('A1', 'Laporan Pengaduan Pelanggan');
        $sheet->mergeCells('A2:M2');
        $sheet->setCellValue('A2', 'TIRTA ANTOKAN');

        // Menambahkan informasi periode, wilayah, total data, dan tanggal cetak
        $row = 3;
        if ($from && $to) {
            $sheet->mergeCells('A'.$row.':M'.$row);
            $sheet->setCellValue('A'.$row, 'Periode: ' . \Carbon\Carbon::parse($from)->format('d-M-Y') . ' - ' . \Carbon\Carbon::parse($to)->format('d-M-Y'));
            $row++;
        }
        if ($wilayah_kejadian && $wilayah_kejadian !== '') {
            $sheet->mergeCells('A'.$row.':M'.$row);
            $sheet->setCellValue('A'.$row, 'Wilayah Kejadian: ' . $wilayah_kejadian);
            $row++;
        }
        $sheet->mergeCells('A'.$row.':M'.$row);
        $sheet->setCellValue('A'.$row, 'Total Data: ' . $pengaduan->count());
        $row++;
        $sheet->mergeCells('A'.$row.':M'.$row);
        $sheet->setCellValue('A'.$row, 'Dicetak pada: ' . now()->format('d-M-Y H:i:s'));
        $row++;

        // Menambahkan baris kosong
        $row++;

        // Menambahkan header tabel
        $sheet->setCellValue('A'.$row, 'No');
        $sheet->setCellValue('B'.$row, 'Tanggal');
        $sheet->setCellValue('C'.$row, 'Nama');
        $sheet->setCellValue('D'.$row, 'No Telepon');
        $sheet->setCellValue('E'.$row, 'No Sambungan');
        $sheet->setCellValue('F'.$row, 'Kode Laporan');
        $sheet->setCellValue('G'.$row, 'Judul Laporan');
        $sheet->setCellValue('H'.$row, 'Isi Laporan');
        $sheet->setCellValue('I'.$row, 'Tanggal Kejadian');
        $sheet->setCellValue('J'.$row, 'Wilayah Kejadian');
        $sheet->setCellValue('K'.$row, 'Lokasi Kejadian');
        $sheet->setCellValue('L'.$row, 'Tanggal Dikerjakan');
        $sheet->setCellValue('M'.$row, 'Status');
        $row++;

        // Menambahkan data pengaduan
        foreach ($pengaduan as $k => $v) {
            $sheet->setCellValue('A'.$row, $k + 1);
            $sheet->setCellValue('B'.$row, $v->tgl_pengaduan->format('d-M-Y'));
            $sheet->setCellValue('C'.$row, $v->nama);
            $sheet->setCellValue('D'.$row, $v->no_hp);
            $sheet->setCellValue('E'.$row, $v->no_index);
            $sheet->setCellValue('F'.$row, $v->kode_laporan);
            $sheet->setCellValue('G'.$row, $v->judul_laporan);
            $sheet->setCellValue('H'.$row, $v->isi_laporan);
            $sheet->setCellValue('I'.$row, $v->tgl_kejadian->format('d-M-Y'));
            $sheet->setCellValue('J'.$row, $v->wilayah_kejadian);
            $sheet->setCellValue('K'.$row, $v->lokasi_kejadian);
            $sheet->setCellValue('L'.$row, $v->tanggapan && $v->tanggapan->tgl_tanggapan ? date('d-M-Y', strtotime($v->tanggapan->tgl_tanggapan)) : '');
            $sheet->setCellValue('M'.$row, $v->status == '0' ? 'Pending' : ucwords($v->status));
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
        $sheet->getStyle('A3:M'.$row)->applyFromArray($styleArray);

        // Mengatur lebar kolom secara otomatis
        foreach(range('A','M') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
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