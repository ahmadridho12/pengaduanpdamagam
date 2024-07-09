@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <style>
        .table {
            background-color: #e6f7ff; /* Light blue background color */
        }
        .table th {
            background-color: #b3e0ff; /* Slightly darker blue for header */
        }
        .table tr:nth-child(even) {
            background-color: #f2f9ff; /* Light blue for even rows */
        }
        .badge-danger {
            background-color: red;
            color: white;
            padding: 5px;
            text-decoration: none;
            border-radius: 4px;
        }
        .badge-warning {
            background-color: orange;
            color: white;
            padding: 5px;
            text-decoration: none;
            border-radius: 4px;
        }
        .badge-success {
            background-color: green;
            color: white;
            padding: 5px;
            text-decoration: none;
            border-radius: 4px;
        }
        .scrollable-table {
            display: block;
            width: 100%;
            overflow-x: auto;
        }
</style>
    </style>
@endsection

@section('header', 'Data Pengaduan')
@section('content')
<a href="{{ route('pengaduan.create') }}" class="btn btn-purple mb-2">
    <i class="fas fa-plus"></i><span style="margin-left: 5px;"> Tambah Pengaduan </span>
</a>
<div class="scrollable-table">
    <table id="pengaduanTable" class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Laporan</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Wilayah</th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduan as $k => $v)
            <tr>
                <td>{{ $k += 1 }}</td>
                <td>{{ $v->kode_laporan }}</td>
                <td>{{ $v->tgl_pengaduan->format('d-M-Y') }}</td>
                <td>{{ $v->nama }}</td>
                <td>{{ $v->wilayah_kejadian }}</td>
                <td>
                    @if ($v->status == '0')
                        <span class="badge badge-danger">Pending</span>
                    @elseif($v->status == 'proses')
                        <span class="badge badge-warning text-white">Proses</span>
                    @else
                        <span class="badge badge-success">Selesai</span>
                    @endif
                </td>
                <td><a href="{{ route('pengaduan.show', $v->id_pengaduan) }}" style="text-decoration: underline">Lihat</a></td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#pengaduanTable').DataTable();
        });
    </script>
     <script>
        // Fungsi untuk menampilkan indikator loading
        function showLoading() {
            document.getElementById('loading-indicator').style.display = 'block';
        }

        // Panggil fungsi untuk menampilkan indikator loading saat formulir dikirim
        document.getElementById('login-form').addEventListener('submit', function() {
            showLoading();
        });
    </script>
    
@endsection
