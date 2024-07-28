@extends('layouts.admin')

@section('title', ' Add Berita')
    
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
    <a href="{{ route('indexmou') }}" class="text-primary">Berita</a>
    <a href="#" class="text-grey">/</a>
    <a href="#" class="text-grey">Form Tambah Berita</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    Form Tambah Berita
                </div>
                <div class="card-body">
                    <form action="{{ route('storeBerita') }}" method="post" enctype="multipart/form-data">
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
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control">
                            
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