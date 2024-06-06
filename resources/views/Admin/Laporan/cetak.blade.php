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
        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6 !important;
        }
    </style>
</head>
<body>
    <div class="text-center">
        <h5>Laporan Pengaduan Masyarakat</h5>
        <h6>TIRTA ANTOKAN</h6>
    </div>
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Pelapor</th>
                    <th>No Telepon</th>
                    <th>NO Sambungan</th>
                    <th>Judul Laporan</th>
                    <th>Isi Laporan</th>
                    <th>Tanggal Kejadian</th>
                    <th>Wilayah Kejadian</th>
                    <th>Lokasi Kejadian</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengaduan as $k => $v)
                    <tr>
                        <td>{{ $k += 1 }}</td>
                        <td>{{ $v->tgl_pengaduan->format('d-M-Y') }}</td>
                        <td>{{ $v->nama }}</td>
                        <td>{{ $v->no_hp }}</td>
                        <td>{{ $v->no_index }}</td>
                        <td>{{ $v->judul_laporan }}</td>
                        <td>{{ $v->isi_laporan }}</td>
                        <td>{{ $v->tgl_kejadian->format('d-M-Y') }}</td>
                        <td>{{ $v->wilayah_kejadian }}</td>
                        <td>{{ $v->lokasi_kejadian }}</td>
                        <td>{{ $v->status == '0' ? 'Pending' : ucwords($v->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
