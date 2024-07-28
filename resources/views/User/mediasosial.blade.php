<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @section('css')
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="{{ asset('images/logoperumda.png') }}" type="image/x-icon">

    @show
    @section('title', 'Media Sosial')
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

        <div class="container mt-12">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card2">
                        <div class="card-body">
                            <h5 class="card-title" style="color: rgba(0, 0, 0, 0.792); font-size: 24px; font-weight: semi-bold">Media Sosial</h5><br><br>
                            <h6 class="card-text" style="color: grey; text-align: center">
                                Ikuti media sosial kami :
                                <br>
                                <br><br>
                                <ul style="list-style-type: none; padding: 0;">
                                    <li style="display: inline; margin-right: 16px;">
                                        <a href="https://www.instagram.com/perumdam_tirta_antokan?igsh=OG4zZHRueDhsenJl" target="_blank" style="color: grey; text-decoration: none;">
                                            <img src="{{ asset('images/logoig.png') }}" alt="Instagram" style="width: 80px; height: 80px;">
                                        </a>
                                    </li>
                                    <li style="display: inline; margin-right: 16px;">
                                        <a href="https://www.facebook.com/share/kmUz6tne711zmKZo/?mibextid=qi2Omg" target="_blank" style="color: grey; text-decoration: none;">
                                            <img src="{{ asset('images/Facebook.png') }}" alt="Facebook" style="width: 80px; height: 80px;">
                                        </a>
                                    </li>
                                    <li style="display: inline; margin-right: 16px;">
                                        <a href="https://www.twitter.com" target="_blank" style="color: grey; text-decoration: none;">
                                            <img src="{{ asset('images/x.png') }}" alt="Twitter" style="width: 80px; height: 80px;">
                                        </a>
                                    </li>
                                </ul>
                            </h6>
                        </div>
                        
                </div>
                
                
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
