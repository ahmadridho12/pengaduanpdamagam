<!DOCTYPE html>
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
    <style>
        .custom-img {
            width: 100px; /* Atur ukuran gambar sesuai kebutuhan */
            height: auto; /* Menjaga proporsi gambar */
            object-fit: cover; /* Mengatur tampilan gambar */
        }
        .tblatas th, .tblatas td {
            text-align: center; /* Mengatur teks di tengah */
        }
        .table {
            border-color: #233e99;
        }
        .btn-custom {
            background-color: #233e99;
            border: none;
            color: white;
        }
    </style>
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
                        <i class="fa fa-info-circle" aria-hidden="true"></i> UNTUK INFORMASI TAGIHAN DAN PENGADUAN ADA DIMENU LAYANAN
                    </div>
                    <!-- Ulangi elemen slide untuk membuat loop -->
                    <div class="slide1">
                        <i class="fa fa-credit-card" aria-hidden="true"></i> DIINFORMASIKAN UNTUK MELAKUKAN PEMBAYARAN TAGIHAN AIR SEBELUM TANGGAL 20 SETIAP BULANNYA
                    </div>
                    <div class="slide1">
                        <i class="fa fa-info-circle" aria-hidden="true"></i> UNTUK INFORMASI TAGIHAN DAN PENGADUAN ADA DIMENU LAYANAN
                    </div>
                </div>
            </div>
        </div>

        <br>
        <br>

        <!-- Formulir Pencarian Laporan -->
        <div class="container mt-12">
            <div class="card2">
                <div class="col-md-12">
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

        <br>
        <br>
        <!-- Menampilkan data laporan -->
        @if($laporan)
        <div class="container mt-2">
            <!-- Tabel Laporan -->
            <table class="table table-bordered">
                <thead>
                    <tr class="tblatas">
                        <th scope="col">Detail</th>
                        <th scope="col">Data</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Judul Laporan</td>
                        <td>{{ $laporan->judul_laporan }}</td>
                    </tr>
                    <tr>
                        <td>Kode Laporan</td>
                        <td>{{ $laporan->kode_laporan }}</td>
                    </tr>
                    <tr>
                        <td>Nama Pelapor</td>
                        <td>{{ $laporan->nama }}</td>
                    </tr>
                    <tr>
                        <td>No Telepon</td>
                        <td>{{ $laporan->no_hp }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Sambungan</td>
                        <td>{{ $laporan->no_index }}</td>
                    </tr>
                    <tr>
                        <td>Isi Laporan</td>
                        <td>{{ $laporan->isi_laporan }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Pengaduan</td>
                        <td>{{ $laporan->tgl_pengaduan->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Kejadian</td>
                        <td>{{ $laporan->tgl_kejadian->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td>Wilayah Kejadian</td>
                        <td>{{ $laporan->wilayah_kejadian }}</td>
                    </tr>
                    <tr>
                        <td>Lokasi Kejadian</td>
                        <td>{{ $laporan->lokasi_kejadian }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if ($laporan->status == '0')
                                <span class="badge badge-danger">Pending</span>
                            @elseif($laporan->status == 'proses')
                                <span class="badge badge-warning text-white">Proses</span>
                            @else
                                <span class="badge badge-success">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @if($laporan->foto)
                    <tr>
                        <td>Foto</td>
                        <td>
                            @php
                                $fotoUrl = Storage::url($laporan->foto);
                            @endphp
                            <img src="{{ $fotoUrl }}" alt="Gambar Laporan" class="custom-img">
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <br>
            <br>
            <!-- Tabel Tanggapan -->
            @if($laporan->tanggapan)
            <table class="table table-bordered mt-12" >
                <div class="" style="border: 1px solid grey">
                <h4 style="text-align: center; font-weight: bold; font-size: 16px">Tanggapan Petugas</h4>
                </div>
                <thead>
                    <tr class="tblatas">
                        <th scope="col">Detail</th>
                        <th scope="col">Data</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tanggal Tanggapan</td>
                        <td style="color: green">{{ $laporan->tanggapan->tgl_tanggapan instanceof \Carbon\Carbon ? $laporan->tanggapan->tgl_tanggapan->format('d M Y') : $laporan->tanggapan->tgl_tanggapan }}</td>
                    </tr>
                    <tr>
                        <td>Keterangan Tanggapan</td>
                        <td style="color: green">{{ $laporan->tanggapan->keterangan }}</td>
                    </tr>
                    <tr>
                        <td>Foto Tanggapan</td>
                        <td>
                            @if($laporan->tanggapan->foto)
                                <img src="{{ Storage::url($laporan->tanggapan->foto) }}" alt="Foto Tanggapan" class="custom-img">
                            @else
                                Tidak ada foto
                            @endif
                        </td>
                    </tr>
                </tbody>
            </div>
            </table>
            @else
            <div class="container mt-2">
                <p>Belum ada tanggapan.</p>
            </div>
            @endif
        </div>
        @endif
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
