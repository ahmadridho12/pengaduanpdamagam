<!DOCTYPE html>
<html>
<head>
    <style>
        @page {
            size: 13in 8.5in; /* Ukuran kertas setengah dari ukuran Letter */
            margin: 10mm; /* Mengatur margin halaman */
        }
        body { font-family: Arial, sans-serif; }
        .header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 5px; margin-top: 0; }
        .header .left-logo { flex: 0 0 auto; }
        
        .header .company-info { text-align: center; flex-grow: 1; }
        .header .company-info h1, .header .company-info h2, .header .company-info p { margin: 0; }
        .header .company-info h3, .header .company-info h2 { margin-bottom: 5px; }
        .header .company-info hr { margin: 10px auto; width: 50%; } /* Perpendek hr */
        .content {
            margin: 0 10px;
            margin-top: 0;
        }
        .content table { width: 100%; border-collapse: collapse; }
        .content th, .content td { border: 1px solid #000; padding: 8px; text-align: left; }
        .signature-container { margin-top: 50px;  margin-left:24px; } /* Ubah text-align ke kiri */
        .signature { width: 45%; margin-left: 0; text-align: left; } /* margin kiri dan teks ke kiri */
        .footer { margin-top: 50px; text-align: center; }
        .footer .signature { display: inline-block; width: 45%; text-align: center; }
        .signature-name {
            margin-bottom: 12px;
            margin-left: 30px; /* Geser teks ke kiri sejauh 30px */
        }
        .header.right-logo {
            margin-top: 16px;
            right: 200px;
            position: relative;
        }
        .signature-name1 {
            font-size: smaller;
            font-weight: bold;
            margin-left: 30px; /* Geser teks ke kiri sejauh 30px */
        }
        hr.short-hr {
            width: 50%;
            margin-left: 0;
        }
        .signature.agam {
            margin-right: -100px;
        }
        hr.long-hr {
            width: 100%;
            
        }
        .bapak {
            margin-left: 80px;
        }
        .agam {
            margin-left: 74px;
        }
        .perusahaan {
            margin-left: 16px;
        }
        .lubukbasung {
            margin-left: 34px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logopdam.png') }}" alt="Logo Perusahaan" class="right-logo" style="width: 130px; height: 90px; margin-top: -90px;">
        <div class="company-info">
            <h3>PEMERINTAH KABUPATEN AGAM</h3>
            <h2>PERUSAHAAN DAERAH AIR MINUM TIRTA ANTOKAN</h2>
            <p>JL. Dr. Mohammad Hatta, No. 531, Lubuk Basung <br><span>0812-6660-2112 - 26415</span></p>
            <p style="font-size: smaller;">Website: www.pdam.kabupatenagam.go.id Email: agampdam@yahoo.co.id</p>
            <hr class="long-hr">
            <h2>Surat Perintah Kerja Opname <br><span style="font-size: smaller;">(SPKO)</span></h2>
            <p>Nomor {{ $pengaduan->id_pengaduan }} / SPKO/PDAM-AG/LBS/{{ date('m-Y') }}</p>
        </div>
    </div>
    <div class="content">
        <p >Diperintahkan kepada Bagian Perencanaan/Pengawasan Teknik, agar segera diadakan opname ke lokasi dibawah ini:</p>
        <table>
            <tr>
                <th style="font-size: smaller;">Judul Laporan</th>
                <th style="font-size: smaller;">Nama</th>
                <th style="font-size: smaller;">No Hp</th>
                <th style="font-size: smaller;">No Sambungan</th>
                <th style="font-size: smaller;">Wilayah</th>
                <th style="font-size: smaller;">Alamat</th>
                <th style="font-size: smaller;">Tanggal Kejadian</th>
                <th style="font-size: smaller;">Tanggal Pengaduan</th>
                <th style="font-size: smaller;">Uraian Pengaduan</th>
            </tr>
            <tr>
                <td style="font-size: smaller;">{{ $pengaduan->judul_laporan }}</td>
                <td style="font-size: smaller;">{{ $pengaduan->nama }}</td>
                <td style="font-size: smaller;">{{ $pengaduan->no_hp }}</td>
                <td style="font-size: smaller;">{{ $pengaduan->no_index }}</td>
                <td style="font-size: smaller;">{{ $pengaduan->wilayah_kejadian }}</td>
                <td style="font-size: smaller;">{{ $pengaduan->lokasi_kejadian }}</td>
                <td style="font-size: smaller;">{{ \Carbon\Carbon::parse($pengaduan->tgl_kejadian)->format('d-m-Y') }}</td>
                <td style="font-size: smaller;">{{ \Carbon\Carbon::parse($pengaduan->tgl_pengaduan)->format('d-m-Y') }}</td>
                <td style="font-size: smaller;">{{ $pengaduan->isi_laporan }}</td>
            </tr>
        </table>
    </div>
    <br>
    <div class="signature-container">
        <div class="signature">
            <p class="lubukbasung">Lubuk Basung, {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
            <p class="perusahaan">Perusahaaan Daerah Air Minum <br><span class="agam">Kab AGAM</span></p>
            <br><br><br><br>
            <hr class="short-hr"> <!-- Garis lebih pendek dan ke kiri -->
            <p class="bapak">(ZALDI, A.Md)</p>
        </div>
    </div>
</body>
</html>
<link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- Adjust the path accordingly -->