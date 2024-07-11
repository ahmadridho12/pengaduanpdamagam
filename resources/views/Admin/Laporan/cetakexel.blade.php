<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;

// Membuat objek Spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Menetapkan judul laporan pada baris pertama
$sheet->setCellValue('A1', 'Laporan Pengaduan Pelanggan');
$sheet->setCellValue('A2', 'TIRTA ANTOKAN');

// Menambahkan warna latar belakang pada sel A1
$sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');

// Menambahkan warna teks pada sel B2
$sheet->getStyle('B2')->getFont()->getColor()->setARGB('FF0000FF');

// Menambahkan header tabel pada baris ketiga
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

// Mengisi data ke dalam tabel dari variabel $pengaduan
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
    $sheet->setCellValue('L'.$row, $v->status == '0' ? 'Pending' : ucwords($v->status));
    $row++;
}

// Mengatur lebar kolom agar sesuai dengan isi data secara otomatis
foreach(range('A','L') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Menambahkan border pada seluruh data tabel
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();
$sheet->getStyle('A3:'.$highestColumn.$highestRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

// Membuat objek Writer untuk menyimpan ke file Excel
$writer = new Xlsx($spreadsheet);

// Menyimpan file Excel ke direktori yang ditentukan
$writer->save('laporan_pengaduan.xlsx');
