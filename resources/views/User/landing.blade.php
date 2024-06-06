@extends('layouts.user')

@section('css')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    .btn-facebook {
        background: #233E99;
        width: 100%;
        color: #fff;
        font-weight: 600;
    }

    .btn-facebook:hover {
        background:#233E99;
        width: 100%;
        color: #fff;
        font-weight: 600;
    }

    .btn-google {
        background: #cf4332;
        width: 100%;
        color: #fff;
        font-weight: 600;
    }

    .btn-google:hover {
        background: #cf4332;
        width: 100%;
        color: #fff;
        font-weight: 600;
    }

    .btn-copy {
        background: none;
        border: none;
        cursor: pointer;
    }

    .btn-copy i {
        color: #007bff;
        font-size: 1.2em;
    }

    .btn-copy:hover i {
        color: #0056b3;
    }
    .btn-custom {
        background-color: #233e99; /* Ganti dengan warna yang diinginkan */
        color: white;
    }

    .card-custom {
        background-color: #f8f9fa; /* Warna latar belakang card */
        border-color: #233e99; /* Warna border card */
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
    <div style="position: relative;">
        <div style="float: right; z-index: 999;">
            <!-- Konten lain di sini -->
        </div>
        <div style="display: flex; justify-content: flex-end;">
            <img src="{{ asset('images/Group 55.png') }}" alt="TIRTA ANTOKAN Logo" class="penjelasan" style="width: 300px; margin-top: -130px; transform: translateX(-100px);">
        </div>
            </div>

    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div>
</section>
{{-- Section Card Pengaduan --}}
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card card-custom shadow p-4">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
                @endif

                @if (Session::has('pengaduan'))
                <div class="alert alert-{{ Session::get('type') }}">
                    {{ Session::get('pengaduan') }}
                    @if(Session::get('type') == 'success')
                    <div>
                        <span id="kodeLaporan">{{ Session::get('kode_laporan') }}</span>
                        <button onclick="copyToClipboard()" class="btn-copy">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                        </button>
                    </div>
                    @endif
                </div>
                @endif
                <div class="card mb-3 p-3" style="background-color: #233e99; color: white;">Tulis Laporan Disini!, Jika sebelumnya pernah mamasukan laporan masukan kode laporan anda </div>
                <form action="{{ route('pekat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" value="{{ old('nama') }}" name="nama"
                            placeholder="Masukkan Nama Anda" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ old('no_hp') }}" name="no_hp"
                            placeholder="Masukkan No HP" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="text" value="{{ old('no_index') }}" name="no_index"
                            placeholder="Masukkan Nomor Sambungan" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <select name="judul_laporan" class="custom-select" id="inputGroupSelect01" >
                                <option value="" selected>Pilih Judul Laporan</option>
                                <option value="air keruh">Air Keruh</option>
                                <option value="kebocoran">Kebocoran</option>
                                <option value="meteran">Meteran</option>
                                <option value="pemakaian">Pemakaian</option>
                                <option value="tidak dapat air">Tidak Dapat Air</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control"
                            rows="4">{{ old('isi_laporan') }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ old('tgl_kejadian') }}" name="tgl_kejadian"
                            placeholder="Pilih Tanggal Kejadian" class="form-control" onfocusin="(this.type='date')"
                            onfocusout="(this.type='text')">
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <select name="wilayah_kejadian" class="custom-select" id="inputGroupSelect01" >
                                <option value="" selected>Pilih Wilayah Kejadian</option>
                                <option value="lubuk basung">Lubuk Basung</option>
                                <option value="baso">Baso</option>
                                <option value="IV angkek">IV Angkek</option>
                                <option value="maninjau">Maninjau</option>
                                <option value="tiku">Tiku</option>
                                <option value="batu kambing">Batu Kambing</option>
                                <option value="matur">Matur</option>
                                <option value="sungai puar">Sungai Puar</option>
                                <option value="IV koto">IV Koto</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="lokasi_kejadian" id="latlang" rows="3" class="form-control mb-3" placeholder="Detail Lokasi">{{ old('lokasi_kejadian') }}</textarea>
                        
                    </div>

                    <script>
                        // Membuat fungsi untuk mengaktifkan lokasi pengguna
                        function getLocation() {
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(showPosition);
                            } else { 
                                alert("Geolocation is not supported by this browser.");
                            }
                        }
                    
                        // Menampilkan koordinat pengguna di dalam textarea
                        function showPosition(position) {
                            var lat = position.coords.latitude;
                            var long = position.coords.longitude;
                            document.getElementById("latlang").value = "Latitude: " + lat + ", Longitude: " + long;
                        }
                    </script>
                    <div class="form-group">
                        <input type="file" name="foto" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-custom mt-2">Kirim</button>
                </form>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="card shadow p-4" style="background-color: #f8f9fa; border-color: #233e99;">
                <div class="card-body"></div>
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
    </div>
</div>
{{-- Footer --}}
<footer class="footer mt-4" style="background-color: #233e99; color: white; padding: 20px 0;">
    <div class="container text-center">
        <small>© 2024 TIRTA ANTOKAN. All rights reserved.</small>
    </div>
</footer>
@endsection

@section('js')
@if (Session::has('pesan'))
<script>
    $('#loginModal').modal('show');
</script>
@endif

@if (Session::has('kode_laporan'))
<script>
    function copyToClipboard() {
        var copyText = document.getElementById("kodeLaporan").innerText;
        var tempInput = document.createElement("input");
        tempInput.value = copyText;
        document.body.appendChild(tempInput);
        tempInput.select();
        tempInput.setSelectionRange(0, 99999); // Untuk perangkat mobile
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        alert("Kode Laporan disalin: " + copyText);
    }
</script>
@endif
@endsection
