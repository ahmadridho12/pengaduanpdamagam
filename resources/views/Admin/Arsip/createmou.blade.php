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
    <a href="#" class="text-grey">Form Tambah Mou</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    Form Tambah Mou
                </div>
                <div class="card-body">
                    <form action="{{ route('storeMou') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor">Nomor</label>
                            <input type="text" name="nomor" id="nomor" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="instusi">Institusi</label>
                            <input type="text" name="instusi" id="instusi" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <p style="margin-bottom: 4px; ">Tanggal Mou<span class="red-asterisk">*</span></p>
                            <input type="text" value="{{ old('tgl_ditetapkan') }}" name="tgl_ditetapkan"
                                placeholder="Pilih Tanggal Mou" class="form-control" onfocusin="(this.type='date')"
                                onfocusout="(this.type='text')"required>
                        </div>
                        <div class="form-group">
                            <p style="margin-bottom: 4px; ">Tanggal Mulai<span class="red-asterisk">*</span></p>
                            <input type="text" value="{{ old('tgl_berlaku') }}" name="tgl_berlaku"
                                placeholder="Pilih Tanggal Berlaku" class="form-control" onfocusin="(this.type='date')"
                                onfocusout="(this.type='text')"required>
                        </div>
                        <div class="form-group">
                            <p style="margin-bottom: 4px; ">Tanggal Selesai<span class="red-asterisk">*</span></p>
                            <input type="text" value="{{ old('tgl_selesai') }}" name="tgl_selesai"
                                placeholder="Pilih Tanggal Selesai" class="form-control" onfocusin="(this.type='date')"
                                onfocusout="(this.type='text')"required>
                        </div>
                        <div class="form-group">
                            <p style="margin-bottom: 4px; ">Status<span class="red-asterisk">*</span></p>
                            <div class="input-group mb-3">
                                <select name="status" class="custom-select" id="inputGroupSelect01" required>
                                    <option value="" selected style="font-size: smaller;">Pilih  status</option>
                                    <option value="Berlaku">Berlaku</option>
                                    <option value="Perpanjangan">Perpanjangan</option>
                                    <option value="Expired">Expired</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" name="file" id="file" class="form-control" required>
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