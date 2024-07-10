<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Membuat objek Spreadsheet baru
$spreadsheet = new Spreadsheet();

// Worksheet 1 - Laporan Pengaduan
$sheet1 = $spreadsheet->getActiveSheet();
$sheet1->setTitle('Laporan Pengaduan');

// Menetapkan judul laporan pada baris pertama di Worksheet 1
$sheet1->setCellValue('A1', 'Laporan Pengaduan Pelanggan');
$sheet1->setCellValue('A2', 'TIRTA ANTOKAN');

// Menambahkan warna latar belakang pada sel A1 di Worksheet 1
$sheet1->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');

// Menambahkan warna teks pada sel B3 di Worksheet 1
$sheet1->getStyle('B3')->getFont()->getColor()->setARGB('FF0000FF');

// Menambahkan header tabel pada baris ketiga di Worksheet 1
$sheet1->setCellValue('A3', 'No');
$sheet1->setCellValue('B3', 'Tanggal Pengaduan');
$sheet1->setCellValue('C3', 'Nama Pelapor');
$sheet1->setCellValue('D3', 'NO Telepon');
$sheet1->setCellValue('E3', 'No Sambungan');
$sheet1->setCellValue('F3', 'Kode Laporan');
$sheet1->setCellValue('G3', 'Judul Laporan');
$sheet1->setCellValue('H3', 'Isi Laporan');
$sheet1->setCellValue('I3', 'Tanggal Kejadian');
$sheet1->setCellValue('J3', 'Wilayah Kejadian');
$sheet1->setCellValue('K3', 'Lokasi Kejadian');
$sheet1->setCellValue('L3', 'Tanggal Dikerjakan');
$sheet1->setCellValue('M3', 'Status');

// Mengisi data ke dalam tabel dari variabel $pengaduan di Worksheet 1
$row = 4;
foreach ($pengaduan as $k => $v) {
    $sheet1->setCellValue('A'.$row, $k + 1);
    $sheet1->setCellValue('B'.$row, $v->tgl_pengaduan->format('d-M-Y'));
    $sheet1->setCellValue('C'.$row, $v->nama);
    $sheet1->setCellValue('D'.$row, $v->no_hp);
    $sheet1->setCellValue('E'.$row, $v->no_index);
    $sheet1->setCellValue('F'.$row, $v->kode_laporan);
    $sheet1->setCellValue('G'.$row, $v->judul_laporan);
    $sheet1->setCellValue('H'.$row, $v->isi_laporan);
    $sheet1->setCellValue('I'.$row, $v->tgl_kejadiann->format('d-M-Y'));
    $sheet1->setCellValue('J'.$row, $v->wilayah_kejadian);
    $sheet1->setCellValue('K'.$row, $v->lokasi_kejadian);
    $sheet1->setCellValue('L'.$row, $v->tanggapan ? ($v->tanggapan->tgl_tanggapan ? $v->tanggapan->tgl_tanggapan->format('d-M-Y') : '') : '');
    $sheet1->setCellValue('M'.$row, $v->status == '0' ? 'Pending' : ucwords($v->status));
    $row++;
}

// Mengatur lebar kolom agar sesuai dengan isi data secara otomatis di Worksheet 1
foreach(range('A','N') as $columnID) {
    $sheet1->getColumnDimension($columnID)->setAutoSize(true);
}

// Menambahkan border pada seluruh data tabel di Worksheet 1
$highestRow = $sheet1->getHighestRow();
$highestColumn = $sheet1->getHighestColumn();
$sheet1->getStyle('A1:'.$highestColumn.$highestRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

// Worksheet 2 - Laporan Jenis Keluhan
$sheet2 = $spreadsheet->createSheet();
$sheet2->setTitle('Laporan Jenis Keluhan');

// Menetapkan judul laporan pada baris pertama di Worksheet 2
$sheet2->setCellValue('A1', 'Laporan Jenis Keluhan');

// Menghitung jumlah pengaduan dari Worksheet 1
$jumlahPengaduan = $sheet1->getHighestRow() - 3; // Mengurangi 3 untuk header

// Menambahkan jumlah pengaduan di sebelah sel A1
$sheet2->setCellValue('B1', 'Jumlah Pengaduan:');
$sheet2->setCellValue('C1', $jumlahPengaduan);

// Inisialisasi array untuk menghitung jenis keluhan
$jenisKeluhan = [
    'air keruh' => 0,
    'kebocoran' => 0,
    'meteran' => 0,
    'pemakaian' => 0,
    'tidak dapat air' => 0,
    'ainnya' => 0
];

// Menghitung jumlah untuk setiap jenis keluhan
foreach ($pengaduan as $v) {
    Log::info('Judul laporan: ' . $v->judul_laporan);
    $found = false;
    foreach ($jenisKeluhan as $jenis => $count) {
        if (stripos($v->judul_laporan, $jenis) !== false) {
            $jenisKeluhan[$jenis]++;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $jenisKeluhan['Lainnya']++;
    }
}

Log::info('Hasil perhitungan jenis keluhan:', $jenisKeluhan);

// Menambahkan header untuk tabel jenis keluhan
$sheet2->setCellValue('A3', 'Jenis Keluhan');
$sheet2->setCellValue('B3', 'Jumlah');

// Menambahkan data judul laporan dan jumlah keluhan ke dalam tabel di Worksheet 2
$row = 4;
foreach ($jenisKeluhan as $jenis => $jumlah) {
    $sheet2->setCellValue('A' . $row, $jenis);
    $sheet2->setCellValue('B' . $row, $jumlah > 0 ? $jumlah : '');
    $row++;
}

// Mengatur lebar kolom agar sesuai dengan isi data secara otomatis di Worksheet 2
foreach(range('A','C') as $columnID) {
    $sheet2->getColumnDimension($columnID)->setAutoSize(true);
}

// Menyimpan file Excel ke direktori yang ditentukan
$writer = new Xlsx($spreadsheet);
$writer->save('laporan_pengaduan.xlsx');