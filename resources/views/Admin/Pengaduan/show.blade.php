@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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

    .btn-purple {
        background: #4C4DDC;
        border: 1px solid #C3C4F3;
        color: #4C4DDC;
        width: 100%;
    }

    .table {
        background-color: #e6f7ff; /* Light blue background color */
    }
    .table th {
        background-color: #b3e0ff; /* Slightly darker blue for header */
    }
    .table tr:nth-child(even) {
        background-color: #f2f9ff; /* Light blue for even rows */
    }
    .img-fluid {
        max-width: 100%;
        height: auto;
    }
</style>
@endsection

@section('header')
<a href="{{ route('pengaduan.index') }}" class="text-primary">Data Pengaduan</a>
<a href="#" class="text-grey">/</a>
<a href="#" class="text-grey">Detail Pengaduan</a>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6 col-12">
        <div class="card">
            <div class="card-header text-center">
                Pengaduan Pelanggan
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>No Sambungan</th>
                            <td>:</td>
                            <td>{{ $pengaduan->no_index }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pelanggan</th>
                            <td>:</td>
                            <td>{{ $pengaduan->nama }}</td>
                        </tr>
                        <tr>
                            <th>No Hp</th>
                            <td>:</td>
                            <td>{{ $pengaduan->no_hp }}</td>
                        </tr>
                        <tr>
                            <th>Kode Laporan</th>
                            <td>:</td>
                            <td>{{ $pengaduan->kode_laporan }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Pengaduan</th>
                            <td>:</td>
                            <td>{{ $pengaduan->tgl_pengaduan->format('d-M-Y') }}</td>
                        </tr>
                        <tr>
                            <th>Judul Laporan</th>
                            <td>:</td>
                            <td>{{ $pengaduan->judul_laporan }}</td>
                        </tr>
                        <tr>
                            <th>Isi Laporan</th>
                            <td>:</td>
                            <td>{{ $pengaduan->isi_laporan }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Kejadian</th>
                            <td>:</td>
                            <td>{{ $pengaduan->tgl_kejadian->format('d-M-Y') }}</td>
                        </tr>
                        <tr>
                            <th>Wilayah Kejadian</th>
                            <td>:</td>
                            <td>{{ ucwords($pengaduan->wilayah_kejadian) }}</td>
                        </tr>
                        <tr>
                            <th>Lokasi Kejadian</th>
                            <td>:</td>
                            <td>{{ ucwords($pengaduan->lokasi_kejadian) }}</td>
                        </tr>
                        <tr>
                            <th>Foto</th>
                            <td>:</td>
                            <td><img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto Pengaduan" class="img-fluid"></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td>
                                @if ($pengaduan->status == '0')
                                    <span class="badge badge-danger">Pending</span>
                                @elseif($pengaduan->status == 'proses')
                                    <span class="badge badge-warning text-white">Proses</span>
                                @else
                                    <span class="badge badge-success">Selesai</span>
                                @endif
                            </td>

                        </tr>
                        <tr>
                            <th style="text-align:center" colspan="3">Tanggapan Petugas</th>
                        </tr>
                        <tr>
                            <th>Tanggal Dikerjakan</th>
                            <td>:</td>
                            <td>
                                @if ($tanggapan && $tanggapan->tgl_tanggapan)
                                    {{ $tanggapan->tgl_tanggapan->format('d-M-Y') }}
                                @else
                                    Belum diproses
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Foto Tanggapan</th>
                            <td>:</td>
                            <td>
                                @if($tanggapan && $tanggapan->foto)
                                    <img src="{{ Storage::url($tanggapan->foto) }}" alt="Foto Tanggapan" class="img-fluid">
                                @else
                                    Tidak ada foto
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>:</td>
                            <td>
                                @if($tanggapan && $tanggapan->keterangan)
                                    {{ $tanggapan->keterangan }}
                                @else
                                    Tidak ada keterangan
                                @endif
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-12">
        <div class="card">
            <div class="card-header text-center">
                Tanggapan Petugas
            </div>
            <div class="card-body">
                <form action="{{ route('tanggapan.createOrUpdate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_pengaduan" value="{{ $pengaduan->id_pengaduan }}">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <div class="input-group mb-3">
                            <select name="status" id="status" class="custom-select">
                                <option value="0" {{ $pengaduan->status == '0' ? 'selected' : '' }}>Pending</option>
                                <option value="proses" {{ $pengaduan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto Tanggapan</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-purple"><i class="fas fa-send"></i> KIRIM</button>
                </form>
                
                <br><br>
                
                <a href="{{ route('pengaduan.cetakspko', ['id_pengaduan' => $pengaduan->id_pengaduan]) }}" class="btn btn-primary btn-block" target="_blank"><i class="fas fa-print"></i> Cetak SPKO</a>
                
                @if ($pengaduan->id_pengaduan != 1)
                    @php
                        $hasTanggapan = \App\Models\Tanggapan::where('id_pengaduan', $pengaduan->id_pengaduan)->exists();
                    @endphp

                    @if ($hasTanggapan)
                        <button class="btn btn-secondary mt-2" style="width: 100%" disabled>HAPUS LAPORAN</button>
                    @else
                        <form action="{{ route('pengaduan.destroy', $pengaduan->id_pengaduan) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-2" style="width: 100%" onclick="return confirm('APAKAH YAKIN?')">HAPUS LAPORAN</button>
                        </form>
                    @endif
                @endif
                
                <br><br>
            </div>
            
                @if (Session::has('status'))
                    <div class="alert alert-success mt-2">
                        {{ Session::get('status') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#petugasTable').DataTable();
    });
</script>
@endsection
