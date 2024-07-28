@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
    </style>
@endsection

@section('header', 'Data Petugas')

@section('content')
    <a href="{{ route('infogangguan.create') }}" class="btn btn-purple mb-2">
        <i class="fas fa-plus"></i><span style="margin-left: 5px;">Tambah info gangguan </span></a>
    <table id="infogangguanTable" class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>status</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($infogangguan as $k => $v)
            <tr>
                <td>{{ $k += 1 }}</td>
                <td>{{ $v->judul }}</td>
                <td>{{ $v->tanggal }}</td>
                <td>
                    @if ($v->status == 'aktif')
                        <span class="badge badge-danger">aktif</span>
                    @elseif($v->status == 'proses')
                        <span class="badge badge-warning text-white">Proses</span>
                    @else
                        <span class="badge badge-success">Selesai</span>
                    @endif
                </td>
                <td><a href="{{ route('Cs.editinfogangguan', $v->id_gangguan) }}" style="text-decoration: underline">Lihat</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#infogangguanTable').DataTable();
        } );
    </script>
@endsection