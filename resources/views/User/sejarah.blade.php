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
    @section('title', 'Sejarah')
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
                            <h3 class="card-title" style="color: rgba(0, 0, 0, 0.792); font-size: 24px; font-weight: semi-bold">Dari Masa Ke Masa Perusahaan Umum Daerah Tirta Antokan </h3><br><br>
                            <h7 class="card-text" style="color: grey">
                                PERUMDAM Tirta Antokan Kabupaten Agam (berawal dr BPAM) didirikan pada tanggal 26 Desember 1989 dengan ditetapkannya Peraturan Daerah Tingkat II Kabupaten Agam Nomor 3 Tahun 1989 tentang Perusahaan Air Minum Kabupaten Daerah Tingkat II Agam. Beralih status menjadi PDAM pada tanggal 23 September 1991. Beralihnya nama PDAM menjadi PERUMDAM dengan ditetapkan PERATURAN DAERAH KABUPATEN AGAM NOMOR 3 TAHUN 2024 
                                . Data umum perusahaan adalah sebagai berikut :
                                <br>
                                <ul>
                                    <li>Nama Perusahaan   : PERUMDAM Tirta Antokan Kabupaten Agam</li>
                                    <li>Alamat Perusahaan  : Jalan Dr. Muhamad Hatta No. 531 Lubuk Basung</li>
                                    <li>No. Anggota Perpamsi  : 0333236</li>
                                    <li>Kegiatan Usaha  : Pelayanan Air Bersih</li>
                                    <li>Kedudukan Usaha  : Produsen</li>
                                    <li>Jumlah Karyawan  : 80 Orang</li>
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
