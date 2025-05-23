<?php

use Livewire\Volt\Component;
use App\Models\Rating;

new class extends Component {
    public $featuredRatings;
    public $footerAdded = false;
    public $socialLinks = [
        'facebook' => '#',
        'instagram' => '#',
        'youtube' => '#'
    ];

    public function mount(): void
    {
        $this->loadFeaturedRatings();
    }

    public function loadFeaturedRatings(): void
    {
        $this->featuredRatings = Rating::featured()->get();
    }

    public function refreshTestimonials(): void
    {
        $this->loadFeaturedRatings();
    }

    public function setFooterAdded(): void
    {
        $this->footerAdded = true;
    }
}; ?>
<div>
    <!-- Hero Section -->
    <section class="hero-section py-5 animate-fade-in" id="hero" style="background: linear-gradient(90deg, #a259c6 0%, #f7b2e6 100%); color: #fff;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 fw-bold mb-3" style="color: #fff;">Bantuindong</h1>
                    <h4 class="mb-3" style="color: #fff;">Butuh bantuan? <span style="color:#f7b2e6;">Panggil ahlinya!</span></h4>
                    <p class="lead mb-4" style="color: #fff;">Platform digital untuk mencari jasa profesional dengan cepat, aman, dan terpercaya.</p>
                    <div class="d-flex align-items-center gap-3 mb-3 flex-wrap">
                        <a href="https://play.google.com/store/apps/details?id=com.bantuindong" class="download-link position-relative" target="_blank" rel="noopener" aria-label="Download di Google Play">
                            <img src="{{ asset('assets/img/illustrations/google-play.svg') }}" alt="Google Play" class="download-svg" width="250" />
                            <span class="badge bg-success download-badge">Gratis</span>
                        </a>
                        <span class="download-link position-relative disabled" aria-label="Segera Hadir di App Store" style="pointer-events:none;opacity:0.7;">
                            <img src="{{ asset('assets/img/illustrations/appstore.svg') }}" alt="App Store" class="download-svg" width="250" />
                            <span class="badge bg-secondary download-badge">Segera</span>
                        </span>
                    </div>
                    <div class="mt-2">
                        <span class="fw-bold text-white" style="font-size:1.1rem;"><i class="fas fa-download me-1"></i> Download sekarang, gratis tanpa biaya!</span>
                    </div>
                    <small class="text-white-50">Tersedia di Google Play. App Store segera hadir.</small>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/app-mockup.png') }}" alt="App Mockup" class="img-fluid" style="max-height: 400px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <div class="section-divider"></div>

    <!-- Fitur Unggulan -->
    <section class="py-5 bg-white animate-fade-in rounded-section" id="fitur">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold" style="color:#a259c6;">Fitur Unggulan</h2>
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <i class="fas fa-search-location fa-3x mb-3 text-primary"></i>
                    <h5>Pencarian Jasa Cepat</h5>
                    <p>Cari jasa seperti montir, tukang listrik, teknisi AC, dan lainnya dengan mudah.</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-map-marker-alt fa-3x mb-3 text-success"></i>
                    <h5>Pilih Lokasi & Jadwal</h5>
                    <p>Tentukan lokasi dan waktu sesuai kebutuhan Anda.</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-user-check fa-3x mb-3 text-warning"></i>
                    <h5>Pekerja Profesional</h5>
                    <p>Semua mitra terverifikasi, berpengalaman, dan terpercaya.</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-star fa-3x mb-3 text-info"></i>
                    <h5>Rating & Ulasan</h5>
                    <p>Lihat ulasan dan rating dari pelanggan sebelumnya.</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-wallet fa-3x mb-3 text-danger"></i>
                    <h5>Pembayaran Aman</h5>
                    <p>Pembayaran transparan via aplikasi atau transfer langsung.</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-bolt fa-3x mb-3 text-secondary"></i>
                    <h5>Pesan Sekali, Banyak Solusi</h5>
                    <p>Dari cuci kendaraan, bersih rumah, hingga instalasi listrik — semua tersedia.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- Kategori Layanan -->
    <section class="py-5 bg-light animate-fade-in rounded-section" id="kategori">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold" style="color:#a259c6;">Kategori Layanan</h2>
            <div class="service-category-slider position-relative">
                <button class="btn btn-light btn-sm position-absolute top-50 start-0 translate-middle-y d-none d-md-block category-prev" style="z-index:2;"><i class="fas fa-chevron-left"></i></button>
                <div class="row g-4 justify-content-start flex-nowrap flex-md-wrap overflow-auto" style="scroll-behavior:smooth;" id="categorySliderRow">
                    <div class="col-8 col-sm-6 col-md-3 text-center service-card animate-fade-in delay-1">
                        <i class="fas fa-tools fa-3x mb-2 text-primary"></i>
                        <h6>Montir</h6>
                        <p class="small">Mobil & Motor</p>
                    </div>
                    <div class="col-8 col-sm-6 col-md-3 text-center service-card animate-fade-in delay-2">
                        <i class="fas fa-bolt fa-3x mb-2 text-warning"></i>
                        <h6>Tukang Listrik</h6>
                        <p class="small">Instalasi & Perbaikan</p>
                    </div>
                    <div class="col-8 col-sm-6 col-md-3 text-center service-card animate-fade-in delay-3">
                        <i class="fas fa-paint-roller fa-3x mb-2 text-success"></i>
                        <h6>Tukang Cat</h6>
                        <p class="small">Rumah & Bangunan</p>
                    </div>
                    <div class="col-8 col-sm-6 col-md-3 text-center service-card animate-fade-in delay-4">
                        <i class="fas fa-seedling fa-3x mb-2 text-info"></i>
                        <h6>Jasa Taman</h6>
                        <p class="small">Taman & Kebun</p>
                    </div>
                    <div class="col-8 col-sm-6 col-md-3 text-center service-card animate-fade-in delay-1">
                        <i class="fas fa-broom fa-3x mb-2 text-danger"></i>
                        <h6>Bersih-bersih</h6>
                        <p class="small">Rumah & Kantor</p>
                    </div>
                    <div class="col-8 col-sm-6 col-md-3 text-center service-card animate-fade-in delay-2">
                        <i class="fas fa-snowflake fa-3x mb-2 text-secondary"></i>
                        <h6>Teknisi AC</h6>
                        <p class="small">Service & Instalasi</p>
                    </div>
                    <!-- Tambahkan kategori lain sesuai kebutuhan -->
                </div>
                <button class="btn btn-light btn-sm position-absolute top-50 end-0 translate-middle-y d-none d-md-block category-next" style="z-index:2;"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- Cara Kerja -->
    <section class="py-5 animate-fade-in rounded-section" id="carakerja" style="background: #f7f3fa;">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold" style="color:#a259c6;">Cara Kerja</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4 text-center">
                    <div class="p-4 bg-light rounded shadow-sm h-100">
                        <i class="fas fa-search fa-2x mb-3 text-primary"></i>
                        <h6>Cari & Pilih Jasa</h6>
                        <p class="small">Temukan jasa sesuai kebutuhan Anda.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="p-4 bg-light rounded shadow-sm h-100">
                        <i class="fas fa-calendar-check fa-2x mb-3 text-success"></i>
                        <h6>Tentukan Lokasi & Waktu</h6>
                        <p class="small">Atur lokasi dan jadwal layanan.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="p-4 bg-light rounded shadow-sm h-100">
                        <i class="fas fa-user-cog fa-2x mb-3 text-warning"></i>
                        <h6>Pekerja Datang & Selesai</h6>
                        <p class="small">Pekerja profesional menyelesaikan tugas Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- Testimoni Pengguna -->
    <section class="py-5 bg-white animate-fade-in rounded-section" id="testimoni">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold" style="color:#a259c6;">Testimoni Pengguna</h2>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <img src="{{ asset('images/avatar1.png') }}" alt="User" class="rounded-circle mb-3" width="60">
                            <h6 class="mb-1">Andi S.</h6>
                            <div class="mb-2 text-warning">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="small">"Sangat membantu! Tidak perlu repot cari tukang, semua ada di aplikasi."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <img src="{{ asset('images/avatar2.png') }}" alt="User" class="rounded-circle mb-3" width="60">
                            <h6 class="mb-1">Maya L.</h6>
                            <div class="mb-2 text-warning">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="small">"Pekerjanya ramah dan profesional. Proses booking sangat mudah."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <img src="{{ asset('images/avatar3.png') }}" alt="User" class="rounded-circle mb-3" width="60">
                            <h6 class="mb-1">Rudi T.</h6>
                            <div class="mb-2 text-warning">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="small">"Pembayaran aman, hasil kerja memuaskan. Rekomendasi banget!"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- Ajakan Bertindak (CTA) -->
    <section class="py-5 bg-gradient animate-fade-in rounded-section" id="cta" style="background: linear-gradient(90deg, #a259c6 0%, #f7b2e6 100%);">
        <div class="container text-center">
            <h2 class="fw-bold mb-3 text-white">Siap dibantu?</h2>
            <p class="lead text-white mb-4">Download aplikasi Bantuindong sekarang dan nikmati kemudahan mencari jasa profesional!</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap mb-2">
                <a href="https://play.google.com/store/apps/details?id=com.bantuindong" class="download-link position-relative" target="_blank" rel="noopener" aria-label="Download di Google Play">
                    <img src="{{ asset('assets/img/illustrations/google-play.svg') }}" alt="Google Play" class="download-svg" width="250" />
                    <span class="badge bg-success download-badge">Gratis</span>
                </a>
                <span class="download-link position-relative disabled" aria-label="Segera Hadir di App Store" style="pointer-events:none;opacity:0.7;">
                    <img src="{{ asset('assets/img/illustrations/appstore.svg') }}" alt="App Store" class="download-svg" width="250" />
                    <span class="badge bg-secondary download-badge">Segera</span>
                </span>
            </div>
            <div>
                <span class="fw-bold text-white" style="font-size:1.1rem;"><i class="fas fa-download me-1"></i> Download gratis, tanpa biaya langganan!</span>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- Gabung Jadi Mitra -->
    <section class="py-5 bg-light animate-fade-in rounded-section" id="mitra">
        <div class="container text-center">
            <h2 class="fw-bold mb-3" style="color:#a259c6;">Gabung Jadi Mitra</h2>
            <p class="mb-4">Ingin menambah penghasilan? Daftar sebagai mitra Bantuindong dan dapatkan proyek secara online!</p>
            <a href="#" class="btn btn-primary px-4 py-2">Gabung Jadi Mitra</a>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- FAQ Section -->
    <section class="py-5 bg-white animate-fade-in rounded-section" id="faq">
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
                                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Untuk dapat menggunakannya kamu cukup menginstallnya melalui Google Play Store search dengan kata kunci "{{ config('app.name') }}" atau dengan cara memilih logo Google Play di atas.</li>
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

    <!-- Footer -->
    <footer class="py-4 animate-fade-in" id="kontak" style="background: #2d2d2d;">
        <div class="container">
            <div class="row text-white">
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold" style="color:#f7b2e6;">Bantuindong</h5>
                    <p class="small">Butuh bantuan? Panggil ahlinya!<br>Platform digital jasa profesional.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="fw-bold">Kontak</h6>
                    <p class="small mb-1"><i class="fas fa-envelope me-2"></i> info@bantuindong.com</p>
                    <p class="small mb-1"><i class="fab fa-whatsapp me-2"></i> 0812-3456-7890</p>
                    <p class="small"><i class="fas fa-map-marker-alt me-2"></i> Jakarta, Indonesia</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="fw-bold">Navigasi</h6>
                    <ul class="list-unstyled small">
                        <li><a href="#fitur" class="text-white-50 text-decoration-none">Fitur</a></li>
                        <li><a href="#kategori" class="text-white-50 text-decoration-none">Kategori</a></li>
                        <li><a href="#faq" class="text-white-50 text-decoration-none">FAQ</a></li>
                        <li><a href="#mitra" class="text-white-50 text-decoration-none">Gabung Mitra</a></li>
                    </ul>
                    <div class="mt-2">
                        <a href="#" class="text-white-50 me-2"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white-50 me-2"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-white-50"><i class="fab fa-youtube fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center text-white-50 small mt-3">
                &copy; {{ date('Y') }} Bantuindong. All rights reserved.
            </div>
        </div>
    </footer>
</div>