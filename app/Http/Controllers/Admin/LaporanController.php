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

        $spreadsheet = new Spreadsheet();
        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet1->setTitle('Laporan Pengaduan');

        $sheet1->setCellValue('A1', 'No');
        $sheet1->setCellValue('B1', 'Tanggal');
        $sheet1->setCellValue('C1', 'Nama');
        $sheet1->setCellValue('D1', 'No Telepon');
        $sheet1->setCellValue('E1', 'No Sambungan');
        $sheet1->setCellValue('F1', 'Kode Laporan');
        $sheet1->setCellValue('G1', 'Judul Laporan');
        $sheet1->setCellValue('H1', 'Isi Laporan');
        $sheet1->setCellValue('I1', 'Tanggal Kejadian');
        $sheet1->setCellValue('J1', 'Wilayah Kejadian');
        $sheet1->setCellValue('K1', 'Lokasi Kejadian');
        $sheet1->setCellValue('L1', 'Tanggal Dikerjakan');
        $sheet1->setCellValue('M1', 'Status');

        $row = 2;
        foreach ($pengaduan as $k => $v) {
            $sheet1->setCellValue('A'.$row, $k + 1);
            $sheet1->setCellValue('B'.$row, \Carbon\Carbon::parse($v->tgl_pengaduan)->format('d-M-Y'));
            $sheet1->setCellValue('C'.$row, $v->nama);
            $sheet1->setCellValue('D'.$row, $v->no_hp);
            $sheet1->setCellValue('E'.$row, $v->no_index);
            $sheet1->setCellValue('F'.$row, $v->kode_laporan);
            $sheet1->setCellValue('G'.$row, $v->judul_laporan);
            $sheet1->setCellValue('H'.$row, $v->isi_laporan);
            $sheet1->setCellValue('I'.$row, \Carbon\Carbon::parse($v->tgl_kejadian)->format('d-M-Y'));
            $sheet1->setCellValue('J'.$row, $v->wilayah_kejadian);
            $sheet1->setCellValue('K'.$row, $v->lokasi_kejadian);
            $sheet1->setCellValue('L'.$row, $v->tgl_dikerjakan ? \Carbon\Carbon::parse($v->tgl_dikerjakan)->format('d-M-Y') : '');
            $sheet1->setCellValue('M'.$row, $v->status);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'laporan_pengaduan.xlsx';
        $filePath = public_path($fileName);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
