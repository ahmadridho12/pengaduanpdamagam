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
    @section('title', 'Berita')
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
        <div class="container mt-4">
            <div class="text-center mb-4">
                <h3>Berita Tirta Antokan</h3>
                <h7>Berita dan informasi seputar Perusahaan Umum Daerah Tirta Antokan</h7>
            </div>
            <div class="row">
                
                @foreach($berita1 as $berita)
                <div class="col-md-4 mb-4">
                    <div class="card2">
                        <a href="{{ route('user.show2', $berita->id_berita) }}" style="text-decoration: none; color: inherit;">
                            @if(isset($berita->foto))
                            <img src="{{ Storage::url($berita->foto) }}" class="card-img-top" alt="{{ $berita->judul }}" style="width: 100%; height: 300px;">
                            @endif
                            <div class="card-body">
                                <h6 class="card-title" style="font-size: 14px">{{ $berita->created_at }}</h6>
                                <h5 class="card-title">{{ $berita->judul }}</h5>
                                <h6 class="card-text">{{ \Illuminate\Support\Str::limit($berita->deskripsi, 20) }}</h6>
                            </div>
                        </a>
                    </div>
                </div>
                
@endforeach

               
            </div>
        </div>

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
