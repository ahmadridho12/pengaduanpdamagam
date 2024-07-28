@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
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
@endsection

@section('header', 'Data Pengaduan')

@section('content')
<a href="{{ route('pengaduan.create') }}" class="btn btn-purple mb-2">
    <i class="fas fa-plus"></i><span style="margin-left: 5px;"> Tambah Pengaduan </span>
</a>

<!-- Filter Form -->
<form method="GET" action="{{ route('pengaduan.index') }}">
    <div class="mb-3">
        <select id="filterJudul" class="form-control" style="width: 200px; display: inline-block; margin-right: 10px;" name="judul_laporan">
            <option value="">Pilih Judul Laporan</option>
            @foreach ($judulList as $judul)
                <option value="{{ $judul->judul_laporan }}" {{ request('judul_laporan') == $judul->judul_laporan ? 'selected' : '' }}>{{ $judul->judul_laporan }}</option>
            @endforeach
        </select>

        <select id="filterWilayah" class="form-control" style="width: 200px; display: inline-block; margin-right: 10px;" name="wilayah_kejadian">
            <option value="">Pilih Wilayah</option>
            @foreach ($wilayahList as $wilayah)
                <option value="{{ $wilayah->wilayah_kejadian }}" {{ request('wilayah_kejadian') == $wilayah->wilayah_kejadian ? 'selected' : '' }}>{{ $wilayah->wilayah_kejadian }}</option>
            @endforeach
        </select>

        <input type="date" id="filterTanggalAwal" class="form-control" style="width: 200px; display: inline-block; margin-right: 10px;" name="tgl_pengaduan_awal" value="{{ request('tgl_pengaduan_awal') }}">
        <input type="date" id="filterTanggalAkhir" class="form-control" style="width: 200px; display: inline-block;" name="tgl_pengaduan_akhir" value="{{ request('tgl_pengaduan_akhir') }}">
        
        <button type="submit" class="btn btn-primary" style="margin-left: 10px;">Filter</button>
    </div>
</form>

<!-- Data Table -->
<div class="scrollable-table">
    <table id="pengaduanTable" class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Laporan</th>
                <th>Tanggal</th>
                <th>Judul Laporan</th>
                <th>Nama</th>
                <th>Wilayah</th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduan as $k => $v)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $v->kode_laporan }}</td>
                <td>{{ $v->tgl_pengaduan->format('d-M-Y') }}</td>
                <td>{{ $v->judul_laporan }}</td>
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
                <td>
                    <a href="{{ route('pengaduan.show', $v->id_pengaduan) }}" style="text-decoration: underline">
                        <i class="fas fa-info-circle"></i> Detail
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js"></script>
<script>
    $(document).ready(function() {
        // Tambahkan ini untuk mengurai format tanggal (dd-MMM-yyyy)
        $.fn.dataTable.moment('D-MMM-YYYY');

        // Inisialisasi DataTable
        var table = $('#pengaduanTable').DataTable({
            "order": [[2, "desc"]], // Mengurutkan berdasarkan kolom tanggal (index 2) secara menurun
            "paging": true,
            "searching": true,
            "info": true,
            
            "drawCallback": function(settings) {
                var api = this.api();
                var start = api.page.info().start;
                api.column(0, {page: 'current'}).nodes().each(function(cell, i) {
                    cell.innerHTML = start + i + 1;
                });
            }
        });
    });
</script>
@endsection
