<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>
        @yield('title', config('app.name'))
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="{{ config('app.name') }}">
    <meta name="author" content="Bantu Indong">
    <meta name="description" content="{{ config('app.name') }} - Aplikasi pelayanan publik berbasis digital">
    <meta name="keywords" content="aplikasi, pelayanan, publik, digital, bantu, indong" />
    <link rel="canonical" href="{{ url('/') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:description" content="{{ config('app.name') }} - Aplikasi pelayanan publik berbasis digital">
    <meta property="og:image" content="{{ url('/') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="{{ config('app.name') }}">
    <meta property="twitter:description" content="{{ config('app.name') }} - Aplikasi pelayanan publik berbasis digital">
    <meta property="twitter:image" content="{{ url('/') }}">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url('/') }}/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('/') }}/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/') }}/favicon-16x16.png">
    <link rel="manifest" href="{{ url('/') }}/site.webmanifest">
    <link rel="mask-icon" href="{{ url('/') }}/safari-pinned-tab.svg" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link type="text/css" href="{{ url('/') }}/css/custom-theme.css" rel="stylesheet">
    <link type="text/css" href="{{ url('/') }}/css/effects.css" rel="stylesheet">
    <link type="text/css" href="{{ url('/') }}/css/modern-navbar.css" rel="stylesheet">
    
    <!-- Stacked Styles -->
    @stack('styles')
    
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Sweet Alert -->
    <link type="text/css" href="{{ url('/') }}/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Notyf -->
    <link type="text/css" href="{{ url('/') }}/vendor/notyf/notyf.min.css" rel="stylesheet">

</head>

<body>
    <!-- Combined Header & Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top modern-navbar shadow" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ url('/') }}/logo.png" alt="Logo" class="logo me-2">
                <span>{{ config('app.name') }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#hero" data-scroll><i class="fas fa-home me-1"></i> Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#fitur" data-scroll><i class="fas fa-star me-1"></i> Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kategori" data-scroll><i class="fas fa-th-large me-1"></i> Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimoni" data-scroll><i class="fas fa-comment-dots me-1"></i> Testimoni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq" data-scroll><i class="fas fa-question-circle me-1"></i> FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak" data-scroll><i class="fas fa-envelope me-1"></i> Kontak</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <form class="d-flex me-2 d-none d-lg-block">
                        <div class="input-group">
                            <input class="form-control" type="search" placeholder="Cari" aria-label="Search">
                            <button class="btn btn-light" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <div class="nav-buttons">
                        <a href="{{ route('login') }}" class="btn btn-light btn-sm me-2"><i class="fas fa-sign-in-alt me-1"></i> Masuk</a>
                        <a href="#" class="btn btn-outline-light btn-sm"><i class="fas fa-user-plus me-1"></i> Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Animations -->
    <script src="{{ url('/') }}/js/custom-animations.js"></script>
    
    <!-- Sweet Alert -->
    <script src="{{ url('/') }}/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    
    <!-- Notyf -->
    <script src="{{ url('/') }}/vendor/notyf/notyf.min.js"></script>
    
    <!-- Custom JS -->
    <script src="{{ url('/') }}/js/frontend.js"></script>
    <script src="{{ url('/') }}/js/navbar-animations.js"></script>
    
    <!-- Stacked Scripts -->
    @stack('scripts')
</body>

</html>