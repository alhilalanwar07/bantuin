<div>
    <!-- 1. Hero Section -->
    <section class="hero-section py-5 bg-gradient-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-3 fw-bold text-white mb-3">{{ config('app.name') }}</h1>
                    <p class="lead text-white mb-4">Butuh bantuan? Panggil ahlinya!</p>
                    <p class="text-light mb-4">Platform jasa profesional dengan pekerja berpengalaman siap membantu kebutuhan Anda</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-light btn-lg px-4">
                            <img src="{{ asset('assets/img/google-play-badge.png') }}" alt="Google Play" style="height: 40px;">
                        </a>
                        <a href="#" class="btn btn-outline-light btn-lg px-4">
                            <img src="{{ asset('assets/img/app-store-badge.png') }}" alt="App Store" style="height: 40px;">
                        </a>
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                <div class="col-md-6 text-center">
                    <div class="dashboard-preview shadow-lg rounded-4 p-3 bg-white">
                        <img src="{{ asset('assets/img/service-request-preview.png') }}" alt="Preview Antarmuka" class="img-fluid rounded-3">
                        <div class="mt-3">
                            <a href="{{ route('services.index') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-search me-2"></i>Cari Layanan
                            </a>
                        </div>
                    </div>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2025 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
    </section>
    <section class="hero-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 animate__animated animate__fadeInLeft">
                    <h1 class="display-4 fw-bold">{{ config('app.name') }}</h1>
                    <p class="lead fw-bold text-primary">Butuh bantuan? Panggil ahlinya!</p>
                    <p class="mb-4">Aplikasi pelayanan jasa profesional yang menghubungkan Anda dengan para ahli terbaik di bidangnya.</p>
                    <div class="d-flex gap-3 mb-4">
                        <a href="#" class="btn btn-primary btn-lg d-flex align-items-center">
                            <i class="fab fa-google-play me-2"></i> Download di Play Store
                        </a>
                        <a href="#" class="btn btn-outline-primary btn-lg">
                            <i class="fab fa-apple me-2"></i> Segera di App Store
                        </a>
                        @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                <div class="col-md-6 text-center animate__animated animate__fadeInRight">
                    <img src="{{ url('/') }}/assets/img/illustrations/app-mockup.svg" alt="Mockup Aplikasi" class="img-fluid mockup-image">
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
    </section>

    <!-- 2. Kategori Layanan -->
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center mb-5 text-purple">Kategori Layanan</h2>
            <div class="row g-4">
                @foreach([1,2,3,4,5,6] as $category)
                <div class="col-md-4 animate__animated animate__fadeInUp" data-wow-delay="0.{{ $category }}s">
                    <div class="service-card p-4 rounded-3 shadow-sm hover-scale">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-tools text-purple fs-2 me-3"></i>
                            <h5 class="mb-0 text-purple">Kategori Layanan {{ $category }}</h5>
                        </div>
                        <p class="text-muted">Deskripsi singkat layanan profesional dengan kualitas terbaik</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 3. Cara Kerja -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 text-purple">Cara Menggunakan Layanan</h2>
            <div class="row g-4 justify-content-center">
                @foreach(['Pilih Layanan', 'Pilih Profesional', 'Bayar Mudah'] as $index => $step)
                <div class="col-md-4 animate__animated animate__fadeInUp" data-wow-delay="0.{{ $index+1 }}s">
                    <div class="step-card text-center p-4 rounded-3 bg-white">
                        <div class="step-number mb-3">
                            <span class="bg-purple text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px">
                                {{ $index+1 }}
                            </span>
                        </div>
                        <h5 class="text-purple">{{ $step }}</h5>
                        <p class="text-muted mb-0">Deskripsi langkah penggunaan layanan secara detail</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <i class="fas fa-check-circle fa-3x text-primary mb-3"></i>
    <h5>Pilih Jasa</h5>
    <p class="small">Cari sesuai kebutuhan Anda</p>
    @if(!isset($footer_added))
    <!-- 8. Testimoni Pengguna -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
            <div class="row g-4">
                @foreach(App\Models\Rating::featured()->get() as $rating)
                <div class="col-md-4 animate__animated animate__fadeInUp">
                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                            <div>
                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                <small class="text-secondary">{{ $rating->service->name }}</small>
                            </div>
                        </div>
                        <p class="mb-0">"{{ $rating->comment }}"</p>
                        <div class="rating-stars mt-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @php $footer_added = true; @endphp

    <!-- 9. Kontak & Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5>Hubungi Kami</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Sosial Media</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Navigasi Cepat</h5>
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
            </div>
        </div>
    </footer>
</div>
@if(!isset($footer_added))
<!-- 8. Testimoni Pengguna -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
        <div class="row g-4">
            @foreach(App\Models\Rating::featured()->get() as $rating)
            <div class="col-md-4 animate__animated animate__fadeInUp">
                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                        <div>
                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                            <small class="text-secondary">{{ $rating->service->name }}</small>
                        </div>
                    </div>
                    <p class="mb-0">"{{ $rating->comment }}"</p>
                    <div class="rating-stars mt-2">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@php $footer_added = true; @endphp

<!-- 9. Kontak & Footer -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5>Hubungi Kami</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Sosial Media</h5>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Navigasi Cepat</h5>
                <div class="row">
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="text-center">
            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
        </div>
    </div>
</footer>
</div>
<div class="col-md-4 col-lg-2">
    <div class="feature-card p-4">
        <i class="fas fa-map-marker-alt fa-3x text-primary mb-3"></i>
        <h5>Tentukan Lokasi</h5>
        <p class="small">Atur lokasi & waktu</p>
        @if(!isset($footer_added))
        <!-- 8. Testimoni Pengguna -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                <div class="row g-4">
                    @foreach(App\Models\Rating::featured()->get() as $rating)
                    <div class="col-md-4 animate__animated animate__fadeInUp">
                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                </div>
                            </div>
                            <p class="mb-0">"{{ $rating->comment }}"</p>
                            <div class="rating-stars mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @php $footer_added = true; @endphp

        <!-- 9. Kontak & Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5>Hubungi Kami</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Sosial Media</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Navigasi Cepat</h5>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                </div>
            </div>
        </footer>
    </div>
    @if(!isset($footer_added))
    <!-- 8. Testimoni Pengguna -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
            <div class="row g-4">
                @foreach(App\Models\Rating::featured()->get() as $rating)
                <div class="col-md-4 animate__animated animate__fadeInUp">
                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                            <div>
                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                <small class="text-secondary">{{ $rating->service->name }}</small>
                            </div>
                        </div>
                        <p class="mb-0">"{{ $rating->comment }}"</p>
                        <div class="rating-stars mt-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @php $footer_added = true; @endphp

    <!-- 9. Kontak & Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5>Hubungi Kami</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Sosial Media</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Navigasi Cepat</h5>
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
            </div>
        </div>
    </footer>
</div>
<div class="col-md-4 col-lg-2">
    <div class="feature-card p-4">
        <i class="fas fa-users fa-3x text-primary mb-3"></i>
        <h5>Profesional</h5>
        <p class="small">Pekerja berpengalaman</p>
        @if(!isset($footer_added))
        <!-- 8. Testimoni Pengguna -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                <div class="row g-4">
                    @foreach(App\Models\Rating::featured()->get() as $rating)
                    <div class="col-md-4 animate__animated animate__fadeInUp">
                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                </div>
                            </div>
                            <p class="mb-0">"{{ $rating->comment }}"</p>
                            <div class="rating-stars mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @php $footer_added = true; @endphp

        <!-- 9. Kontak & Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5>Hubungi Kami</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Sosial Media</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Navigasi Cepat</h5>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                </div>
            </div>
        </footer>
    </div>
    @if(!isset($footer_added))
    <!-- 8. Testimoni Pengguna -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
            <div class="row g-4">
                @foreach(App\Models\Rating::featured()->get() as $rating)
                <div class="col-md-4 animate__animated animate__fadeInUp">
                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                            <div>
                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                <small class="text-secondary">{{ $rating->service->name }}</small>
                            </div>
                        </div>
                        <p class="mb-0">"{{ $rating->comment }}"</p>
                        <div class="rating-stars mt-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @php $footer_added = true; @endphp

    <!-- 9. Kontak & Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5>Hubungi Kami</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Sosial Media</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Navigasi Cepat</h5>
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
            </div>
        </div>
    </footer>
</div>
@if(!isset($footer_added))
<!-- 8. Testimoni Pengguna -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
        <div class="row g-4">
            @foreach(App\Models\Rating::featured()->get() as $rating)
            <div class="col-md-4 animate__animated animate__fadeInUp">
                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                        <div>
                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                            <small class="text-secondary">{{ $rating->service->name }}</small>
                        </div>
                    </div>
                    <p class="mb-0">"{{ $rating->comment }}"</p>
                    <div class="rating-stars mt-2">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@php $footer_added = true; @endphp

<!-- 9. Kontak & Footer -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5>Hubungi Kami</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Sosial Media</h5>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Navigasi Cepat</h5>
                <div class="row">
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="text-center">
            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
        </div>
    </div>
</footer>
</div>
@if(!isset($footer_added))
<!-- 8. Testimoni Pengguna -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
        <div class="row g-4">
            @foreach(App\Models\Rating::featured()->get() as $rating)
            <div class="col-md-4 animate__animated animate__fadeInUp">
                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                        <div>
                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                            <small class="text-secondary">{{ $rating->service->name }}</small>
                        </div>
                    </div>
                    <p class="mb-0">"{{ $rating->comment }}"</p>
                    <div class="rating-stars mt-2">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@php $footer_added = true; @endphp

<!-- 9. Kontak & Footer -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5>Hubungi Kami</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Sosial Media</h5>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Navigasi Cepat</h5>
                <div class="row">
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="text-center">
            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
        </div>
    </div>
</footer>
</div>
</section>
<div class="container">
    <h2 class="text-center mb-5 section-title">Fitur Unggulan</h2>
    <div class="row g-4 justify-content-center">
        <div class="col-md-4 col-lg-2">
            <div class="feature-card text-center p-3 h-100">
                <div class="icon-wrapper mb-3">
                    <i class="fas fa-list-check fa-2x text-primary"></i>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                <h5>Pilih Jasa Sesuai Kebutuhan</h5>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        <div class="col-md-4 col-lg-2">
            <div class="feature-card text-center p-3 h-100">
                <div class="icon-wrapper mb-3">
                    <i class="fas fa-location-dot fa-2x text-primary"></i>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                <h5>Tentukan Lokasi & Waktu</h5>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        <div class="col-md-4 col-lg-2">
            <div class="feature-card text-center p-3 h-100">
                <div class="icon-wrapper mb-3">
                    <i class="fas fa-toolbox fa-2x text-primary"></i>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                <h5>Pekerja Profesional & Berpengalaman</h5>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        <div class="col-md-4 col-lg-2">
            <div class="feature-card text-center p-3 h-100">
                <div class="icon-wrapper mb-3">
                    <i class="fas fa-star fa-2x text-primary"></i>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                <h5>Sistem Rating & Ulasan</h5>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        <div class="col-md-4 col-lg-2">
            <div class="feature-card text-center p-3 h-100">
                <div class="icon-wrapper mb-3">
                    <i class="fas fa-lock fa-2x text-primary"></i>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                <h5>Pembayaran Aman dan Transparan</h5>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        @if(!isset($footer_added))
        <!-- 8. Testimoni Pengguna -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                <div class="row g-4">
                    @foreach(App\Models\Rating::featured()->get() as $rating)
                    <div class="col-md-4 animate__animated animate__fadeInUp">
                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                </div>
                            </div>
                            <p class="mb-0">"{{ $rating->comment }}"</p>
                            <div class="rating-stars mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @php $footer_added = true; @endphp

        <!-- 9. Kontak & Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5>Hubungi Kami</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Sosial Media</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Navigasi Cepat</h5>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                </div>
            </div>
        </footer>
    </div>
    @if(!isset($footer_added))
    <!-- 8. Testimoni Pengguna -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
            <div class="row g-4">
                @foreach(App\Models\Rating::featured()->get() as $rating)
                <div class="col-md-4 animate__animated animate__fadeInUp">
                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                            <div>
                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                <small class="text-secondary">{{ $rating->service->name }}</small>
                            </div>
                        </div>
                        <p class="mb-0">"{{ $rating->comment }}"</p>
                        <div class="rating-stars mt-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @php $footer_added = true; @endphp

    <!-- 9. Kontak & Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5>Hubungi Kami</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Sosial Media</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Navigasi Cepat</h5>
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
            </div>
        </div>
    </footer>
</div>
</section>

<!-- 5. Testimoni Pengguna -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 section-title">Apa Kata Pengguna?</h2>
        <div class="row g-4 justify-content-center">
            @livewire('frontend.testimoni')
            <div class="col-md-4">
                <div class="testimoni-card p-4 shadow-sm">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('assets/img/avatars/avatar1.png') }}" alt="User Avatar" class="rounded-circle me-3" width="60">
                        <div>
                            <h5 class="mb-0">Budi S.</h5>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                @if(!isset($footer_added))
                                <!-- 8. Testimoni Pengguna -->
                                <section class="py-5 bg-light">
                                    <div class="container">
                                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                        <div class="row g-4">
                                            @foreach(App\Models\Rating::featured()->get() as $rating)
                                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                        <div>
                                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                                        </div>
                                                    </div>
                                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                                    <div class="rating-stars mt-2">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                            @endfor
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </section>

                                @php $footer_added = true; @endphp

                                <!-- 9. Kontak & Footer -->
                                <footer class="bg-dark text-white py-5">
                                    <div class="container">
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <h5>Hubungi Kami</h5>
                                                <ul class="list-unstyled">
                                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <h5>Sosial Media</h5>
                                                <div class="d-flex gap-3">
                                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <h5>Navigasi Cepat</h5>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <ul class="list-unstyled">
                                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-6">
                                                        <ul class="list-unstyled">
                                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-4">
                                        <div class="text-center">
                                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                        </div>
                                    </div>
                                </footer>
                            </div>
                            @if(!isset($footer_added))
                            <!-- 8. Testimoni Pengguna -->
                            <section class="py-5 bg-light">
                                <div class="container">
                                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                    <div class="row g-4">
                                        @foreach(App\Models\Rating::featured()->get() as $rating)
                                        <div class="col-md-4 animate__animated animate__fadeInUp">
                                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                                <div class="d-flex align-items-center mb-3">
                                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                                    </div>
                                                </div>
                                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                                <div class="rating-stars mt-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                        @endfor
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section>

                            @php $footer_added = true; @endphp

                            <!-- 9. Kontak & Footer -->
                            <footer class="bg-dark text-white py-5">
                                <div class="container">
                                    <div class="row g-4">
                                        <div class="col-md-4">
                                            <h5>Hubungi Kami</h5>
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Sosial Media</h5>
                                            <div class="d-flex gap-3">
                                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Navigasi Cepat</h5>
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="list-unstyled">
                                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="list-unstyled">
                                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="text-center">
                                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                    </div>
                                </div>
                            </footer>
                        </div>
                        @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <p class="mb-0">"Pelayanan sangat memuaskan, pekerja datang tepat waktu dan hasil rapi!"</p>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        @if(!isset($footer_added))
        <!-- 8. Testimoni Pengguna -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                <div class="row g-4">
                    @foreach(App\Models\Rating::featured()->get() as $rating)
                    <div class="col-md-4 animate__animated animate__fadeInUp">
                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                </div>
                            </div>
                            <p class="mb-0">"{{ $rating->comment }}"</p>
                            <div class="rating-stars mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @php $footer_added = true; @endphp

        <!-- 9. Kontak & Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5>Hubungi Kami</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Sosial Media</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Navigasi Cepat</h5>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                </div>
            </div>
        </footer>
    </div>
</section>

<!-- 6. Preview Antarmuka -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 section-title">Glimpse Aplikasi</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-3 text-center">
                <div class="screenshot-card shadow-lg">
                    <img src="{{ asset('assets/img/screenshots/home.jpg') }}" alt="Halaman Utama" class="img-fluid">
                    <div class="caption p-3">Halaman Pencarian @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="col-md-6 col-lg-3 text-center">
                <div class="screenshot-card shadow-lg">
                    <img src="{{ asset('assets/img/screenshots/detail.jpg') }}" alt="Detail Layanan" class="img-fluid">
                    <div class="caption p-3">Detail Profil Tukang @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="col-md-6 col-lg-3 text-center">
                <div class="screenshot-card shadow-lg">
                    <img src="{{ asset('assets/img/screenshots/booking.jpg') }}" alt="Proses Booking" class="img-fluid">
                    <div class="caption p-3">Halaman Booking @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="col-md-6 col-lg-3 text-center">
                <div class="screenshot-card shadow-lg">
                    <img src="{{ asset('assets/img/screenshots/profile.jpg') }}" alt="Profil Pengguna" class="img-fluid">
                    <div class="caption p-3">Profil Pengguna @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        @if(!isset($footer_added))
        <!-- 8. Testimoni Pengguna -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                <div class="row g-4">
                    @foreach(App\Models\Rating::featured()->get() as $rating)
                    <div class="col-md-4 animate__animated animate__fadeInUp">
                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                </div>
                            </div>
                            <p class="mb-0">"{{ $rating->comment }}"</p>
                            <div class="rating-stars mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @php $footer_added = true; @endphp

        <!-- 9. Kontak & Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5>Hubungi Kami</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Sosial Media</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Navigasi Cepat</h5>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                </div>
            </div>
        </footer>
    </div>
</section>

<!-- Kategori Layanan -->
<section class="py-5 bg-soft-primary">
    <div class="container">
        <h2 class="text-center mb-5 section-title">Layanan Profesional</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-3">
                <div class="category-card text-center p-4 h-100 hover-scale">
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-car-crash fa-3x text-primary"></i>
                        @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <h5>Montir</h5>
                    <p class="small">Layanan perbaikan mobil & motor profesional</p>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="category-card text-center p-4 h-100 hover-scale">
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-bolt fa-3x text-primary"></i>
                        @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <h5>Tukang Listrik</h5>
                    <p class="small">Pemasangan dan perbaikan instalasi listrik</p>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="category-card text-center p-4 h-100 hover-scale">
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-paint-roller fa-3x text-primary"></i>
                        @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <h5>Tukang Cat</h5>
                    <p class="small">Pengecatan bangunan dan furniture profesional</p>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="category-card text-center p-4 h-100 hover-scale">
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-leaf fa-3x text-primary"></i>
                        @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <h5>Taman & Kebun</h5>
                    <p class="small">Desain dan perawatan taman profesional</p>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        @if(!isset($footer_added))
        <!-- 8. Testimoni Pengguna -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                <div class="row g-4">
                    @foreach(App\Models\Rating::featured()->get() as $rating)
                    <div class="col-md-4 animate__animated animate__fadeInUp">
                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                </div>
                            </div>
                            <p class="mb-0">"{{ $rating->comment }}"</p>
                            <div class="rating-stars mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @php $footer_added = true; @endphp

        <!-- 9. Kontak & Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5>Hubungi Kami</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Sosial Media</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Navigasi Cepat</h5>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                </div>
            </div>
        </footer>
    </div>
</section>
<div class="container">
    <h2 class="text-center mb-5 section-title">Kategori Layanan</h2>
    <div class="row g-4">
        <div class="col-6 col-md-3">
            <div class="service-card text-center p-3 h-100">
                <div class="icon-wrapper mb-3">
                    <i class="fas fa-car-mechanic fa-3x text-primary"></i>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                <h5>Montir</h5>
                <p class="small">Perbaikan mobil & motor oleh teknisi berpengalaman</p>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        <div class="col-6 col-md-3">
            <div class="service-card text-center p-3 h-100">
                <div class="icon-wrapper mb-3">
                    <i class="fas fa-bolt fa-3x text-primary"></i>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                <h5>Tukang Listrik</h5>
                <p class="small">Instalasi dan perbaikan listrik rumah tangga</p>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        <div class="col-6 col-md-3">
            <div class="service-card text-center p-3 h-100">
                <div class="icon-wrapper mb-3">
                    <i class="fas fa-paint-roller fa-3x text-primary"></i>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                <h5>Tukang Cat</h5>
                <p class="small">Pengecatan interior & eksterior dengan hasil profesional</p>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        <div class="col-6 col-md-3">
            <div class="service-card text-center p-3 h-100">
                <div class="icon-wrapper mb-3">
                    <i class="fas fa-leaf fa-3x text-primary"></i>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                <h5>Jasa Taman & Kebun</h5>
                <p class="small">Perawatan taman dan kebun oleh ahli pertamanan</p>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        @if(!isset($footer_added))
        <!-- 8. Testimoni Pengguna -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                <div class="row g-4">
                    @foreach(App\Models\Rating::featured()->get() as $rating)
                    <div class="col-md-4 animate__animated animate__fadeInUp">
                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                </div>
                            </div>
                            <p class="mb-0">"{{ $rating->comment }}"</p>
                            <div class="rating-stars mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @php $footer_added = true; @endphp

        <!-- 9. Kontak & Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5>Hubungi Kami</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Sosial Media</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Navigasi Cepat</h5>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                </div>
            </div>
        </footer>
    </div>
    @if(!isset($footer_added))
    <!-- 8. Testimoni Pengguna -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
            <div class="row g-4">
                @foreach(App\Models\Rating::featured()->get() as $rating)
                <div class="col-md-4 animate__animated animate__fadeInUp">
                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                            <div>
                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                <small class="text-secondary">{{ $rating->service->name }}</small>
                            </div>
                        </div>
                        <p class="mb-0">"{{ $rating->comment }}"</p>
                        <div class="rating-stars mt-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @php $footer_added = true; @endphp

    <!-- 9. Kontak & Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5>Hubungi Kami</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Sosial Media</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Navigasi Cepat</h5>
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
            </div>
        </div>
    </footer>
</div>
</section>

<!-- Cara Kerja Aplikasi -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 section-title">Cara Kerja Aplikasi</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="how-it-works-card text-center p-4 h-100">
                    <div class="step-number">1 @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-search fa-3x text-primary"></i>
                        @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <h4>Cari & Pilih Jasa</h4>
                    <p>Pilih kategori layanan yang Anda butuhkan dari berbagai pilihan jasa profesional</p>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="col-md-4">
                <div class="how-it-works-card text-center p-4 h-100">
                    <div class="step-number">2 @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-calendar-check fa-3x text-primary"></i>
                        @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <h4>Tentukan Lokasi & Waktu</h4>
                    <p>Atur jadwal dan lokasi sesuai kebutuhan Anda dengan mudah</p>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="col-md-4">
                <div class="how-it-works-card text-center p-4 h-100">
                    <div class="step-number">3 @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-check-circle fa-3x text-primary"></i>
                        @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <h4>Pekerja Datang & Selesaikan</h4>
                    <p>Pekerja profesional akan datang dan menyelesaikan pekerjaan dengan baik</p>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        @if(!isset($footer_added))
        <!-- 8. Testimoni Pengguna -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                <div class="row g-4">
                    @foreach(App\Models\Rating::featured()->get() as $rating)
                    <div class="col-md-4 animate__animated animate__fadeInUp">
                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                </div>
                            </div>
                            <p class="mb-0">"{{ $rating->comment }}"</p>
                            <div class="rating-stars mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @php $footer_added = true; @endphp

        <!-- 9. Kontak & Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5>Hubungi Kami</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Sosial Media</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Navigasi Cepat</h5>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                </div>
            </div>
        </footer>
    </div>
</section>

<!-- 4. Cara Kerja Aplikasi -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5 section-title">Cara Menggunakan</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="step-card text-center p-4 hover-scale">
                    <div class="step-number">1 @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <i class="fas fa-search fa-3x text-primary mb-3"></i>
                    <h5>Cari & Pilih Jasa</h5>
                    <p class="small">Temukan layanan yang sesuai kebutuhan Anda</p>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="col-md-4">
                <div class="step-card text-center p-4 hover-scale">
                    <div class="step-number">2 @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <i class="fas fa-calendar-check fa-3x text-primary mb-3"></i>
                    <h5>Atur Jadwal</h5>
                    <p class="small">Tentukan lokasi dan waktu yang diinginkan</p>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="col-md-4">
                <div class="step-card text-center p-4 hover-scale">
                    <div class="step-number">3 @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <i class="fas fa-tools fa-3x text-primary mb-3"></i>
                    <h5>Layanan Dimulai</h5>
                    <p class="small">Pekerja datang dan menyelesaikan tugas</p>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        <div class="text-center mt-5">
            <a href="#" class="btn btn-primary btn-lg">
                <i class="fas fa-play-circle me-2"></i>Lihat Demo
            </a>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        @if(!isset($footer_added))
        <!-- 8. Testimoni Pengguna -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                <div class="row g-4">
                    @foreach(App\Models\Rating::featured()->get() as $rating)
                    <div class="col-md-4 animate__animated animate__fadeInUp">
                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                </div>
                            </div>
                            <p class="mb-0">"{{ $rating->comment }}"</p>
                            <div class="rating-stars mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @php $footer_added = true; @endphp

        <!-- 9. Kontak & Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5>Hubungi Kami</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Sosial Media</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Navigasi Cepat</h5>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                </div>
            </div>
        </footer>
    </div>
</section>

<!-- Testimoni Pengguna -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5 section-title">Testimoni Pengguna</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="testimonial-card p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar me-3">
                            <img src="{{ url('/') }}/assets/img/avatars/avatar1.jpg" alt="Avatar" class="rounded-circle">
                            @if(!isset($footer_added))
                            <!-- 8. Testimoni Pengguna -->
                            <section class="py-5 bg-light">
                                <div class="container">
                                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                    <div class="row g-4">
                                        @foreach(App\Models\Rating::featured()->get() as $rating)
                                        <div class="col-md-4 animate__animated animate__fadeInUp">
                                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                                <div class="d-flex align-items-center mb-3">
                                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                                    </div>
                                                </div>
                                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                                <div class="rating-stars mt-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                        @endfor
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section>

                            @php $footer_added = true; @endphp

                            <!-- 9. Kontak & Footer -->
                            <footer class="bg-dark text-white py-5">
                                <div class="container">
                                    <div class="row g-4">
                                        <div class="col-md-4">
                                            <h5>Hubungi Kami</h5>
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Sosial Media</h5>
                                            <div class="d-flex gap-3">
                                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Navigasi Cepat</h5>
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="list-unstyled">
                                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="list-unstyled">
                                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="text-center">
                                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                    </div>
                                </div>
                            </footer>
                        </div>
                        <div>
                            <h5 class="mb-0">Budi S.</h5>
                            <div class="rating text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                @if(!isset($footer_added))
                                <!-- 8. Testimoni Pengguna -->
                                <section class="py-5 bg-light">
                                    <div class="container">
                                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                        <div class="row g-4">
                                            @foreach(App\Models\Rating::featured()->get() as $rating)
                                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                        <div>
                                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                                        </div>
                                                    </div>
                                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                                    <div class="rating-stars mt-2">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                            @endfor
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </section>

                                @php $footer_added = true; @endphp

                                <!-- 9. Kontak & Footer -->
                                <footer class="bg-dark text-white py-5">
                                    <div class="container">
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <h5>Hubungi Kami</h5>
                                                <ul class="list-unstyled">
                                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <h5>Sosial Media</h5>
                                                <div class="d-flex gap-3">
                                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <h5>Navigasi Cepat</h5>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <ul class="list-unstyled">
                                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-6">
                                                        <ul class="list-unstyled">
                                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-4">
                                        <div class="text-center">
                                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                        </div>
                                    </div>
                                </footer>
                            </div>
                            @if(!isset($footer_added))
                            <!-- 8. Testimoni Pengguna -->
                            <section class="py-5 bg-light">
                                <div class="container">
                                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                    <div class="row g-4">
                                        @foreach(App\Models\Rating::featured()->get() as $rating)
                                        <div class="col-md-4 animate__animated animate__fadeInUp">
                                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                                <div class="d-flex align-items-center mb-3">
                                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                                    </div>
                                                </div>
                                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                                <div class="rating-stars mt-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                        @endfor
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section>

                            @php $footer_added = true; @endphp

                            <!-- 9. Kontak & Footer -->
                            <footer class="bg-dark text-white py-5">
                                <div class="container">
                                    <div class="row g-4">
                                        <div class="col-md-4">
                                            <h5>Hubungi Kami</h5>
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Sosial Media</h5>
                                            <div class="d-flex gap-3">
                                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Navigasi Cepat</h5>
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="list-unstyled">
                                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="list-unstyled">
                                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="text-center">
                                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                    </div>
                                </div>
                            </footer>
                        </div>
                        @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <p class="testimonial-text">"Sangat puas dengan layanan montir dari {{ config('app.name') }}. Datang tepat waktu dan masalah motor saya langsung teratasi dengan cepat!"</p>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar me-3">
                            <img src="{{ url('/') }}/assets/img/avatars/avatar2.jpg" alt="Avatar" class="rounded-circle">
                            @if(!isset($footer_added))
                            <!-- 8. Testimoni Pengguna -->
                            <section class="py-5 bg-light">
                                <div class="container">
                                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                    <div class="row g-4">
                                        @foreach(App\Models\Rating::featured()->get() as $rating)
                                        <div class="col-md-4 animate__animated animate__fadeInUp">
                                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                                <div class="d-flex align-items-center mb-3">
                                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                                    </div>
                                                </div>
                                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                                <div class="rating-stars mt-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                        @endfor
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section>

                            @php $footer_added = true; @endphp

                            <!-- 9. Kontak & Footer -->
                            <footer class="bg-dark text-white py-5">
                                <div class="container">
                                    <div class="row g-4">
                                        <div class="col-md-4">
                                            <h5>Hubungi Kami</h5>
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Sosial Media</h5>
                                            <div class="d-flex gap-3">
                                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Navigasi Cepat</h5>
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="list-unstyled">
                                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="list-unstyled">
                                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="text-center">
                                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                    </div>
                                </div>
                            </footer>
                        </div>
                        <div>
                            <h5 class="mb-0">Siti R.</h5>
                            <div class="rating text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                @if(!isset($footer_added))
                                <!-- 8. Testimoni Pengguna -->
                                <section class="py-5 bg-light">
                                    <div class="container">
                                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                        <div class="row g-4">
                                            @foreach(App\Models\Rating::featured()->get() as $rating)
                                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                        <div>
                                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                                        </div>
                                                    </div>
                                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                                    <div class="rating-stars mt-2">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                            @endfor
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </section>

                                @php $footer_added = true; @endphp

                                <!-- 9. Kontak & Footer -->
                                <footer class="bg-dark text-white py-5">
                                    <div class="container">
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <h5>Hubungi Kami</h5>
                                                <ul class="list-unstyled">
                                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <h5>Sosial Media</h5>
                                                <div class="d-flex gap-3">
                                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <h5>Navigasi Cepat</h5>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <ul class="list-unstyled">
                                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-6">
                                                        <ul class="list-unstyled">
                                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-4">
                                        <div class="text-center">
                                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                        </div>
                                    </div>
                                </footer>
                            </div>
                            @if(!isset($footer_added))
                            <!-- 8. Testimoni Pengguna -->
                            <section class="py-5 bg-light">
                                <div class="container">
                                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                    <div class="row g-4">
                                        @foreach(App\Models\Rating::featured()->get() as $rating)
                                        <div class="col-md-4 animate__animated animate__fadeInUp">
                                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                                <div class="d-flex align-items-center mb-3">
                                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                                    </div>
                                                </div>
                                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                                <div class="rating-stars mt-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                        @endfor
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section>

                            @php $footer_added = true; @endphp

                            <!-- 9. Kontak & Footer -->
                            <footer class="bg-dark text-white py-5">
                                <div class="container">
                                    <div class="row g-4">
                                        <div class="col-md-4">
                                            <h5>Hubungi Kami</h5>
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Sosial Media</h5>
                                            <div class="d-flex gap-3">
                                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Navigasi Cepat</h5>
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="list-unstyled">
                                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="list-unstyled">
                                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="text-center">
                                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                    </div>
                                </div>
                            </footer>
                        </div>
                        @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <p class="testimonial-text">"Tukang listrik yang datang sangat profesional dan ramah. Instalasi baru di rumah saya dikerjakan dengan rapi dan aman. Terima kasih {{ config('app.name') }}!"</p>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar me-3">
                            <img src="{{ url('/') }}/assets/img/avatars/avatar3.jpg" alt="Avatar" class="rounded-circle">
                            @if(!isset($footer_added))
                            <!-- 8. Testimoni Pengguna -->
                            <section class="py-5 bg-light">
                                <div class="container">
                                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                    <div class="row g-4">
                                        @foreach(App\Models\Rating::featured()->get() as $rating)
                                        <div class="col-md-4 animate__animated animate__fadeInUp">
                                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                                <div class="d-flex align-items-center mb-3">
                                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                                    </div>
                                                </div>
                                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                                <div class="rating-stars mt-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                        @endfor
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section>

                            @php $footer_added = true; @endphp

                            <!-- 9. Kontak & Footer -->
                            <footer class="bg-dark text-white py-5">
                                <div class="container">
                                    <div class="row g-4">
                                        <div class="col-md-4">
                                            <h5>Hubungi Kami</h5>
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Sosial Media</h5>
                                            <div class="d-flex gap-3">
                                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Navigasi Cepat</h5>
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="list-unstyled">
                                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="list-unstyled">
                                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="text-center">
                                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                    </div>
                                </div>
                            </footer>
                        </div>
                        <div>
                            <h5 class="mb-0">Andi P.</h5>
                            <div class="rating text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                @if(!isset($footer_added))
                                <!-- 8. Testimoni Pengguna -->
                                <section class="py-5 bg-light">
                                    <div class="container">
                                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                        <div class="row g-4">
                                            @foreach(App\Models\Rating::featured()->get() as $rating)
                                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                        <div>
                                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                                        </div>
                                                    </div>
                                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                                    <div class="rating-stars mt-2">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                            @endfor
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </section>

                                @php $footer_added = true; @endphp

                                <!-- 9. Kontak & Footer -->
                                <footer class="bg-dark text-white py-5">
                                    <div class="container">
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <h5>Hubungi Kami</h5>
                                                <ul class="list-unstyled">
                                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <h5>Sosial Media</h5>
                                                <div class="d-flex gap-3">
                                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <h5>Navigasi Cepat</h5>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <ul class="list-unstyled">
                                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-6">
                                                        <ul class="list-unstyled">
                                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-4">
                                        <div class="text-center">
                                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                        </div>
                                    </div>
                                </footer>
                            </div>
                            @if(!isset($footer_added))
                            <!-- 8. Testimoni Pengguna -->
                            <section class="py-5 bg-light">
                                <div class="container">
                                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                    <div class="row g-4">
                                        @foreach(App\Models\Rating::featured()->get() as $rating)
                                        <div class="col-md-4 animate__animated animate__fadeInUp">
                                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                                <div class="d-flex align-items-center mb-3">
                                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                                    </div>
                                                </div>
                                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                                <div class="rating-stars mt-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                        @endfor
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section>

                            @php $footer_added = true; @endphp

                            <!-- 9. Kontak & Footer -->
                            <footer class="bg-dark text-white py-5">
                                <div class="container">
                                    <div class="row g-4">
                                        <div class="col-md-4">
                                            <h5>Hubungi Kami</h5>
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Sosial Media</h5>
                                            <div class="d-flex gap-3">
                                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Navigasi Cepat</h5>
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="list-unstyled">
                                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="list-unstyled">
                                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="text-center">
                                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                    </div>
                                </div>
                            </footer>
                        </div>
                        @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <p class="testimonial-text">"Aplikasi yang sangat membantu! Saya bisa dengan mudah menemukan tukang kebun berkualitas untuk merawat halaman rumah. Hasilnya memuaskan dan harganya transparan."</p>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        @if(!isset($footer_added))
        <!-- 8. Testimoni Pengguna -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                <div class="row g-4">
                    @foreach(App\Models\Rating::featured()->get() as $rating)
                    <div class="col-md-4 animate__animated animate__fadeInUp">
                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                </div>
                            </div>
                            <p class="mb-0">"{{ $rating->comment }}"</p>
                            <div class="rating-stars mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @php $footer_added = true; @endphp

        <!-- 9. Kontak & Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5>Hubungi Kami</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Sosial Media</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Navigasi Cepat</h5>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                </div>
            </div>
        </footer>
    </div>
</section>

<!-- Preview Antarmuka Aplikasi -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 section-title">Preview Antarmuka Aplikasi</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-3">
                <div class="app-preview-card p-2 h-100">
                    <img src="{{ url('/') }}/assets/img/screenshots/screen1.jpg" alt="Halaman Utama" class="img-fluid rounded shadow">
                    <h5 class="mt-3 text-center">Halaman Utama</h5>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="col-6 col-md-3">
                <div class="app-preview-card p-2 h-100">
                    <img src="{{ url('/') }}/assets/img/screenshots/screen2.jpg" alt="Pemilihan Layanan" class="img-fluid rounded shadow">
                    <h5 class="mt-3 text-center">Pemilihan Layanan</h5>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="col-6 col-md-3">
                <div class="app-preview-card p-2 h-100">
                    <img src="{{ url('/') }}/assets/img/screenshots/screen3.jpg" alt="Profil Pekerja" class="img-fluid rounded shadow">
                    <h5 class="mt-3 text-center">Profil Pekerja</h5>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="col-6 col-md-3">
                <div class="app-preview-card p-2 h-100">
                    <img src="{{ url('/') }}/assets/img/screenshots/screen4.jpg" alt="Checkout" class="img-fluid rounded shadow">
                    <h5 class="mt-3 text-center">Checkout</h5>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        @if(!isset($footer_added))
        <!-- 8. Testimoni Pengguna -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                <div class="row g-4">
                    @foreach(App\Models\Rating::featured()->get() as $rating)
                    <div class="col-md-4 animate__animated animate__fadeInUp">
                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                </div>
                            </div>
                            <p class="mb-0">"{{ $rating->comment }}"</p>
                            <div class="rating-stars mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @php $footer_added = true; @endphp

        <!-- 9. Kontak & Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5>Hubungi Kami</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Sosial Media</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Navigasi Cepat</h5>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                </div>
            </div>
        </footer>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 cta-section text-center text-white">
    <div class="container">
        <h2 class="mb-4">Siap Dibantu? Download Sekarang!</h2>
        <div class="d-flex justify-content-center gap-3">
            <a href="#" class="btn btn-light btn-lg d-flex align-items-center">
                <i class="fab fa-google-play me-2"></i> Play Store
            </a>
            <a href="#" class="btn btn-outline-light btn-lg d-flex align-items-center">
                <i class="fab fa-apple me-2"></i> App Store
            </a>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        @if(!isset($footer_added))
        <!-- 8. Testimoni Pengguna -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                <div class="row g-4">
                    @foreach(App\Models\Rating::featured()->get() as $rating)
                    <div class="col-md-4 animate__animated animate__fadeInUp">
                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                </div>
                            </div>
                            <p class="mb-0">"{{ $rating->comment }}"</p>
                            <div class="rating-stars mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @php $footer_added = true; @endphp

        <!-- 9. Kontak & Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5>Hubungi Kami</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Sosial Media</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Navigasi Cepat</h5>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                </div>
            </div>
        </footer>
    </div>
</section>

<!-- 6. Preview Antarmuka -->
<section class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center mb-5 text-purple">Lihat Kemudahan Antarmuka</h2>
        <div class="row g-4 justify-content-center">
            @foreach([1,2,3,4] as $screen)
            <div class="col-md-3 animate__animated animate__fadeInUp" data-aos="zoom-in">
                <div class="screen-card shadow-lg rounded-3 overflow-hidden">
                    <img src="{{ asset('assets/img/screenshots/screen-'.$screen.'.png') }}" alt="Antarmuka Aplikasi" class="img-fluid">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 7. Ajakan Bertindak -->
<section class="py-5 bg-gradient-primary">
    <div class="container text-center">
        <h2 class="text-white mb-4">Siap Dibantu?</h2>
        <p class="lead text-light mb-5">Download aplikasi sekarang dan nikmati kemudahan memesan jasa profesional</p>
        <div class="d-flex gap-3 justify-content-center">
            <a href="#" class="btn btn-light btn-lg px-4 py-3 hover-scale">
                <img src="{{ asset('assets/img/google-play-badge.png') }}" alt="Google Play" style="height: 45px;">
            </a>
            <a href="#" class="btn btn-outline-light btn-lg px-4 py-3 hover-scale">
                <img src="{{ asset('assets/img/app-store-badge.png') }}" alt="App Store" style="height: 45px;">
            </a>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        @if(!isset($footer_added))
        <!-- 8. Testimoni Pengguna -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                <div class="row g-4">
                    @foreach(App\Models\Rating::featured()->get() as $rating)
                    <div class="col-md-4 animate__animated animate__fadeInUp">
                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                </div>
                            </div>
                            <p class="mb-0">"{{ $rating->comment }}"</p>
                            <div class="rating-stars mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @php $footer_added = true; @endphp

        <!-- 9. Kontak & Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5>Hubungi Kami</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Sosial Media</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Navigasi Cepat</h5>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                </div>
            </div>
        </footer>
    </div>
</section>

<!-- 8. Gabung Jadi Mitra -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8 text-center text-md-start">
                <h3 class="mb-3">Bergabunglah Sebagai Mitra Profesional!</h3>
                <p class="lead">Dapatkan penghasilan tambahan dengan menjadi mitra ahli di platform kami</p>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="col-md-4 text-center">
                <a href="{{ route('mitra.daftar') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-handshake me-2"></i>Gabung Sekarang
                </a>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        @if(!isset($footer_added))
        <!-- 8. Testimoni Pengguna -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                <div class="row g-4">
                    @foreach(App\Models\Rating::featured()->get() as $rating)
                    <div class="col-md-4 animate__animated animate__fadeInUp">
                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                </div>
                            </div>
                            <p class="mb-0">"{{ $rating->comment }}"</p>
                            <div class="rating-stars mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @php $footer_added = true; @endphp

        <!-- 9. Kontak & Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5>Hubungi Kami</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Sosial Media</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Navigasi Cepat</h5>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                </div>
            </div>
        </footer>
    </div>
</section>
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h2 class="section-title">Gabung Jadi Mitra</h2>
            <p class="lead">Punya keahlian dan ingin mendapatkan penghasilan tambahan?</p>
            <p>Bergabunglah menjadi mitra {{ config('app.name') }} dan dapatkan akses ke pelanggan potensial di sekitar Anda. Kami menyediakan platform yang aman dan terpercaya untuk menawarkan jasa Anda.</p>
            <ul class="list-unstyled">
                <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Atur jadwal kerja Anda sendiri</li>
                <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Dapatkan pembayaran yang adil dan transparan</li>
                <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Tingkatkan keahlian dan kembangkan bisnis Anda</li>
            </ul>
            <a href="#" class="btn btn-primary btn-lg mt-3">Gabung Jadi Mitra</a>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        <div class="col-md-6 text-center">
            <img src="{{ url('/') }}/assets/img/illustrations/partner.svg" alt="Mitra" class="img-fluid">
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        @if(!isset($footer_added))
        <!-- 8. Testimoni Pengguna -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                <div class="row g-4">
                    @foreach(App\Models\Rating::featured()->get() as $rating)
                    <div class="col-md-4 animate__animated animate__fadeInUp">
                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                </div>
                            </div>
                            <p class="mb-0">"{{ $rating->comment }}"</p>
                            <div class="rating-stars mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @php $footer_added = true; @endphp

        <!-- 9. Kontak & Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5>Hubungi Kami</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Sosial Media</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Navigasi Cepat</h5>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                </div>
            </div>
        </footer>
    </div>
    @if(!isset($footer_added))
    <!-- 8. Testimoni Pengguna -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
            <div class="row g-4">
                @foreach(App\Models\Rating::featured()->get() as $rating)
                <div class="col-md-4 animate__animated animate__fadeInUp">
                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                            <div>
                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                <small class="text-secondary">{{ $rating->service->name }}</small>
                            </div>
                        </div>
                        <p class="mb-0">"{{ $rating->comment }}"</p>
                        <div class="rating-stars mt-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @php $footer_added = true; @endphp

    <!-- 9. Kontak & Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5>Hubungi Kami</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Sosial Media</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Navigasi Cepat</h5>
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
            </div>
        </div>
    </footer>
</div>
</section>

<!-- Kontak & Footer -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="section-title">Hubungi Kami</h2>
                <p>Punya pertanyaan atau masukan? Jangan ragu untuk menghubungi tim kami.</p>
                <ul class="list-unstyled contact-info">
                    <li class="mb-3"><i class="fas fa-envelope text-primary me-2"></i> info@bantuindong.com</li>
                    <li class="mb-3"><i class="fas fa-phone text-primary me-2"></i> +62 812 3456 7890</li>
                    <li class="mb-3"><i class="fas fa-map-marker-alt text-primary me-2"></i> Jl. Contoh No. 123, Jakarta</li>
                </ul>
                <div class="social-media mt-4">
                    <a href="#" class="me-3 text-primary"><i class="fab fa-facebook-f fa-lg"></i></a>
                    <a href="#" class="me-3 text-primary"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="me-3 text-primary"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-primary"><i class="fab fa-youtube fa-lg"></i></a>
                    @if(!isset($footer_added))
                    <!-- 8. Testimoni Pengguna -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                            <div class="row g-4">
                                @foreach(App\Models\Rating::featured()->get() as $rating)
                                <div class="col-md-4 animate__animated animate__fadeInUp">
                                    <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                            <div>
                                                <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                <small class="text-secondary">{{ $rating->service->name }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">"{{ $rating->comment }}"</p>
                                        <div class="rating-stars mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @php $footer_added = true; @endphp

                    <!-- 9. Kontak & Footer -->
                    <footer class="bg-dark text-white py-5">
                        <div class="container">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <h5>Hubungi Kami</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                        <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Sosial Media</h5>
                                    <div class="d-flex gap-3">
                                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Navigasi Cepat</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                            </div>
                        </div>
                    </footer>
                </div>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="col-md-6">
                <form class="contact-form p-4 bg-white rounded shadow-sm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" placeholder="Masukkan nama Anda">
                        @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Masukkan email Anda">
                        @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan</label>
                        <textarea class="form-control" id="message" rows="4" placeholder="Tulis pesan Anda"></textarea>
                        @if(!isset($footer_added))
                        <!-- 8. Testimoni Pengguna -->
                        <section class="py-5 bg-light">
                            <div class="container">
                                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                                <div class="row g-4">
                                    @foreach(App\Models\Rating::featured()->get() as $rating)
                                    <div class="col-md-4 animate__animated animate__fadeInUp">
                                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                                <div>
                                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-0">"{{ $rating->comment }}"</p>
                                            <div class="rating-stars mt-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @php $footer_added = true; @endphp

                        <!-- 9. Kontak & Footer -->
                        <footer class="bg-dark text-white py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5>Hubungi Kami</h5>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Sosial Media</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Navigasi Cepat</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled">
                                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-center">
                                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                </form>
                @if(!isset($footer_added))
                <!-- 8. Testimoni Pengguna -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                        <div class="row g-4">
                            @foreach(App\Models\Rating::featured()->get() as $rating)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                            <small class="text-secondary">{{ $rating->service->name }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"{{ $rating->comment }}"</p>
                                    <div class="rating-stars mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @php $footer_added = true; @endphp

                <!-- 9. Kontak & Footer -->
                <footer class="bg-dark text-white py-5">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h5>Hubungi Kami</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>Sosial Media</h5>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Navigasi Cepat</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            @if(!isset($footer_added))
            <!-- 8. Testimoni Pengguna -->
            <section class="py-5 bg-light">
                <div class="container">
                    <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                    <div class="row g-4">
                        @foreach(App\Models\Rating::featured()->get() as $rating)
                        <div class="col-md-4 animate__animated animate__fadeInUp">
                            <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                    <div>
                                        <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                        <small class="text-secondary">{{ $rating->service->name }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">"{{ $rating->comment }}"</p>
                                <div class="rating-stars mt-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            @php $footer_added = true; @endphp

            <!-- 9. Kontak & Footer -->
            <footer class="bg-dark text-white py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                                <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                                <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Sosial Media</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                    </div>
                </div>
            </footer>
        </div>
        @if(!isset($footer_added))
        <!-- 8. Testimoni Pengguna -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
                <div class="row g-4">
                    @foreach(App\Models\Rating::featured()->get() as $rating)
                    <div class="col-md-4 animate__animated animate__fadeInUp">
                        <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                                    <small class="text-secondary">{{ $rating->service->name }}</small>
                                </div>
                            </div>
                            <p class="mb-0">"{{ $rating->comment }}"</p>
                            <div class="rating-stars mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @php $footer_added = true; @endphp

        <!-- 9. Kontak & Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5>Hubungi Kami</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                            <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                            <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Sosial Media</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Navigasi Cepat</h5>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
                </div>
            </div>
        </footer>
    </div>
</section>
@if(!isset($footer_added))
<!-- 8. Testimoni Pengguna -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 text-purple">Apa Kata Pengguna?</h2>
        <div class="row g-4">
            @foreach(App\Models\Rating::featured()->get() as $rating)
            <div class="col-md-4 animate__animated animate__fadeInUp">
                <div class="testimonial-card p-4 rounded-3 shadow-sm bg-white hover-scale">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $rating->user->profile_photo_url }}" alt="{{ $rating->user->name }}" class="rounded-circle me-3" width="50">
                        <div>
                            <h6 class="mb-0 text-primary">{{ $rating->user->name }}</h6>
                            <small class="text-secondary">{{ $rating->service->name }}</small>
                        </div>
                    </div>
                    <p class="mb-0">"{{ $rating->comment }}"</p>
                    <div class="rating-stars mt-2">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $rating->score ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@php $footer_added = true; @endphp

<!-- 9. Kontak & Footer -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5>Hubungi Kami</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-envelope me-2"></i>hello@bantuindong.id</li>
                    <li><i class="fab fa-whatsapp me-2"></i>+62 812-3456-7890</li>
                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Digital No. 123, Jawa Barat</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Sosial Media</h5>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Navigasi Cepat</h5>
                <div class="row">
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                            <li><a href="#" class="text-white text-decoration-none">Fitur</a></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white text-decoration-none">Kebijakan</a></li>
                            <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="text-center">
            <p class="mb-0">&copy; 2024 {{ config('app.name') }}. All rights reserved</p>
        </div>
    </div>
</footer>
</div>