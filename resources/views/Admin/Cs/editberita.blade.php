@extends('layouts.admin')

@section('title', 'Form Edit Berita')

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
    <a href="" class="text-primary">Berita</a>
    <a href="#" class="text-grey">/</a>
    <a href="#" class="text-grey">Form Edit Berita</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    Form Edit Info Gangguan
                </div>
                <div class="card-body">
                    <form action="{{ route('berita.update', $berita->id_berita) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" value="{{ old('judul', $berita->judul) }}" name="judul" id="judul" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" required>{{ old('deskripsi', $berita->deskripsi) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto Saat Ini</label>
                            @if ($berita->foto)
                                <div>
                                    <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto Berita" class="img-thumbnail" width="150">
                                </div>
                            @else
                                <p>Tidak ada foto</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="foto">Unggah Foto Baru</label>
                            <input type="file" name="foto" id="foto" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-warning text-white" style="width: 100%">UPDATE</button>
                    </form>

                    <form action="{{ route('berita.destroy', $berita->id_berita) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="width: 100%" onclick="return confirm('APAKAH YAKIN?')">HAPUS</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-12">
            @if (Session::has('notif'))
                <div class="alert alert-danger">
                    {{ Session::get('notif') }}
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
