@extends('layouts.admin')

@section('title', 'Halaman Laporan')

@section('header', 'Laporan Pengaduan')
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

@section('content')
    <div class="row">
        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-header">
                    Cari Berdasarkan Tanggal
                </div>
                <div class="card-body">
                    <form action="{{ route('laporan.getLaporan') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="from" class="form-control" placeholder="Tanggal Awal" onfocusin="(this.type='date')" onfocusout="(this.type='text')" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="to" class="form-control" placeholder="Tanggal Akhir" onfocusin="(this.type='date')" onfocusout="(this.type='text')" required>
                        </div>
                        <div class="form-group">
                            <select name="wilayah_kejadian" class="form-control">
                                <option value="">Semua Wilayah</option>
                                @foreach($wilayah as $w)
                                <option value="{{ $w->wilayah_kejadian }}">{{ $w->wilayah_kejadian }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-purple" style="width: 100%"> <i class="fas fa-search"></i><span style="margin-left: 10px;">Cari Laporan</span></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-12">
            <div class="card">
                <div class="card-header">
                    Data Berdasarkan Tanggal
                    <div class="float-right">
                        @if (isset($pengaduan) && $pengaduan->isNotEmpty())
                            <a href="{{ route('laporan.cetakLaporan', ['from' => $from, 'to' => $to, 'wilayah_kejadian' => $wilayah_kejadian]) }}" class="btn btn-danger">EXPORT PDF</a>
                            <a href="{{ route('laporan.cetakLaporanExcel', ['from' => $from, 'to' => $to, 'wilayah_kejadian' => $wilayah_kejadian]) }}" class="btn btn-success">EXPORT EXCEL</a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if (isset($pengaduan) && $pengaduan->isNotEmpty())
                        <table class="table" id="pengaduanTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Wilayah</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengaduan as $k => $v)
                                    <tr>
                                        <td>{{ $k + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($v->tgl_pengaduan)->format('d-M-Y') }}</td>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center">
                            Tidak ada data
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if(session('excel_generated'))
        <div class="alert alert-success">
            File Excel berhasil dibuat. Silakan periksa file yang didownload.
        </div>
    @endif
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#pengaduanTable').DataTable();
        });
    </script>
@endsection
