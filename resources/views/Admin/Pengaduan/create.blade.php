@extends('layouts.admin')

@section('title', 'Form Tambah Pengaduan')

@section('css')
<style>
    .text-primary:hover {
        text-decoration: underline;
    }

    .text-grey {
        color: #6c757d;
    }

    .text-grey:hover {
        color: #6c757d;
    }

    .red-asterisk {
        color: red;
    }

    .btn-copy {
        background: none;
        border: none;
        cursor: pointer;
    }

    .btn-copy i {
        color: #007bff;
        font-size: 1.2em;
    }

    .btn-copy:hover i {
        color: #0056b3;
    }

    .btn-custom {
        background-color: #233e99;
        color: white;
    }

    .card-custom {
        background-color: #f8f9fa;
        border-color: #233e99;
    }

    input::placeholder, select, option, textarea::placeholder {
        font-size: small;
    }
</style>
@endsection

@section('header')
    <a href="{{ route('pengaduan.index') }}" class="text-primary">Pengaduan</a>
    <a href="#" class="text-grey">/</a>
    <a href="#" class="text-grey">Form Tambah Pengaduan</a>
    @yield('css')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card card-custom">
                <div class="card-header" style="text-align: center; font-weight: bold; color: blue;">
                    Form Tambah Pengaduan
                </div>
                
                <div class="card-body">
                    <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Form fields -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama<span class="red-asterisk">*</span></label>
                                    <input type="text" value="{{ old('nama') }}" name="nama" id="nama"
                                        placeholder="Masukkan Nama Anda" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp">No. Telepon<span class="red-asterisk">*</span></label>
                                    <input type="text" value="{{ old('no_hp') }}" name="no_hp" id="no_hp"
                                        placeholder="Masukkan No HP" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_index">No Sambungan</label>
                                    <input type="text" value="{{ old('no_index') }}" name="no_index" id="no_index"
                                        placeholder="Masukkan Nomor Sambungan" class="form-control">
                                    <small class="form-text text-info">Diisi bila ada</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judul_laporan">Jenis Pengaduan<span class="red-asterisk">*</span></label>
                                    <select name="judul_laporan" id="judul_laporan" class="form-control" required>
                                        <option value="" selected>Pilih Judul Laporan</option>
                                        <option value="air keruh">Air Keruh</option>
                                        <option value="kebocoran">Kebocoran</option>
                                        <option value="meteran">Meteran</option>
                                        <option value="pemakaian">Pemakaian</option>
                                        <option value="tidak dapat air">Tidak Dapat Air</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tgl_kejadian">Tanggal Kejadian<span class="red-asterisk">*</span></label>
                                    <input type="text" value="{{ old('tgl_kejadian') }}" name="tgl_kejadian" id="tgl_kejadian"
                                        placeholder="Pilih Tanggal Kejadian" class="form-control" onfocusin="(this.type='date')"
                                        onfocusout="(this.type='text')" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wilayah_kejadian">Wilayah Kejadian<span class="red-asterisk">*</span></label>
                                    <select name="wilayah_kejadian" id="wilayah_kejadian" class="form-control" required
                                        onchange="updateRayonOptions(this.value)">
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
                        </div>

                        <!-- Added Rayon select -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p style="margin-bottom: 4px;color: black;">Rayon<span class="red-asterisk">*</span></p>
                                    <select name="nama_rayon" id="rayon" class="form-control" required>
                                        <option value="" selected>Pilih Rayon</option>
                                        <!-- Opsi rayon akan diisi melalui JavaScript -->
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="isi_laporan">Isi Laporan<span class="red-asterisk">*</span></label>
                            <textarea name="isi_laporan" id="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control"
                                rows="4" required>{{ old('isi_laporan') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="lokasi_kejadian">Lokasi Kejadian<span class="red-asterisk">*</span></label>
                            <textarea name="lokasi_kejadian" id="lokasi_kejadian" rows="3" class="form-control mb-3" 
                                placeholder="Detail Lokasi" required>{{ old('lokasi_kejadian') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control">
                            <small class="form-text text-info">Diisi bila ada</small>
                        </div>

                        <button type="submit" class="btn btn-custom mt-2">Kirim Pengaduan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            @if (Session::has('username'))
                <div class="alert alert-danger">
                    {{ Session::get('username') }}
                </div>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function updateRayonOptions(wilayahKejadian) {
        let apiUrl = '';
        switch (wilayahKejadian) {
            case 'lubuk basung':
                apiUrl = '/api/rayon_lubukbasung';
                break;
            case 'tiku':
                apiUrl = '/api/rayon_tiku';
                break;
            case 'batukambing':
                apiUrl = '/api/rayon_batukambing';
                break;
            case 'baso':
                apiUrl = '/api/rayon_baso';
                break;
            // Tambahkan case lain sesuai dengan wilayah_kejadian Anda
            default:
                return; // Jika tidak ada wilayah yang dipilih, keluar dari fungsi
        }

        // Fetch data dari API dan update dropdown rayon
        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const rayonSelect = document.getElementById('rayon');
                rayonSelect.innerHTML = '<option value="" selected>Pilih Rayon</option>'; // Reset opsi rayon

                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id; // Atau item.kode_rayon jika lebih sesuai
                    option.textContent = item.nama_rayon;
                    rayonSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching rayon data:', error));
    }
</script>
@endsection