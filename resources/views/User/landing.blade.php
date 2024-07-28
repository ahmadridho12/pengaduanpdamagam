<html>
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

       <br>
       <br>

        <!-- Formulir Pengaduan dan Pencarian Laporan -->
        <div class="container mt-12">
            <div class="card2">
                    <form action="{{ route('pekat.trackLaporan') }}" method="GET">
                        <div class="form-group">
                            <h6 style="margin-bottom: 4px;">Kode Laporan</h6>
                            <input type="text" name="kode_laporan" class="form-control" placeholder="Masukkan Kode Laporan">
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mt-3">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
            <br><br>
            
                <div class="container mt-12">
                    <div class="card2">
                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                        @endif

                        @if (Session::has('pengaduan'))
                        <div class="alert alert-{{ Session::get('type') }}">
                            {{ Session::get('pengaduan') }}
                            @if(Session::get('type') == 'success')
                            <div>
                                <span id="kodeLaporan">{{ Session::get('kode_laporan') }}</span>
                                <button onclick="copyToClipboard()" class="btn-copy">
                                    <i class="fa fa-clipboard" aria-hidden="true"></i> 
                                </button>   
                            </div>
                            @endif
                        </div>
                        @endif
                        


                        <div class="card mb-3 p-3" style="background-color: #233e99; color: white;">Tulis Laporan Disini!, Jika sebelumnya pernah mamasukan laporan masukan kode laporan anda </div>
                        <form action="{{ route('pekat.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h6 style="margin-bottom: 4px;">Nama<span class="red-asterisk">*</span></h6>
                                <input type="text" value="{{ old('nama') }}" name="nama"
                                    placeholder="Masukkan Nama Anda" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <h6 style="margin-bottom: 4px; ">No. Telepon<span class="red-asterisk">*</span></h6>
                                <input type="text" value="{{ old('no_hp') }}" name="no_hp"
                                    placeholder="Masukkan No HP" class="form-control" required>
                            </div>
                            
                            <div class="form-group">
                                <h6 style="margin-bottom: 4px;"> No Sambungan</h6>
                                <input type="text" value="{{ old('no_index') }}" name="no_index"
                                placeholder="Masukkan Nomor Sambungan" class="form-control" >
                                <h6 style="font-size: smaller; color:#0056b3; margin-left: 8px; margin-top:4px">Diisi bila ada</h6>
                            </div>

                            <div class="form-group">
                                <h6 style="margin-bottom: 4px; ">Jenis Pengaduan<span class="red-asterisk">*</span></h6>
                                <div class="input-group mb-3">
                                    <select name="judul_laporan" class="custom-select" id="inputGroupSelect01" required>
                                        <option value="" selected style="font-size: smaller;">Pilih Judul Laporan</option>
                                        <option value="air keruh">Air Keruh</option>
                                        <option value="kebocoran">Kebocoran</option>
                                        <option value="meteran">Meteran</option>
                                        <option value="pemakaian">Pemakaian</option>
                                        <option value="tidak dapat air">Tidak Dapat Air</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <h6 style="margin-bottom: 4px; ">Isi Laporan<span class="red-asterisk">*</span></h6>
                                <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control"
                                    rows="4" required>{{ old('isi_laporan') }}</textarea>
                            </div>
                            <div class="form-group">
                                <h6 style="margin-bottom: 4px; ">Tanggal Kejadian<span class="red-asterisk">*</span></h6>
                                <input type="text" value="{{ old('tgl_kejadian') }}" name="tgl_kejadian"
                                    placeholder="Pilih Tanggal Kejadian" class="form-control" onfocusin="(this.type='date')"
                                    onfocusout="(this.type='text')"required>
                            </div>
                            <div class="form-group">
                                <h6 style="margin-bottom: 4px; ">Wilayah Kejadian<span class="red-asterisk">*</span></h6>
                                <div class="input-group mb-3">
                                    <select name="wilayah_kejadian" class="custom-select" id="inputGroupSelect01" required>
                                        <option value="" selected>Pilih Wilayah Kejadian</option>
                                        <option value="lubuk basung">Lubuk Basung</option>
                                        <option value="baso">Baso</option>
                                        <option value="IV angkek">IV Angkek</option>
                                        <option value="maninjau">Maninjau</option>
                                        <option value="tiku">Tiku</option>
                                        <option value="batu kambing">Batu Kambing</option>
                                        <option value="matur">Matur</option>
                                        <option value="sungai puar">Sungai Puar</option>
                                        <option value="IV koto">IV Koto</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <h6 style="margin-bottom: 4px; ">Lokasi Kejadian<span class="red-asterisk">*</span></h6>
                                <textarea name="lokasi_kejadian" id="latlang" rows="3" class="form-control mb-3" placeholder="Detail Lokasi" required>{{ old('lokasi_kejadian') }}</textarea>
                            </div>

                            <div class="form-group">
                                <h6 style="margin-bottom: 4px;">Upload Bukti Foto</h6>
                                <input type="file" name="foto" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Kirim</button>
                        </form>
                    </div>
                </div>

                <!-- Formulir Pencarian Laporan -->
                
            </div>
        </div>
    </main>

    @include('partials.footer')

    @section('js')
    <script>
        
        @if (Session::has('pesan'))
            // Tampilkan modal login jika ada pesan
            $('#loginModal').modal('show');
        @endif

        function copyToClipboard() {
            var copyText = document.getElementById("kodeLaporan");
            navigator.clipboard.writeText(copyText.innerText).then(function() {
                alert("Kode Laporan disalin: " + copyText.innerText);
            }).catch(function(err) {
                console.error("Failed to copy text: ", err);
            });
        }

        // Jika ada pesan dengan 'kode_laporan', hubungkan fungsi copyToClipboard dengan tombol 'Salin'
        @if (Session::has('kode_laporan'))
            document.querySelector('.btn-copy').addEventListener('click', copyToClipboard);
        @endif
    </script>
    @show
</body>

</html>
