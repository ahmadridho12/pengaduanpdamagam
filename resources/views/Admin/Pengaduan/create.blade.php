@extends('layouts.admin')

@section('title', 'Form Tambah Petugas')
    
@section('css')
<style>
    .text-primary:hover {
        text-decoration: underline;
    }

    .text-grey {
        color: #000000;
    }

    .text-grey:hover {
        color: #000000;
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
        background-color: #233e99; /* Ganti dengan warna yang diinginkan */
        color: white;
    }

    .card-custom {
        background-color: #f8f9fa; /* Warna latar belakang card */
        border-color: #233e99; /* Warna border card */
    }
    input::placeholder {
            font-size: small; /* Atur ukuran font untuk placeholder */
    }
    select, option {
            font-size: small; /* Atur ukuran font untuk select dan option */
    }
    textarea::placeholder {
            font-size: small; /* Atur ukuran font untuk placeholder */
    }
</style>
@endsection
@section('header')
    <a href="{{ route('pengaduan.index') }}" class="text-primary">Pengaduan</a>
    <a href="#" class="text-grey">/</a>
    <a href="#" class="text-grey">Form Tambah Pengaduan</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="text-align: center; font-weight: bold; color:blue">
                    Form Tambah Pengaduan
                </div>
                
                <div class="card-body">
                    <form action="{{ route('pekat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p style="margin-bottom: 4px; color: black;">Nama<span class="red-asterisk">*</span></p>
                                    <input type="text" value="{{ old('nama') }}" name="nama"
                                        placeholder="Masukkan Nama Anda" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p style="margin-bottom: 4px; color: black;">No. Telepon<span class="red-asterisk">*</span></p>
                                    <input type="text" value="{{ old('no_hp') }}" name="no_hp"
                                        placeholder="Masukkan No HP" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p style="margin-bottom: 4px; color: black;">No Sambungan</p>
                                    <input type="text" value="{{ old('no_index') }}" name="no_index"
                                    placeholder="Masukkan Nomor Sambungan" class="form-control">
                                    <p style="font-size: smaller; color:#0056b3; margin-left: 8px; margin-top:4px">Diisi bila ada</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p style="margin-bottom: 4px; color: black;">Jenis Pengaduan<span class="red-asterisk">*</span></p>
                                    <select name="judul_laporan" class="form-control" required>
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
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p style="margin-bottom: 4px; color: black;">Tanggal Kejadian<span class="red-asterisk">*</span></p>
                                    <input type="text" value="{{ old('tgl_kejadian') }}" name="tgl_kejadian"
                                        placeholder="Pilih Tanggal Kejadian" class="form-control" onfocusin="(this.type='date')"
                                        onfocusout="(this.type='text')" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p style="margin-bottom: 4px;color: black;">Wilayah Kejadian<span class="red-asterisk">*</span></p>
                                    <select name="wilayah_kejadian" class="form-control" required>
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
                        
                        <div class="form-group">
                            <p style="margin-bottom: 4px;color: black;">Isi Laporan<span class="red-asterisk">*</span></p>
                            <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control"
                                rows="4" required>{{ old('isi_laporan') }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <p style="margin-bottom: 4px;color: black;">Lokasi Kejadian<span class="red-asterisk">*</span></p>
                            <textarea name="lokasi_kejadian" id="latlang" rows="3" class="form-control mb-3" 
                                placeholder="Detail Lokasi" required>{{ old('lokasi_kejadian') }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <p style="margin-bottom: 4px;color: black;">Foto</p>
                            <input type="file" name="foto" class="form-control">
                            <p style="font-size: smaller; color:#0056b3; margin-left: 8px; margin-top: 4px;">Diisi bila ada</p>
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