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
    @section('title', 'Alamat  Kantor')
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
            
            <div class="row" style="padding: 16px;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            width: 100% ">
                <div class="col-md-4">
                    <div class="card" style="border:none">
                        <div class="card-body">
                            <h5>Perumda Air Minum Tirta Antokan</h5>
                            <h6 class="card-text" style="color: grey; font-size: 14px">
                                Alamat Kantor Perumda Air Minum Tirta Antokan
                                <br>
                                <ul>
                                    <li>Jl. DR. Mohd Hatta No. 531
                                        Lubuk Basung
                                        Kab Agam, Sumatera Barat</li>
                                    <li>Kode Pos : 26542</li>
                                    <li>Whatsapp : 0812-6660-2112</li>
                                    <li>Email: agampdam@yahoo.co.id</li>
                                    
                                </ul>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card" style="border:none">
                        <div class="card-body">
                            
                            <div id="map-container" style="position: relative; overflow: hidden; padding-bottom: 56.25%; height: 0;">
                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20553.376253170023!2d100.01155921124989!3d-0.31884268358223566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd5400e3e458fa7%3A0xe81176ad59eed7d0!2sPDAM%20Agam!5e0!3m2!1sid!2sid!4v1722172591658!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                                    width="100%" 
                                    height="100%" 
                                    frameborder="0" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    aria-hidden="false" 
                                    tabindex="0">
                                </iframe>
                            </div>
                        </div>
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
