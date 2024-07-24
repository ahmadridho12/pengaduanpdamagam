@extends('layouts.user')

@section('css')
<link rel="stylesheet" href="{{ asset('css/new.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
   

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
    input::placeholder {
            font-size: small; /* Atur ukuran font untuk placeholder */
    }
    select, option {
            font-size: small; /* Atur ukuran font untuk select dan option */
    }
    textarea::placeholder {
            font-size: small; /* Atur ukuran font untuk placeholder */
    }
    .red-asterisk {
            color: red; /* Atur warna teks menjadi merah */
    }
    
    .footer {
            background-color: #233e99;;
            color: #ffffff;;
            margin-top: 40px;
            padding: 20px;
        }
        .footer .container {
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .footer .column {
            flex: 1;
            margin: 0 10px;
        }
        .footer .column h3 {
            margin-bottom: 10px;
            font-size: 16px;
            text-transform: uppercase;
        }
        .footer .column a {
            color: white;
            text-decoration: none;
            display: block;
            margin-bottom: 5px;
        }
        .footer .column a:hover {
            text-decoration: underline;
        }
        .footer .contact-info {
            font-size: 14px;
        }
        .footer .social-icons {
            margin-top: 10px;
        }
        .footer .social-icons a {
            margin-right: 10px;
            color: white;
            font-size: 20px;
            text-decoration: none;
        }
        .footer .bottom {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
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
        /*icon border */
        .icon-border {
        display: inline-block;
        padding: 5px; /* Atur padding sesuai kebutuhan Anda */
        border: 2px solid #0056b3; /* Warna dan ketebalan border */
        background-color:#0056b3;
        color: white;
        border-radius: 5px; /* Atur radius sesuai kebutuhan Anda */
    }
    .slider {
            display: flex;
            overflow: hidden;
            width: 100%;
            height: 100px; /* Sesuaikan dengan tinggi kontainer slider */
            align-items: center;
        }
        .slider .slide-track {
            display: flex;
            animation: scroll 20s linear infinite;
        }
        .slider .slide {
            width: 260px; /* Lebar kontainer setiap slide */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 20px;
        }
        .slider img {
            width: 200px; /* Ubah ukuran gambar menjadi 60px */
            height: auto; /* Menjaga rasio aspek gambar */
        }
        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-100%);
            }

        }
        .container2 {
            width: 100%;
            overflow: hidden;
            background-color: #f1f1f1;
        }
        .slider1 {
            display: flex;
            white-space: nowrap;
            overflow: hidden;
            width: 100%;
        }

        .slide-track1 {
            display: flex;
            animation: scroll 20s linear infinite;
        }

        .slide1 {
            display: inline-block;
            padding: 10px 30px;
            font-size: 14px;
            background: none;
            color: rgb(8, 3, 91);
            margin: 0 10px;
            border-radius: 10px;
            display: flex;
            align-items: center;
        }
        .slide1 i {
            margin-right: 10px; /* Adjust this value for more or less spacing */
        }

        @keyframes scroll {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }
        
</style>
@endsection

@section('title', 'TIRTA ANTOKAN - ')

@section('content')
{{-- Section Header --}}
<section class="header">
    
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: transparent;"> <!-- Ubah ini -->
        <a class="navbar-brand" href="#" style="display: flex; align-items: center;">
            <img src="{{ asset('images/logoperumda.png') }}" alt="TIRTA ANTOKAN Logo" class="logo-img" style="width: 60px; margin-right: 10px;">
            <div class="d-flex flex-column" style="margin-top: 20px;">
                <h4 class="semi-bold mb-0 text-white">PERUMDAM</h4>
                <p class="italic mt-0 text-white">TIRTA ANTOKAN</p>
            </div>
        </a>
        
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: white;">
                        Beranda
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                        Profil
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#" style="color: grey;"> Sejarah</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Visi&Misi</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Direksi</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Struktur Organisasi</a>
                        
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                        Layanan
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#" style="color: grey;">Simulasi</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Pengaduan</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Monitoring Pengaduan</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Loket Pembayaran</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                        Publikasi
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#" style="color: grey;">Berita</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Informasi gangguan</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Informasi gangguan</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Tarif Air Minum</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Tahukah Anda</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: white;">
                        Contact
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container1">
        <h1>Perusahaan Umum Daerah</h1>
        <h2>Tirta Antokan</h2>
        <p>Handal & Prima</p>
        <p>Handal dalam pekerjaan, prima dalam pelayanan</p>
        <div class="buttons">
            <button>Profil Perusahaan</button>
            
        </div>
    </div>
    <div style="position: relative;">
        <div style="float: right; z-index: 999;">
            <!-- Konten lain di sini -->
        </div>
        
        {{-- {{ <div style="display: flex; justify-content: flex-end;">
            <img src="{{ asset('images/headerrr.png') }}" alt="TIRTA ANTOKAN Logo" class="penjelasan" style="width: 300px; margin-top: -130px; transform: translateX(-100px);">
        </div> }} --}}
            </div>

    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div>
</section>
<div class="container mt-2">
    <div class="slider1">
        <div class="slide-track1">
            <div class="slide1">
                <i class="fa fa-credit-card" aria-hidden="true"></i> DIINFORMASIKAN UNTUK MELAKUKAN PEMBAYARAN TAGIHAN AIR SEBELUM TANGGAL 20 SETIAP BULANNYA
            </div>
            <div class="slide1">
                <i class="fa fa-info-circle " aria-hidden="true"></i> UNTUK INFORMASI TAGIHAN DAN PENGADUAN ADA DIMENU LAYANAN
            </div>
            </div>
            <!-- Ulangi elemen slide untuk membuat loop -->
            <div class="slide1">
                <i class="fa fa-credit-card" aria-hidden="true"></i> DIINFORMASIKAN UNTUK MELAKUKAN PEMBAYARAN TAGIHAN AIR SEBELUM TANGGAL 20 SETIAP BULANNYA
            </div>
            <div class="slide1">
                <i class="fa fa-info-circle " aria-hidden="true"></i> UNTUK INFORMASI TAGIHAN DAN PENGADUAN ADA DIMENU LAYANAN
            </div>
           
        </div>
    </div>
</div>
<br><br><br>
<div class="container mt-4">
    <div class="text-center mb-4">
        <h3>Pengumuman Tirta Antokan</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card1">
                <h5>
                    <span class="icon-border">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                    </span>
                    Info Gangguan
                </h5><br>
                <h7>24/07 <span> perbaikan pompa tiku</span></h7>
            </div>
        </div>
        
        
    </div>
</div>
<br>
<br>

<div class="container mt-4">
    <div class="text-center mb-4">
        <h3>Berita Tirta Antokan</h3>
        <h7>Berita dan informasi seputar Perusahaan Umum Daerah Tirta Antokan</h7>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card2">
                <img src="{{ asset('images/avatar-3.jpg') }}" class="card-img-top" alt="Berita 1"> <!-- Tambahkan gambar -->
                <div class="card-body">
                    <h5 class="card-title">Berita 1</h5>
                    <h6 class="card-text" style="color: #000">Deskripsi singkat berita 1.</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card2">
                <img src="{{ asset('images/avatar-2.jpg') }}" class="card-img-top" alt="Berita 2"> <!-- Tambahkan gambar -->
                <div class="card-body">
                    <h5 class="card-title">Berita 2</h5>
                    <h6 class="card-text">Deskripsi singkat berita 2.</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card2">
                <img src="{{ asset('images/avatar-1.jpg') }}" class="card-img-top" alt="Berita 3"> <!-- Tambahkan gambar -->
                <div class="card-body">
                    <h5 class="card-title">Berita 3</h5>
                    <h6 class="card-text">Deskripsi singkat berita 3.</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br><br>
<div class="container mt-4">
    <div class="text-center mb-4">
        <h3>Mitra Kami</h3>
        <h7>Tempat Pembayaran Dapat dilakukan dimitra kami</h7>
    </div>
    <div class="slider">
        <div class="slide-track">
            <div class="slide"><img src="{{ asset('images/bni.png') }}" alt="Logo 1"></div>
            <div class="slide"><img src="{{ asset('images/nagari.png') }}" alt="Logo 2"></div>
            <div class="slide"><img src="{{ asset('images/mandiri.png') }}" alt="Logo 3"></div>
            <div class="slide"><img src="{{ asset('images/bsi.png') }}" alt="Logo 4"></div>
            <div class="slide"><img src="{{ asset('images/pos.png') }}" alt="Logo 5"></div>
            <!-- Ulangi elemen slide untuk membuat loop -->
            <div class="slide"><img src="{{ asset('images/bni.png') }}" alt="Logo 1"></div>
            <div class="slide"><img src="{{ asset('images/nagari.png') }}" alt="Logo 2"></div>
            <div class="slide"><img src="{{ asset('images/mandiri.png') }}" alt="Logo 3"></div>
            <div class="slide"><img src="{{ asset('images/bsi.png') }}" alt="Logo 4"></div>
            <div class="slide"><img src="{{ asset('images/pos.png') }}" alt="Logo 4"></div>
            
        </div>
    </div>
</div>

{{-- Footer --}}

    <footer class="footer">
        <div class="container">
            <div class="column">
                <h3 class="bold-text">Unit</h3>
                <a class="contact-info"> <span>Unit Baso</span> <br>Jl. Sungai Janiah</a>
                <a class="contact-info"> <span ">Unit IV Angkek </span> <br>Jln. Ampang Gadang</a>
                <a class="contact-info"> <span >Unit Matur</span> <br>Jl. Tanjung Lurah</a>
                <a class="contact-info"> <span>Unit Sei.Puar</span> <br>Jl. Raya Limo Suku</a>
            </div>
            <div class="column">
                <h3></h3>
                <a class="contact-info"> <span>Unit Maninjau</span> <br>Jln. Pasar Ahad</a>
                <a class="contact-info"> <span>Unit Batu Kambing</span> <br>Jl. Kampung Pinang, Kec. IV Nagari</a>
                <a class="contact-info"> <span>Unit Tiku</span> <br>Jl. Sungai Libuang</a>
                <a class="contact-info"> <span>Unit IV Koto</span> <br></a>
            </div>
            <div class="column">
                <h3 class="bold-text">Kontak</h3>
                <div class="contact-info">
                    Jl. DR. Mohd Hatta No. 531<br>
                    Lubuk Basung<br>
                    Kab Agam, Sumatera Barat 26542<br>
                    Office: 0752 - 8701910<br>
                    Whatsapp Enterprise: +62812-6660-2112<br>
                    Email: agampdam@yahoo.co.id
                </div>
                <div class="social-icons">
                    <a href="https://www.facebook.com/share/kmUz6tne711zmKZo/?mibextid=qi2Omg"><i class="fa fa-facebook"></i></a>
                    <a href="https://www.instagram.com/perumdam_tirta_antokan?igsh=OG4zZHRueDhsenJl"><i class="fa fa-instagram"></i></a>
                    <a href="https://wa.me/+6281266602112"><i class="fa fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
        <div class="bottom">
            © 2024. Perumdam Antokan<br>
        </div>
    </footer>
@endsection

@section('js')
<script>
    // Tambahkan event listener untuk scroll
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) { // Ganti 50 dengan nilai sesuai kebutuhan
            navbar.classList.add('scrolled'); // Menambahkan kelas saat di-scroll
        } else {
            navbar.classList.remove('scrolled'); // Menghapus kelas saat kembali ke atas
        }
    });
</script>
@endsection