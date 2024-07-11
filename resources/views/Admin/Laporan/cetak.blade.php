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
            size: F4; /* Mengatur ukuran kertas ke A4 */
            margin: 10mm; /* Mengatur margin halaman */
        }

        .content table { width: 100%; border-collapse: collapse; }
        .content th, .content td { border: 1px solid #000; padding: 8px; text-align: left; }
        .header-text {
            text-align: center;
        }
        
        .page-number:before {
            content: "Halaman " counter(page);
        }
    </style>
</head>
<body>
    <div class="header-text">
        <h2>Laporan Pengaduan Masyarakat</h2>
        <h3>TIRTA ANTOKAN</h3>
        @if($from && $to)
            <small style="float: left; margin-left: 10px;">Periode: {{ \Carbon\Carbon::parse($from)->format('d-M-Y') }} - {{ \Carbon\Carbon::parse($to)->format('d-M-Y') }}</small>
        @endif
        @if($wilayah_kejadian)
            <small style="float: right; margin-right: 10px;">Wilayah Kejadian: {{ $wilayah_kejadian }}</small>
        @endif
        <br><br>
    </div>
    @if($pengaduan->isEmpty())
        <div class="alert alert-info">
            Tidak ada data pengaduan yang ditemukan untuk kriteria yang dipilih.
        </div>
    @else
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
                            <td style="font-size: smaller;">{{ $k + 1 }}</td>
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
    @endif
    <small>Total Data: {{ $pengaduan->count() }}</small>
    <small style="float: right; margin-right: 10px;">Dicetak pada: {{ now()->format('d-M-Y H:i:s') }}</small>
    <div class="page-number"></div>
</body>
</html>
