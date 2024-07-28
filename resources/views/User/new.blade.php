@extends('layouts.user')

@section('title', 'Landing Page')
@section('header', 'PERUMDAM TIRTA ANTOKAN ')

@section('css')
<link rel="icon" href="{{ asset('images/logoperumda.png') }}" type="image/x-icon">
<link rel="stylesheet" href="{{ asset('css/new.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
   

    
</style>
@endsection

@section('title', 'TIRTA ANTOKAN - ')

@section('content')
{{-- Section Header --}}
<section class="header">
    
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: transparent;"> <!-- Ubah ini -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
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
                        <a class="dropdown-item" href="{{ route('user.visimisi') }}"" style="color: grey;">Visi&Misi</a>
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
                        <a class="dropdown-item" href="#" style="color: grey;">Simulasi</a>
                        <a class="dropdown-item" href="{{ route('pekat.index') }}" style="color: grey;">Pengaduan</a>
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
                        <a class="dropdown-item" href="#" style="color: grey;">Informasi gangguan</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Informasi gangguan</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Tarif Air Minum</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Tahukah Anda</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                        Hubung Kami
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.berita') }}" style="color: grey;">Alamat Kantor</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Media Sosial</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Whatsapp</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Tarif Air Minum</a>
                        <a class="dropdown-item" href="#" style="color: grey;">Tahukah Anda</a>
                    </div>
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
        
        <div class="col-md-6">
            <div class="card1">
                <h5>
                    <span class="icon-border">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                    </span>
                    Info Gangguan Dalam Proses
                </h5><br>

                @foreach ($gangguanProses as $gangguan)
                    <div>
                        <span class="status-icon status-proses"></span>
                        <h7>{{ \Carbon\Carbon::parse($gangguan->tanggal)->format('d/m') }} 
                        <span>{{ $gangguan->judul }}</span></h7><br>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="col-md-6">
            <div class="card1">
                <h5>
                    <span class="icon-border">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                    </span>
                    Info Gangguan Yang Telah Selesai
                </h5><br>

                @foreach ($gangguanSelesai as $gangguan)
                    <div>
                        <span class="status-icon status-selesai"></span>
                        <h7>{{ \Carbon\Carbon::parse($gangguan->tanggal)->format('d/m') }} 
                        <span>{{ $gangguan->judul }}</span></h7><br>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
<br><br>
<div class="container mt-4">
    <div class="text-center mb-4">
        <h3>Berita Tirta Antokan</h3>
        <h7>Berita dan informasi seputar Perusahaan Umum Daerah Tirta Antokan</h7>
    </div>
    <div class="row">
    @foreach($berita as $v)
    <div class="col-md-4">
        <div class="card2">
            <a href="{{ route('user.show2', $v->id_berita) }}" style="text-decoration: none; color: inherit;">
            <img src="{{ Storage::url($v->foto) }}" class="card-img-top custom-img" alt="{{ $v->judul }}">
            <div class="card-body">
                <h6 class="card-title" style="font-size: 14px">{{ $v->created_at }}</h6>
                <h5 class="card-title">{{ $v->judul }}</h5>
                <h6 class="card-text" style="color: #000">
                    {{ implode(' ', array_slice(explode(' ', $v->deskripsi), 0, 20)) }}...
                </h6>
               

            </div>
        </div>
    </div>
    @endforeach
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
    // Tambahkan event listener untuk toggle hamburger menu
    document.querySelector('.navbar-toggler').addEventListener('click', function() {
        const navbarCollapse = document.querySelector('.collapse');
        navbarCollapse.classList.toggle('show'); // Menampilkan atau menyembunyikan menu
    });
</script>
@endsection