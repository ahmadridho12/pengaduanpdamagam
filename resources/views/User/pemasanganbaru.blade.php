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
                            <h3 class="card-title" style="color: rgba(0, 0, 0, 0.792); font-size: 24px; font-weight: semi-bold">Pemasangan Baru </h3><br><br>
                            <h7 class="card-text" style="color: grey">
                                Pendaftaran pemasangan baru dapat dilakukan pada jam kerja di Kantor Pusat maupun unit berikut :
                                <br>
                                <ul>
                                    <li>Kantor Pusat Perumda Tirta Antokan, Jl. DR. Mohd Hatta No. 531 Lubuk Basung</li>
                                    <li>Unit Baso, Jl. Sungai Janiah</li>
                                    <li>Unit Matur, Jl. Tanjung Lurah</li>
                                    <li>Unit Sei.Puar, Jl. Raya Limo Suku</li>
                                    <li>Unit Maninjau, Jln. Pasar Ahad</li>
                                    <li>Unit Batu Kambing, Jl. Kampung Pinang, Kec. IV Nagari</li>
                                    <li>Unit Tiku, Jl. Sungai Libuang</li>
                                    <li>Unit IV Koto</li>
                                   
                                </ul>
                            </h7>
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
