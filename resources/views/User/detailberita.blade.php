<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @section('css')
    <link rel="icon" href="{{ asset('images/logoperumda.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @show
    @section('title', 'Detail Berita')
    <title>@yield('title')</title>
</head>
<body>
    @include('partials.navbar')

    <main>
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
                <div class="slide1">
                    <i class="fa fa-credit-card" aria-hidden="true"></i> DIINFORMASIKAN UNTUK MELAKUKAN PEMBAYARAN TAGIHAN AIR SEBELUM TANGGAL 20 SETIAP BULANNYA
                </div>
                <div class="slide1">
                    <i class="fa fa-info-circle " aria-hidden="true"></i> UNTUK INFORMASI TAGIHAN DAN PENGADUAN ADA DIMENU LAYANAN
                </div>
            </div>
        </div>

        
        
<p>Ini halaman detail berita</p>
@if($berita)
<div class="container mt-12">
    <div class="row">
        <div class="col-md-12">
            <div class="card2">
                <div class="card-body">
                    <!-- Gambar Berita -->
                    <!-- Judul Berita -->
                    @if(isset($berita->judul))
                        <h3 class="card-title" style="color: rgba(0, 0, 0, 0.792); font-size: 32px; font-weight: bold">
                            {{ $berita->judul }}
                        </h3>
                    @endif
                    @if(isset($berita->created_at))
                    <h6 style="font-size: 14px"> {{ $berita->created_at->format('d M Y H:i') }}</h6>

                    @endif
                    @if(isset($berita->foto))
                        <img src="{{ Storage::url($berita->foto) }}" class="img-fluid" alt="{{ $berita->judul }}" style="width: 100%; height: auto; ">
                    @endif
                    <br>
                    <br>
                    
                    <!-- Deskripsi Lengkap -->
                    @if(isset($berita->deskripsi))
                        <p class="card-text" style="color: grey; font-size: 14px">
                            {{ $berita->deskripsi }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif

        
    </main>

    @include('partials.footer')

    @section('js')
    <script>
        // Tambahkan event listener untuk scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Tambahkan event listener untuk toggle hamburger menu
        document.querySelector('.navbar-toggler').addEventListener('click', function() {
            const navbarCollapse = document.querySelector('.collapse');
            navbarCollapse.classList.toggle('show');
        });
    </script>
    @show
</body>
</html>
