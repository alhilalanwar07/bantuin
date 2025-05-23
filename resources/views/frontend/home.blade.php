@extends('layouts.frontend')

@section('content')
<!-- Hero Section dengan Background Gradient -->
<section class="hero-section mb-5">
    <div class="pattern-overlay"></div>
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 animate-fade-in">
                <h1 class="display-4 fw-bold mb-4">{{ config('app.name') }}</h1>
                <p class="lead mb-4">Sebuah Aplikasi pelayanan publik berbasis digital yang bertujuan memberikan informasi pembangunan kepada masyarakat, layanan pengaduan online serta, media promosi produk lokal.</p>
                <div class="d-flex gap-3 mb-4">
                    <a href="#" class="btn btn-light btn-lg"><i class="fab fa-google-play me-2"></i>Download Aplikasi</a>
                    <a href="#" class="btn btn-outline-light btn-lg">Pelajari Lebih Lanjut</a>
                </div>
            </div>
            <div class="col-lg-6 text-center animate-fade-in delay-2">
                <img src="{{ url('/') }}/assets/img/illustrations/hero.svg" alt="Hero Image" class="img-fluid" style="max-height: 400px;">
            </div>
        </div>
    </div>
</section>

<!-- Mitra Section dengan Animasi -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5 animate-fade-in">
            <h2 class="fw-bold">MITRA</h2>
            <p class="lead">Anda dapat mendaftar sebagai:</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3 animate-fade-in delay-1">
                <div class="card h-100 text-center">
                    <div class="card-body d-flex flex-column">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-store fa-3x mb-3"></i>
                        </div>
                        <h5 class="card-title">Merchant</h5>
                        <p class="card-text flex-grow-1">Daftarkan usaha kuliner Anda dan promosikan ke seluruh pengguna aplikasi.</p>
                        <a href="#" class="btn btn-primary mt-auto">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 animate-fade-in delay-2">
                <div class="card h-100 text-center">
                    <div class="card-body d-flex flex-column">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-shopping-bag fa-3x mb-3"></i>
                        </div>
                        <h5 class="card-title">UMKM</h5>
                        <p class="card-text flex-grow-1">Promosikan produk UMKM Anda dan tingkatkan jangkauan pasar.</p>
                        <a href="#" class="btn btn-primary mt-auto">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 animate-fade-in delay-3">
                <div class="card h-100 text-center">
                    <div class="card-body d-flex flex-column">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-seedling fa-3x mb-3"></i>
                        </div>
                        <h5 class="card-title">Petani</h5>
                        <p class="card-text flex-grow-1">Jual hasil pertanian Anda langsung ke konsumen tanpa perantara.</p>
                        <a href="#" class="btn btn-primary mt-auto">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 animate-fade-in delay-4">
                <div class="card h-100 text-center">
                    <div class="card-body d-flex flex-column">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-briefcase fa-3x mb-3"></i>
                        </div>
                        <h5 class="card-title">Lowongan</h5>
                        <p class="card-text flex-grow-1">Buka lowongan pekerjaan dan temukan kandidat terbaik dari daerah Anda.</p>
                        <a href="#" class="btn btn-primary mt-auto">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tentang Section dengan Card yang Menarik -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="card-body p-md-5">
                <div class="row align-items-center">
                    <div class="col-lg-6 animate-fade-in">
                        <h3 class="fw-bold mb-4">Tentang {{ config('app.name') }}</h3>
                        <p class="lead">{{ config('app.name') }} adalah Sebuah Aplikasi pelayanan publik berbasis digital yang bertujuan memberikan informasi pembangunan kepada masyarakat, layanan pengaduan online serta, media promosi produk lokal.</p>
                        <p>Melalui aplikasi ini, Anda dapat:</p>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item bg-transparent"><i class="fas fa-check-circle text-primary me-2"></i> Mendapatkan informasi terbaru tentang pembangunan di daerah Anda</li>
                            <li class="list-group-item bg-transparent"><i class="fas fa-check-circle text-primary me-2"></i> Melaporkan keluhan atau pengaduan secara online</li>
                            <li class="list-group-item bg-transparent"><i class="fas fa-check-circle text-primary me-2"></i> Mempromosikan produk lokal Anda</li>
                            <li class="list-group-item bg-transparent"><i class="fas fa-check-circle text-primary me-2"></i> Mencari produk-produk lokal berkualitas</li>
                            <li class="list-group-item bg-transparent"><i class="fas fa-check-circle text-primary me-2"></i> Membuka dan mencari lowongan pekerjaan</li>
                        </ul>
                        <p>Bergabunglah dengan {{ config('app.name') }} sekarang dan jadilah bagian dari komunitas digital yang mendukung ekonomi lokal!</p>
                        <div class="mt-4">
                            <a href="#" class="btn btn-primary"><i class="fas fa-download me-2"></i>Download Aplikasi</a>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center animate-fade-in delay-2 d-none d-lg-block">
                        <img src="{{ url('/') }}/assets/img/illustrations/about.svg" alt="About Image" class="img-fluid" style="max-height: 400px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5 animate-fade-in">
            <h2 class="fw-bold">Tanya Jawab</h2>
            <p class="lead">Pertanyaan dan jawaban seputar aplikasi</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="accordion animate-fade-in" id="faqAccordion">
                    <div class="accordion-item border mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <i class="fas fa-question-circle me-2"></i> Apa manfaat {{ config('app.name') }}?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Kami berharap aplikasi {{ config('app.name') }} ini dapat menjadi wadah untuk memperkenalkan produk-produk lokal kepada para pengguna aplikasi.</p>
                                <p>Melalui aplikasi ini produk-produk UMKM, Jajanan Kuliner serta Komoditi Hasil pertanian dan perkebunan dapat lebih dikenal serta dapat meningkatkan penjualan produk serta hasil pertanian dan perkebunan milik masyarakat.</p>
                                <p>Melalui aplikasi ini juga sebagai wadah bagi masyarkat yang ingin mengadukan keluhannya kepada pemerintah.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <i class="fas fa-download me-2"></i> Bagaimana mendapatkan aplikasi {{ config('app.name') }}?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Saat ini aplikasi {{ config('app.name') }} tersedia untuk platform Android.</p>
                                <p>Untuk dapat menggunakannanya kamu cukup menginstallnya melalui Google Play Store atau dengan cara memilih logo Google Play di atas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistik Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5 animate-fade-in">
            <h2 class="fw-bold">Statistik</h2>
            <p class="lead">Aplikasi:</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3 animate-fade-in delay-1">
                <div class="stats-card">
                    <i class="fas fa-store fa-3x text-primary mb-3"></i>
                    <h3 class="card-title">6</h3>
                    <p class="card-text">Merchant</p>
                </div>
            </div>
            <div class="col-md-3 animate-fade-in delay-2">
                <div class="stats-card">
                    <i class="fas fa-shopping-bag fa-3x text-primary mb-3"></i>
                    <h3 class="card-title">11</h3>
                    <p class="card-text">UMKM</p>
                </div>
            </div>
            <div class="col-md-3 animate-fade-in delay-3">
                <div class="stats-card">
                    <i class="fas fa-seedling fa-3x text-primary mb-3"></i>
                    <h3 class="card-title">8</h3>
                    <p class="card-text">Petani</p>
                </div>
            </div>
            <div class="col-md-3 animate-fade-in delay-4">
                <div class="stats-card">
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <h3 class="card-title">24</h3>
                    <p class="card-text">Pengguna</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection