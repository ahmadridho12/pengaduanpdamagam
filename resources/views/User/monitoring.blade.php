<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @section('css')
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

        
       
        <div class="container mt-4">
            <div class="text-center mb-4">
                <h3>Tracking Laporan Pengaduan</h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card1">
                        <h5>
                            Masukan Kode Laporan
                        </h5><br>

                        <form action="{{ route('pekat.trackLaporan') }}" method="GET">
                            @csrf
                            <div class="form-group">
                                <label for="kode_laporan">Masukkan Kode Laporan:</label>
                                <input type="text" class="form-control" id="kode_laporan" name="kode_laporan" required style="border-color: #233e99;">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-custom">Cari Laporan</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </main>

    @include('partials.footer')

    @section('js')
    @if (Session::has('pesan'))
    <script>
        $('#loginModal').modal('show');
    </script>
    @endif
    
    @if (Session::has('kode_laporan'))
    <script>
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
    </script>
    @endif
    @endsection
    
</body>

</html>
