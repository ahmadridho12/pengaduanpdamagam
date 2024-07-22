@extends('layouts.admin')

@section('title', 'Halaman Mou')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
            background-color: rgb(21, 211, 21);
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
            background-color: rgb(241, 9, 9);
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
        .judul {
            font-weight: bold;
            position: relative;
            cursor: pointer;
        }
        .popuptext {
            visibility: hidden;
            width: 100px;
            background-color: white;
            color: rgb(35, 32, 32);
            text-align: left;
            border-radius: 6px;
            padding: 8px 0;
            position: absolute;
            z-index: 1;
            top: 150%;
            left: 50%;
            margin-left: -50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: visibility 0s, opacity 0.1s;
            font-weight: normal;
        }
        .popuptext a {
            display: block;
            padding: 5px 10px;
            text-decoration: none;
            color: #333;
        }
        .popuptext a:hover {
            background-color: #f2f2f2;
        }
        .judul:hover .popuptext {
            visibility: visible;
        }
    </style>
@endsection

@section('header', 'Mou')

@section('content')
<a href="{{ route('mou.create') }}" class="btn btn-purple mb-2">
    <i class="fas fa-plus"></i><span style="margin-left: 5px;"> Add New </span>
</a>
<div class="scrollable-table">
    <table id="mouTable" class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Status</th>
                <th>Nomor</th>
                <th>Institusi</th>
                <th>Tanggal Ditetapkan</th>
                <th>Judul</th>
                <th>File</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mou as $k => $v)
            <tr>
                <td>{{ $k + 1 }}</td>
                <td>
                    @if ($v->status == 'Berlaku')
                        <span class="badge badge-danger">Berlaku</span>
                    @elseif($v->status == 'Perpanjangan')
                        <span class="badge badge-warning text-white">Extend</span>
                    @else
                        <span class="badge badge-success">Expired</span>
                    @endif
                </td>
                <td>{{ $v->nomor }}</td>
                <td>{{ $v->instusi }}</td>
                <td>{{ $v->tgl_ditetapkan }}</td>
                <td>{{ $v->judul }}</td>
                <td><a href="{{ route('download.file', $v->file) }}" download><i class="fas fa-download" style="color: green;"></i></a></td>
                <td><a href="{{ route('Arsip.editmou', $v->id_mou) }}" style="text-decoration: underline">Lihat</a></td>
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
            $('#mouTable').DataTable();
        });
    </script>
@endsection
