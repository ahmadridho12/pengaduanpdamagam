<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <style>
        body {
            background: #233e99;
        }

        .btn-purple {
            background: #233e99;
            width: 100%;
            color: #fff;
        }

        #loading-indicator {
            display: none;
            margin-top: 10px;
            text-align: center;
        }

    </style>

    <title>Halaman Masuk Petugas</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <h2 class="text-center text-white mb-0 mt-5">TIRTA ANTOKAN</h2>
                <P class="text-center text-white mb-5">Pengaduan Pelanggan</P>
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="text-center mb-5">FORM PETUGAS</h2>
                        <form id="login-form" action="{{ route('admin.login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="username" placeholder="Username" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-purple">MASUK</button>
                            <div id="loading-indicator">
                                <img src="https://cdnjs.cloudflare.com/ajax/libs/galleriffic/2.0.1/css/loader.gif" alt="Loading..." width="40">
                            </div>
                        </form>
                    </div>
                </div>

                <a href="{{ route('pekat.index') }}" class="btn btn-warning text-white mt-3" style="width: 100%">Kembali
                    ke Halaman Utama</a>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan indikator loading
        function showLoading() {
            document.getElementById('loading-indicator').style.display = 'block';
        }

        // Panggil fungsi untuk menampilkan indikator loading saat formulir dikirim
        document.getElementById('login-form').addEventListener('submit', function() {
            showLoading();
        });
    </script>
</body>

</html>
