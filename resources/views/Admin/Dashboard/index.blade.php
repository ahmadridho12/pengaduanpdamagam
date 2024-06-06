@extends('layouts.admin')

@section('title', 'Halaman Dashboard')

@section('header', 'Dashboard')

@section('content')
    <style>
        .header-section {
            position: relative;
            text-align: center;
            color: white; /* Warna teks putih untuk kontras dengan latar belakang */
            margin-bottom: 20px;
            padding: 20px;
            overflow: hidden;
        }

        .header-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; /* Gambar berada di belakang teks */
            
        }

        .complaint-summary {
            margin-bottom: 20px;
        }

        .complaint-summary .card-header {
            background-color: #D9D9D9;
            border-bottom: 1px solid #ddd;
        }

        .complaint-summary .card-body {
            padding: 10px;
        }

        .complaint-summary ul {
            margin: 0;
            padding: 0;
        }

        .complaint-summary ul li {
            list-style: none;
            padding: 5px 0;
            font-size: 16px;
        }
        .card-header {
            background-color: #233e99;
            
        }

        .footer {
            margin-top: 20px;
            padding: 10px;
            background-color: #f5f5f5;
            text-align: center;
        }
    </style>

    <!-- Bagian Header -->
    <div class="header-section">
        <img src="{{ asset('images/gelombang.png') }}" alt="Header Dashboard" class="header-image">
        <h4>Selamat Datang di Mall Pelayanan Publik, PDAM Tirta Antokan</h4>
    </div>

    <!-- Ringkasan Pengaduan berdasarkan Status dan Tipe -->
    
    <div class="row" >
        <div class="col-lg-6">
            <div class="card complaint-summary">
                <div class="card-header" style="background-color: #233e99; color: white;font-weight: bold;">Pengaduan Berdasarkan Status </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <div class="card" style="background-color: white; color: black; border-left: 5px solid  #233e99; margin-bottom: 16px;">
                                    <div class="card-body" style="font-weight: bold;">
                                        SEMUA : {{ $totalComplaints }}
                                    </div>
                                </div>
                                  <div class="card" style="background-color: white; color: black; border-left: 5px solid #233e99;">
                                    <div class="card-body" style="font-weight: bold; color: red; ">
                                        PENDING : {{ $pendingComplaints }}
                                    </div>
                                </div>
                                
                                
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                
                                  <div class="card" style="background-color: white; color: black; border-left: 5px solid  #233e99; margin-bottom: 16px;">
                                    <div class="card-body" style="font-weight: bold; color: orange">
                                        PROSES : {{ $processingComplaints }}
                                    </div>
                                </div>
                                  <div class="card" style="background-color: white; color: black; border-left: 5px solid #233e99;">
                                    <div class="card-body" style="font-weight: bold; color: green">
                                        SELESAI : {{ $completedComplaints }}
                                    </div>
                                </div>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card complaint-summary">
                <div class="card-header" style="background-color: #233e99; color: white;font-weight: bold;">Pengaduan Berdasarkan Tipe </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <div class="card" style="background-color: white; color: black; border-left: 5px solid  #233e99; margin-bottom: 16px;">
                                    <div class="card-body" style="font-weight: bold; color:">
                                        AIR KERUH : {{$airkeruhComplaints}}
                                    </div>
                                </div>
                                  <div class="card" style="background-color: white; color: black; border-left: 5px solid #233e99; margin-bottom: 16px;">
                                    <div class="card-body" style="font-weight: bold;">
                                        KEBOCORAN : {{ $kebocoranComplaints }}
                                    </div>
                                </div>
                                  <div class="card" style="background-color: white; color: black; border-left: 5px solid #233e99;">
                                    <div class="card-body" style="font-weight: bold;">
                                        METERAN : {{$meteranComplaints}}
                                    </div>
                                </div>
                                
                                
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                
                                  <div class="card" style="background-color: white; color: black; border-left: 5px solid  #233e99; margin-bottom: 16px;">
                                    <div class="card-body" style="font-weight: bold;">
                                        PEMAKAIAN : {{$pemakaianComplaints}}
                                    </div>
                                </div>
                                  <div class="card" style="background-color: white; color: black; border-left: 5px solid #233e99; margin-bottom: 16px;">
                                    <div class="card-body" style="font-weight: bold;">
                                        TIDAK DAPAT AIR : {{$tidakdapatairComplaints}}
                                    </div>
                                </div>
                                  <div class="card" style="background-color: white; color: black; border-left: 5px solid #233e99;">
                                    <div class="card-body" style="font-weight: bold;">
                                        LAINNYA : {{$lainnyaComplaints}}
                                    </div>
                                </div>
                                
                                
                                
                            </ul>
                        </div>

                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <br>
    <br>
    <br>
    <form method="GET" action="{{ route('admin.dashboard') }}">
        <div class="row mb-4">
            <div class="col-lg-3">
                <select name="group_by" class="form-control">
                    <option value="day" {{ request('group_by') == 'day' ? 'selected' : '' }}>Harian</option>
                    <option value="week" {{ request('group_by') == 'week' ? 'selected' : '' }}>Mingguan</option>
                    <option value="month" {{ request('group_by') == 'month' ? 'selected' : '' }}>Bulanan</option>
                </select>
            </div>
            <div class="col-lg-3">
                <select name="wilayah_kejadian" class="form-control">
                    <option value="">Pilih Wilayah</option>
                    @foreach($wilayahKejadianOptions as $option)
                        <option value="{{ $option }}" {{ request('wilayah_kejadian') == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3">
                <select name="judul_laporan" class="form-control">
                    <option value="">Pilih Judul Laporan</option>
                    @foreach($judulLaporanOptions as $option)
                        <option value="{{ $option }}" {{ request('judul_laporan') == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="background-color: #233e99; color: white;font-weight: bold;">Grafik Jumlah Laporan Masuk Per {{ ucfirst(request('group_by', 'hari')) }}</div>
                <div class="card-body">
                    <canvas id="laporanChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Define fixed colors for each judul_laporan
    const colors = {
        'air keruh': 'rgba(165, 42, 42, 0.2)', // Brown background
        'kebocoran': 'rgba(14, 17, 200, 0.8)',
        'meteran': 'rgba(2, 4, 125, 0.8)',
        'pemakaian': 'rgba(0, 189, 145, 0.8)',
        'tidak dapat air': 'rgba(200, 19, 28, 0.8)',
        'lainnya': 'rgba(165, 183, 178, 0.8)',
        // Add more colors as needed
    };

    const borderColors = {
        'air keruh': 'rgba(165, 42, 42, 0.2)', // Brown background
        'kebocoran': 'rgba(14, 17, 200, 0.8)',
        'meteran': 'rgba(2, 4, 125, 0.8)',
        'pemakaian': 'rgba(0, 189, 145, 0.8)',
        'tidak dapat air': 'rgba(200, 19, 28, 0.8)',
        'lainnya': 'rgba(165, 183, 178, 0.8)',
    };

    const defaultColor = 'rgba(0, 0, 0, 0.2)';
    const defaultBorderColor = 'rgba(0, 0, 0, 1)';

    var ctx = document.getElementById('laporanChart').getContext('2d');
    var datasets = [];
    var labels = {!! json_encode($dates) !!};
    var jumlahLaporan = {!! json_encode($jumlahLaporan) !!};

    for (var judul in jumlahLaporan) {
        var data = [];
        for (var i = 0; i < labels.length; i++) {
            data.push(jumlahLaporan[judul][labels[i]] || 0);
        }
        datasets.push({
            label: judul,
            data: data,
            backgroundColor: colors[judul] || defaultColor, // Default color if not defined
            borderColor: borderColors[judul] || defaultBorderColor, // Default border color if not defined
            borderWidth: 1
        });
    }

    var laporanChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: datasets
    },
    options: {
        scales: {
            y: {
                display: false
            },
            x: {
                grid: {
                    display: false // Menonaktifkan garis grid untuk sumbu X
                }
            }
        }
    }
});
</script>
@endpush