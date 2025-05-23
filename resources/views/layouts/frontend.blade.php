<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>{{ config('app.name') }}</title>
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
    <link type="text/css" href="{{ url('/') }}/css/frontend.css" rel="stylesheet">
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
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top modern-navbar" style="background: linear-gradient(135deg, #8e44ad 0%, #e84393 100%);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <i class="fas fa-city me-2"></i>
                <span>{{ config('app.name') }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-home me-1"></i> Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-info-circle me-1"></i> Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-hands-helping me-1"></i> Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-envelope me-1"></i> Kontak</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <form class="d-flex me-2">
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
        <!-- Hero Section -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="display-4">{{ config('app.name') }}</h2>
                        <p class="lead">Aplikasi pelayanan publik berbasis digital yang bertujuan memberikan informasi pembangunan kepada masyarakat, layanan pengaduan online serta media promosi produk lokal.</p>
                        <p>Kamu juga dapat menjadi bagian dari {{ config('app.name') }} dengan mendaftarkan Merchant, UMKM, menjadi petani dan mengupload komoditi hasil pertanianmu serta membuka lowongan pekerjaan agar semua pengguna aplikasi ini dapat melihatnya.</p>
                        <div class="mt-4">
                            <a href="#" class="btn btn-primary me-2">Download Aplikasi</a>
                            <a href="#" class="btn btn-outline-primary">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <img src="{{ url('/') }}/assets/img/illustrations/hero.svg" alt="Hero Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-5">
            <div class="container">
                <h2 class="text-center mb-5">Fitur Utama</h2>
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="card h-100 text-center">
                            <div class="card-body">
                                <i class="fas fa-store fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Merchant</h5>
                                <p class="card-text">Daftarkan usaha kuliner Anda dan promosikan ke seluruh pengguna aplikasi.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100 text-center">
                            <div class="card-body">
                                <i class="fas fa-shopping-bag fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">UMKM</h5>
                                <p class="card-text">Promosikan produk UMKM Anda dan tingkatkan jangkauan pasar.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100 text-center">
                            <div class="card-body">
                                <i class="fas fa-seedling fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Petani</h5>
                                <p class="card-text">Jual hasil pertanian Anda langsung ke konsumen tanpa perantara.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100 text-center">
                            <div class="card-body">
                                <i class="fas fa-briefcase fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Lowongan</h5>
                                <p class="card-text">Buka lowongan pekerjaan dan temukan kandidat terbaik dari daerah Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center mb-4">Tanya Jawab</h2>
                        <p class="text-center mb-5">Pertanyaan dan jawaban seputar aplikasi</p>
                        
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Apa manfaat {{ config('app.name') }}?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Kami berharap aplikasi {{ config('app.name') }} ini dapat menjadi wadah untuk memperkenalkan produk-produk lokal kepada para pengguna aplikasi.</li>
                                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Melalui aplikasi ini produk-produk UMKM, Jajanan Kuliner serta Komoditi Hasil pertanian dan perkebunan dapat lebih dikenal serta dapat meningkatkan penjualan produk serta hasil pertanian dan perkebunan milik masyarakat.</li>
                                            <li><i class="fas fa-check-circle text-primary me-2"></i> Melalui aplikasi ini juga sebagai wadah bagi masyarkat yang ingin mengadukan keluhannya kepada pemerintah.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Bagaimana mendapatkan aplikasi {{ config('app.name') }}?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Saat ini aplikasi {{ config('app.name') }} masih tersedia untuk platform Android.</li>
                                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Untuk dapat menggunakannanya kamu cukup menginstallnya melalui Google Play Store search dengan kata kunci "{{ config('app.name') }}" atau dengan cara memilih logo Google Play di atas.</li>
                                            <li><i class="fas fa-check-circle text-primary me-2"></i> {{ config('app.name') }} diperuntukkan untuk para pengguna yang ingin mengetahui seputar pembangunan, produk-produk lokal yang telah diposting oleh para pengguna.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Bagaimana mendaftar sebagai member?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Kamu harus memiliki no handphone yang aktif, ketika melakukan registrasi akun kamu diwajibkan mendaftarkan nomor handphone yang aktif untuk menerima kode OTP.</li>
                                            <li><i class="fas fa-check-circle text-primary me-2"></i> Akun yang dibuat di aplikasi {{ config('app.name') }} dapat digunakan untuk mengakses semua fitur yang tersedia.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="py-5">
            <div class="container">
                <h2 class="text-center mb-5">Statistik Aplikasi</h2>
                <div class="row g-4 text-center">
                    <div class="col-md-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <i class="fas fa-store fa-3x text-primary mb-3"></i>
                                <h3 class="card-title">6</h3>
                                <p class="card-text">Merchant</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <i class="fas fa-shopping-bag fa-3x text-primary mb-3"></i>
                                <h3 class="card-title">11</h3>
                                <p class="card-text">UMKM</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <i class="fas fa-seedling fa-3x text-primary mb-3"></i>
                                <h3 class="card-title">8</h3>
                                <p class="card-text">Petani</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <i class="fas fa-users fa-3x text-primary mb-3"></i>
                                <h3 class="card-title">120</h3>
                                <p class="card-text">Pengguna</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Content Section -->
        <section class="py-5">
            <div class="container">
                @yield('content')
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>{{ config('app.name') }}</h5>
                    <p>Aplikasi pelayanan publik berbasis digital yang bertujuan memberikan informasi pembangunan kepada masyarakat, layanan pengaduan online serta media promosi produk lokal.</p>
                </div>
                <div class="col-md-3">
                    <h5>Tautan</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Beranda</a></li>
                        <li><a href="#" class="text-white">Tentang</a></li>
                        <li><a href="#" class="text-white">Layanan</a></li>
                        <li><a href="#" class="text-white">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Layanan</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Merchant</a></li>
                        <li><a href="#" class="text-white">UMKM</a></li>
                        <li><a href="#" class="text-white">Petani</a></li>
                        <li><a href="#" class="text-white">Lowongan</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5>Ikuti Kami</h5>
                    <div class="d-flex">
                        <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name') }}. Hak Cipta Dilindungi.</p>
                </div>
            </div>
        </div>
    </footer>

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