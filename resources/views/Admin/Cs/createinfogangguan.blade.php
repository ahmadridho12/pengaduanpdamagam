@extends('layouts.admin')

@section('title', ' Add Mou')
    
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
    </style>
@endsection

@section('header')
    <a href="{{ route('indexmou') }}" class="text-primary">Mou</a>
    <a href="#" class="text-grey">/</a>
    <a href="#" class="text-grey">Form Tambah Info Gangguan</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    Form Tambah Info Gangguan
                </div>
                <div class="card-body">
                    <form action="{{ route('storeInfogangguan') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="instusi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" placeholder="Masukkan Deskripsi info gangguan" class="form-control"
                                rows="4" required>{{ old('deskripsi') }}</textarea>
                        </div>
                        <div class="form-group">
                            <p style="margin-bottom: 4px; ">Tanggal <span class="red-asterisk">*</span></p>
                            <input type="text" value="{{ old('tanggal') }}" name="tanggal"
                                placeholder="Pilih Tanggal Gangguan" class="form-control" onfocusin="(this.type='date')"
                                onfocusout="(this.type='text')"required>
                        </div>
                        <div class="form-group">
                            <p style="margin-bottom: 4px; ">Status<span class="red-asterisk">*</span></p>
                            <div class="input-group mb-3">
                                <select name="status" class="custom-select" id="inputGroupSelect01" required>
                                    <option value="" selected style="font-size: smaller;">Pilih  status</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="proses">Proses</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                        </div>
                        
                        
                        <button type="submit" class="btn btn-success" style="width: 100%">SIMPAN</button>
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
        </div>
    </div>
@endsection