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
                            <h3 class="card-title" style="color: black">Visi & Misi </h3><br><br>
                            <h6 class="card-text" style="color:rgba(0, 0, 0, 0.792); font-size: 14px; ">
                                Visi
                                <br>
                                <ul>
                                    <li>PDAM PROFESIONAL DENGAN MENGOPTIMALKAN PELAYANAN BERBASIS IT</li>
                                  
                                </ul>
                            </h6>
                            <h6 class="card-text" style="color: rgba(0, 0, 0, 0.792); font-size: 14px;">Misi :
                                <br>
                                <ul>
                                    <li>Memenuhi cakupan layanan air minum dengan memenuhi azas kualitas, kuantitas, dan kontinuitas</li>
                                    <li>Menjadikan perusahaan yang profesional dengan pelayanan berbasis IT </li>
                                    <li>Peningkatan pelayanan kepada masyarakat dan pengembangan usaha yang dikelola secara professional. </li>
                                </ul>
                            </h6>
                            <h6 class="card-text" style="color: rgba(0, 0, 0, 0.792); font-size: 14px;"   > Sasaran :
                                <br>
                                <ul>
                                    <li>Pengembangan sumber daya manusia</li>
                                    <li>Peningkatan kualitas pelayanan</li>
                                    <li>Menambah kemampuan kapasitas produksi dan sumber air baku</li>
                                    <li>Perbaikan dan Pengembangan jaringan distribusi.</li>
                                    <li>Penggunaan teknologi informasi.</li>
                                    <li>Peningkatan cakupan pelayanan dan jumlah pelanggan</li>
                                    <li>Efisiensi dan efektivitas kinerja perusahaan.</li>
                                </ul>
                            </h6>
                            <h6 class="card-text" style="color: rgba(0, 0, 0, 0.792); font-size: 14px;"> Tujuan :
                                <br>
                                <ul>
                                    <li>Turut serta melaksanakan pembangunan daerah khususnya penyelenggaraan pelayanan air minum yang berkualitas dengan kuantitas yang memadai serta berkesinambungan bagi masyarakat.</li>
                                   
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
