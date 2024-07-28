@extends('layouts.admin')

@section('title', 'Form Edit Info Gangguan')

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
    <a href="" class="text-primary">Info Gangguan</a>
    <a href="#" class="text-grey">/</a>
    <a href="#" class="text-grey">Form Edit Mou</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    Form Edit Info Gangguan
                </div>
                <div class="card-body">
                    <form action="{{ route('infogangguan.update', $infogangguan->id_gangguan) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" value="{{ old('judul', $infogangguan->judul) }}" name="judul" id="judul" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input type="textarea" value="{{ old('deskripsi', $infogangguan->deskripsi) }}" name="deskripsi" id="deskripsi" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal">Tanggal Gangguan</label>
                            <input type="date" value="{{ old('tanggal', $infogangguan->tanggal->format('Y-m-d')) }}" name="tanggal" id="tanggal" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <div class="input-group mb-3">
                                <select name="status" id="status" class="custom-select">
                                    <option value="aktif" {{ old('status', $infogangguan->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="proses" {{ old('status', $infogangguan->status) == 'proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="selesai" {{ old('status', $infogangguan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning text-white" style="width: 100%">UPDATE</button>
                    </form>

                    <form action="{{ route('infogangguan.destroy', $infogangguan->id_gangguan) }}" method="POST" class="mt-2">
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
