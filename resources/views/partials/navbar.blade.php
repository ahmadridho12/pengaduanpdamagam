@extends('layouts.user')

@section('css')
<link rel="stylesheet" href="{{ asset('css/layout.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    .card-custom {
        background-color: #f8f9fa; /* Warna latar belakang card */
        border-color: #233e99; /* Warna border card */
    }
    input::placeholder, textarea::placeholder {
        font-size: small; /* Ukuran font untuk placeholder */
    }
    select, option {
        font-size: small; /* Ukuran font untuk select dan option */
    }
    .bold-text {
        font-weight: bold;
    }
    .navbar.scrolled {
        background-color: white !important; /* Warna latar belakang saat di-scroll */
        transition: background-color 0.3s; /* Transisi halus */
    }
    .navbar.scrolled .nav-link {
        color: black !important; /* Warna font saat di-scroll */
    }
    .navbar .nav-link {
        color: white; /* Warna font default */
    }
    .navbar.scrolled .navbar-brand h4,
    .navbar.scrolled .navbar-brand p {
        color: black !important; /* Warna teks navbar-brand saat di-scroll */
    }
    .icon-border {
        display: inline-block;
        padding: 5px; /* Padding */
        border: 2px solid #0056b3; /* Warna dan ketebalan border */
        background-color: #0056b3;
        color: white;
        border-radius: 5px; /* Radius border */
    }
    .container2 {
        width: 100%;
        overflow: hidden;
        background-color: #f1f1f1;
    }
    .navbar-toggler {
        background-color: white; /* Warna tombol hamburger sebelum di-scroll */
    }
    .navbar.scrolled .navbar-toggler {
        background-color: none; /* Warna tombol hamburger setelah di-scroll */
    }
</style>
@endsection

@section('title', 'TIRTA ANTOKAN - ')

@section('content')
<section class="header">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: transparent;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#" style="display: flex; align-items: center;">
            <img src="{{ asset('images/logoperumda.png') }}" alt="Logo TIRTA ANTOKAN" class="logo-img" style="width: 60px; margin-right: 10px;">
            <div class="d-flex flex-column" style="margin-top: 20px;">
                <h4 class="semi-bold mb-0 text-white">PERUMDAM</h4>
                <p class="italic mt-0 text-white">TIRTA ANTOKAN</p>
            </div>
        </a>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.new') }}" style="color: white;">
                        Beranda
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                        Profil
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.sejarah') }}" style="color: grey;"> Sejarah</a>
                        <a class="dropdown-item" href="{{ route('user.visimisi') }}" style="color: grey;">Visi & Misi</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Direksi</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Struktur Organisasi</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                        Layanan
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.pemasanganbaru') }}" style="color: grey;">Pemasangan Baru</a>
                        <a class="dropdown-item" href="{{ route('pekat.index') }}" style="color: grey;">Pengaduan</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Simulasi</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Monitoring Pengaduan</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Loket Pembayaran</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                        Publikasi
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.berita') }}" style="color: grey;">Berita</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Informasi Gangguan</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Tarif Air Minum</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Tahukah Anda</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                        Hubung Kami
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.alamatkantor') }}" style="color: grey;">Alamat Kantor</a>
                        <a class="dropdown-item" href="{{ route('user.mediasosial')}}" style="color: grey;">Media Sosial</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Whatsapp</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Tarif Air Minum</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Tahukah Anda</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div style="position: relative;">
        <div style="float: right; z-index: 999;">
            <!-- Konten lain di sini -->
        </div>
    </div>

    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div>
</section>
@endsection

@section('js')
<script>
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    document.querySelector('.navbar-toggler').addEventListener('click', function() {
        const navbarCollapse = document.querySelector('#navbarNav');
        navbarCollapse.classList.toggle('show');
    
    });
    @if (Session::has('kode_laporan'))
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
            
            // Hubungkan fungsi copyToClipboard dengan tombol "Salin"
            document.querySelector('.btn-copy').addEventListener('click', copyToClipboard);
        @endif
</script>
@endsection
