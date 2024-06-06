@extends('layouts.user')

@section('css')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
<link rel="stylesheet" href="{{ asset('css/laporan.css') }}">

<style>
    
    .notification {
        padding: 14px;
        text-align: center;
        background: #f4b704;
        color: #fff;
        font-weight: 300;
    }
    .btn-white {
        background: #fff;
        color: #000;
        text-transform: uppercase;
        padding: 0px 25px 0px 25px;
        font-size: 14px;
    }
    .custom-img {
        max-width: 350px;
        height: 350px;
    }
    .navbar-custom {
        padding-top: 5px; /* Sesuaikan padding atas */
        padding-bottom: 5px; /* Sesuaikan padding bawah */
    }
    .navbar-brand h4, .navbar-brand p {
        margin: 0; /* Menghilangkan margin untuk mengurangi tinggi */
        line-height: 1.2; /* Sesuaikan line-height jika diperlukan */
    }
    .btn-custom {
        background-color: #233e99; /* Ganti dengan warna yang diinginkan */
        color: white;
    }
</style>
@endsection

@section('title', 'TIRTA ANTOKAN - Pengaduan Pelanggan')

@section('content')
{{-- Section Header --}}
<section class="header">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/logopdam.png') }}" alt="TIRTA ANTOKAN Logo" class="logo-img" style="width: 100px;">
                        <div class="d-flex flex-column ml-3" style="margin-top: 20px;">
                            <h4 class="semi-bold mb-0 text-white">TIRTA ANTOKAN</h4>
                            <p class="italic mt-0 text-white">Pengaduan Pelanggan</p>
                        </div>
                    </div>
                </a>
               
            </div>
        </div>
    </nav>

    <div class="text-center">
        <h2 class="medium text-white mt-3">Layanan Pengaduan Pelanggan</h2>
        
    </div>

    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div>
</section>

{{-- Form untuk memasukkan kode laporan --}}
<div class="container mt-4" style="margin-top: 16px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('pekat.trackLaporan') }}" method="GET">
                @csrf
                <div class="form-group">
                    <label for="kode_laporan">Masukkan Kode Laporan:</label>
                    <input type="text" class="form-control" id="kode_laporan" name="kode_laporan" required style="border-color: #233e99;">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-custom">Cari Laporan</button>
                </div>
            </form>
        </div>
    </div>
</div> 

{{-- Menampilkan data laporan --}}
@if(isset($laporan))
<div class="container mt-2">
    <table class="table table-bordered" style="border-color:#233e99;">
        <thead>
            <tr>
                <th scope="col">Detail</th>
                <th scope="col">Data</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Judul Laporan</td>
                <td>{{ $laporan->judul_laporan }}</td>
            </tr>
            <tr>
                <td>Kode Laporan</td>
                <td>{{ $laporan->kode_laporan }}</td>
            </tr>
            <tr>
                <td>Nama Pelapor</td>
                <td>{{ $laporan->nama }}</td>
            </tr>
            <tr>
                <td>No Telepon</td>
                <td>{{ $laporan->no_hp }}</td>
            </tr>
            <tr>
                <td>Nomor Sambungan</td>
                <td>{{ $laporan->no_index }}</td>
            </tr>
            <tr>
                <td>Isi Laporan</td>
                <td>{{ $laporan->isi_laporan }}</td>
            </tr>
            <tr>
                <td>Tanggal Pengaduan</td>
                <td>{{ $laporan->tgl_pengaduan->format('d M Y') }}</td>
            </tr>
            <tr>
                <td>Tanggal Kejadian</td>
                <td>{{ $laporan->tgl_kejadian->format('d M Y') }}</td>
            </tr>
            <tr>
                <td>Wilayah Kejadian</td>
                <td>{{ $laporan->wilayah_kejadian }}</td>
            </tr>
            <tr>
                <td>Lokasi Kejadian</td>
                <td>{{ $laporan->lokasi_kejadian }}</td>
            </tr>
            <tr>
                <th>Status</th>
                
               
                <td>
                    @if ($laporan->status == '0')
                        <span class="badge badge-danger">Pending</span>
                    @elseif($laporan->status == 'proses')
                        <span class="badge badge-warning text-white">Proses</span>
                    @else
                        <span class="badge badge-success">Selesai</span>
                    @endif
                </td>
            </tr>
            @if($laporan->foto)
    <tr>
        <td>Foto</td>
        <td>
            @php
                $fotoUrl = Storage::url($laporan->foto);
            @endphp
            <img src="{{ $fotoUrl }}" alt="Gambar Laporan" class="custom-img">
        </td>
    </tr>
@endif
<div class="mt-3">
    <hr>
</tbody>
</table>
</div>
<footer class="footer mt-4" style="background-color: #233e99; color: white; padding: 20px 0;">
    <div class="container text-center">
        <small>© 2024 TIRTA ANTOKAN. All rights reserved.</small>
    </div>
</footer>
@endif
@endsection
@if (Session::has('status'))
<div class="alert alert-success mt-2">
    {{ Session::get('status') }}
</div>
@endif
@section('js')
@if (Session::has('pesan'))
<script>
    $('#loginModal').modal('show');
</script>
@endif
@endsection
