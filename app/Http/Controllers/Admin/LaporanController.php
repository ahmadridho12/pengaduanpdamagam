<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanController extends Controller
{
    public function index()
    {
        return view('Admin.Laporan.index');
    }

    public function getLaporan(Request $request)
    {
        $from = $request->from . ' ' . '00:00:00';
        $to = $request->to . ' ' . '23:59:59';

        $pengaduan = Pengaduan::whereBetween('tgl_pengaduan', [$from, $to])->get();

        return view('Admin.Laporan.index', ['pengaduan' => $pengaduan, 'from' => $from, 'to' => $to]);
    }

    public function cetakLaporan($from, $to)
{
    $pengaduan = Pengaduan::whereBetween('tgl_pengaduan', [$from, $to])->get();

    $dompdf = new Dompdf();
    $dompdf->loadHtml(view('Admin.Laporan.cetak', [
        'pengaduan' => $pengaduan,
        'from' => $from,
        'to' => $to
    ])->render());

    $dompdf->setPaper('A4', 'landscape');

    $dompdf->render();
    return $dompdf->stream('laporan-pengaduan.pdf');
}
    public function cetakLaporanExcel($from, $to)
    {
        $pengaduan = Pengaduan::whereBetween('tgl_pengaduan', [$from, $to])->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menambahkan judul laporan
        $sheet->mergeCells('A1:L1');
        $sheet->setCellValue('A1', 'Laporan Pengaduan Pelanggan');
        $sheet->mergeCells('A2:L2');
        $sheet->setCellValue('A2', 'TIRTA ANTOKAN');

        // Menambahkan header tabel
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Tanggal');
        $sheet->setCellValue('C3', 'Nama');
        $sheet->setCellValue('D3', 'No Telepon');
        $sheet->setCellValue('E3', 'No Sambungan');
        $sheet->setCellValue('F3', 'Kode Laporan');
        $sheet->setCellValue('G3', 'Judul Laporan');
        $sheet->setCellValue('H3', 'Isi Laporan');
        $sheet->setCellValue('I3', 'Tanggal Kejadian');
        $sheet->setCellValue('J3', 'Wilayah Kejadian');
        $sheet->setCellValue('K3', 'Lokasi Kejadian');
        $sheet->setCellValue('L3', 'Tanggal Dikerjakan');
        $sheet->setCellValue('M3', 'Status');

        // Menambahkan warna pada baris header tabel
        $sheet->getStyle('A3:M3')->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '5A5A5A',
                ],
            ],
            'font' => [
                'color' => [
                    'rgb' => 'FFFFFF',
                ],
            ],
        ]);
        

        // Menambahkan data pengaduan
        $row = 4;
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

            // Menambahkan data "Tanggal Dikerjakan" dari $v->tgl_tanggapan yang berasal dari tabel tanggapan dengan pengecekan null:
            // - Jika $v->tanggapan tidak null dan $v->tanggapan->tgl_tanggapan tidak null, maka gunakan format 'd-M-Y', jika null, gunakan string kosong ''
            // - Jika $v->tanggapan null, maka gunakan string kosong ''
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
