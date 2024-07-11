<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border; 

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

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Pengaduan');

        // Set judul laporan
        $sheet->setCellValue('A1', 'Laporan Pengaduan Pelanggan');
        $sheet->setCellValue('A2', 'TIRTA ANTOKAN');

        // Merge cells for title
        $sheet->mergeCells('A1:L1');
        $sheet->mergeCells('A2:L2');

        // Set style for title
        $sheet->getStyle('A1:A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:A2')->getFont()->setSize(16)->setBold(true)->getColor()->setARGB('FFFFFFFF');
        $sheet->getStyle('A1:A2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF1F497D');

        // Set header column names
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

        // Apply styles to header row
        $headerCells = 'A3:L3';
        $sheet->getStyle($headerCells)->getFont()->setBold(true);
        $sheet->getStyle($headerCells)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle($headerCells)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFD9D9D9');

        // Fill data rows
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
            $row++;
        }

        // Auto size columns
        foreach(range('A','L') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Set borders for all cells
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $sheet->getStyle('A3:' . $highestColumn . $highestRow)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        // Save Excel file to storage
        $fileName = 'laporan_pengaduan.xlsx';
        $filePath = public_path($fileName);

        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        // Download the file
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
