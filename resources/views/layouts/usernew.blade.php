<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <!-- CSS Layout -->
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <!-- CSS Tambahan -->
    @yield('css')
</head>
<body>
    <!-- Navbar -->
    @include('partials.navbar')
    
    <!-- Konten Utama -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('partials.footer')
    
    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>
</html>
