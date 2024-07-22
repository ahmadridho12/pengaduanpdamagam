@extends('layouts.admin')

@section('title', 'Form Edit Mou')

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
    <a href="#" class="text-grey">Form Edit Mou</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    Form Edit Mou
                </div>
                <div class="card-body">
                    <form action="{{ route('mou.update', $mou->id_mou) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" value="{{ old('judul', $mou->judul) }}" name="judul" id="judul" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="nomor">Nomor</label>
                            <input type="text" value="{{ old('nomor', $mou->nomor) }}" name="nomor" id="nomor" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="instusi">Instusi</label>
                            <input type="text" value="{{ old('instusi', $mou->instusi) }}" name="instusi" id="instusi" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="tgl_ditetapkan">Tanggal Mou</label>
                            <input type="date" value="{{ old('tgl_ditetapkan', $mou->tgl_ditetapkan->format('Y-m-d')) }}" name="tgl_ditetapkan" id="tgl_ditetapkan" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="tgl_berlaku">Tanggal Mulai</label>
                            <input type="date" value="{{ old('tgl_berlaku', $mou->tgl_berlaku->format('Y-m-d')) }}" name="tgl_berlaku" id="tgl_berlaku" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="tgl_selesai">Tanggal Selesai</label>
                            <input type="date" value="{{ old('tgl_selesai', $mou->tgl_selesai->format('Y-m-d')) }}" name="tgl_selesai" id="tgl_selesai" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <div class="input-group mb-3">
                                <select name="status" id="status" class="custom-select">
                                    <option value="Berlaku" {{ old('status', $mou->status) == 'Berlaku' ? 'selected' : '' }}>Berlaku</option>
                                    <option value="Perpanjangan" {{ old('status', $mou->status) == 'Perpanjangan' ? 'selected' : '' }}>Perpanjangan</option>
                                    <option value="Expired" {{ old('status', $mou->status) == 'Expired' ? 'selected' : '' }}>Expired</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file">File</label>
                            @if ($mou->file)
                                <p>Nama File Saat Ini: {{ $mou->file }}</p>
                                <!-- Link untuk mengunduh file -->
                                <a href="{{ asset('storage/mou_files/' . $mou->file) }}" target="_blank">Unduh File</a>
                            @endif
                            <input type="file" name="file" id="file" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-warning text-white" style="width: 100%">UPDATE</button>
                    </form>

                    <form action="{{ route('mou.destroy', $mou->id_mou) }}" method="POST" class="mt-2">
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
