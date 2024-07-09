<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Laporan Pengaduan</title>
    <style>
         @page {
         size: A4; /* Mengatur ukuran kertas ke A4 */
         margin: 10mm; /* Mengatur margin halaman */
        }

        .content table { width: 100%; border-collapse: collapse; }
        .content th, .content td { border: 1px solid #000; padding: 8px; text-align: left; }
        .header-text {
            text-align: center;
        }
        
    </style>
</head>
<body>
    <div class="header-text">
        <h1>Laporan Pengaduan Masyarakat</h1>
        <h2>TIRTA ANTOKAN</h2>
        @if($from && $to)
            <h4>Periode: {{ \Carbon\Carbon::parse($from)->format('d-M-Y') }} - {{ \Carbon\Carbon::parse($to)->format('d-M-Y') }}</h4>
        @endif
        <hr>
        <br><br>
    </div>
    <div class="content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="font-size: smaller;">No</th>
                    <th style="font-size: smaller;">Tanggal</th>
                    <th style="font-size: smaller;">Nama Pelapor</th>
                    <th style="font-size: smaller;">No Telepon</th>
                    <th style="font-size: smaller;">No Sambungan</th>
                    <th style="font-size: smaller;">Judul Laporan</th>
                    <th style="font-size: smaller;">Isi Laporan</th>
                    <th style="font-size: smaller;">Tanggal Kejadian</th>
                    <th style="font-size: smaller;">Wilayah Kejadian</th>
                    <th style="font-size: smaller;">Lokasi Kejadian</th>
                    <th style="font-size: smaller;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengaduan as $k => $v)
                    <tr>
                        <td style="font-size: smaller;">{{ $k += 1 }}</td>
                        <td style="font-size: smaller;">{{ $v->tgl_pengaduan->format('d-M-Y') }}</td>
                        <td style="font-size: smaller;">{{ $v->nama }}</td>
                        <td style="font-size: smaller;">{{ $v->no_hp }}</td>
                        <td style="font-size: smaller;">{{ $v->no_index }}</td>
                        <td style="font-size: smaller;">{{ $v->judul_laporan }}</td>
                        <td style="font-size: smaller;">{{ $v->isi_laporan }}</td>
                        <td style="font-size: smaller;">{{ $v->tgl_kejadian->format('d-M-Y') }}</td>
                        <td style="font-size: smaller;">{{ $v->wilayah_kejadian }}</td>
                        <td style="font-size: smaller;">{{ $v->lokasi_kejadian }}</td>
                        <td style="font-size: smaller;">{{ $v->status == '0' ? 'Pending' : ucwords($v->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
