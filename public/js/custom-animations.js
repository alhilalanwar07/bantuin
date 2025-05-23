/**
 * Custom Animations for Bantuindong Frontend
 */

document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi animasi saat halaman dimuat
    initAnimations();
    
    // Inisialisasi efek hover pada kartu
    initCardHoverEffects();
    
    // Inisialisasi animasi scroll
    initScrollAnimations();
    
    // Navbar fade-in animation
    const navbar = document.getElementById('mainNavbar');
    if (navbar) {
        navbar.style.opacity = 0;
        navbar.style.transition = 'opacity 0.7s ease';
        setTimeout(() => {
            navbar.style.opacity = 1;
        }, 100);
    }
    
    // Animasi fade-in saat section masuk viewport
    const fadeSections = document.querySelectorAll('section, footer');
    const fadeInOnScroll = () => {
        fadeSections.forEach(section => {
            const rect = section.getBoundingClientRect();
            if (rect.top < window.innerHeight - 100) {
                section.classList.add('animate-fade-in');
            }
        });
    };
    window.addEventListener('scroll', fadeInOnScroll);
    window.addEventListener('load', fadeInOnScroll);

    // Efek pulse pada tombol utama (download/cta)
    document.querySelectorAll('.btn-primary, .btn-light').forEach(btn => {
        if (btn.closest('#cta') || btn.closest('.hero-section')) {
            btn.classList.add('btn-pulse');
        }
    });
    
    // Slider kategori layanan (mobile friendly)
    const sliderRow = document.getElementById('categorySliderRow');
    const btnPrev = document.querySelector('.category-prev');
    const btnNext = document.querySelector('.category-next');
    if (sliderRow && btnPrev && btnNext) {
        btnPrev.addEventListener('click', function() {
            sliderRow.scrollBy({ left: -sliderRow.offsetWidth / 2, behavior: 'smooth' });
        });
        btnNext.addEventListener('click', function() {
            sliderRow.scrollBy({ left: sliderRow.offsetWidth / 2, behavior: 'smooth' });
        });
    }
});

/**
 * Inisialisasi animasi dasar
 */
function initAnimations() {
    // Animasi untuk elemen dengan kelas animate-fade-in
    const fadeElements = document.querySelectorAll('.animate-fade-in');
    
    fadeElements.forEach(element => {
        // Pastikan elemen memiliki opacity 0 sebelum animasi dimulai
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        
        // Terapkan animasi dengan delay yang sesuai
        setTimeout(() => {
            element.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, 100);
    });
    
    // Terapkan delay untuk elemen dengan kelas delay-*
    document.querySelectorAll('.delay-1').forEach(el => {
        setTimeout(() => {
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, 200);
    });
    
    document.querySelectorAll('.delay-2').forEach(el => {
        setTimeout(() => {
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, 400);
    });
    
    document.querySelectorAll('.delay-3').forEach(el => {
        setTimeout(() => {
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, 600);
    });
    
    document.querySelectorAll('.delay-4').forEach(el => {
        setTimeout(() => {
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, 800);
    });
}

/**
 * Inisialisasi efek hover pada kartu
 */
function initCardHoverEffects() {
    // Efek hover untuk kartu
    const cards = document.querySelectorAll('.card');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            // Tambahkan kelas untuk efek hover yang lebih halus
            this.classList.add('card-hover');
            
            // Animasi ikon di dalam kartu
            const icon = this.querySelector('.fas, .far, .fab');
            if (icon) {
                icon.style.transition = 'transform 0.5s ease, color 0.5s ease';
                icon.style.transform = 'scale(1.2) translateY(-5px)';
                icon.style.color = 'var(--secondary)';
            }
        });
        
        card.addEventListener('mouseleave', function() {
            // Hapus kelas saat mouse meninggalkan kartu
            this.classList.remove('card-hover');
            
            // Kembalikan ikon ke keadaan semula
            const icon = this.querySelector('.fas, .far, .fab');
            if (icon) {
                icon.style.transform = 'scale(1) translateY(0)';
                icon.style.color = 'var(--primary)';
            }
        });
    });
    
    // Efek hover untuk tombol
    const buttons = document.querySelectorAll('.btn-primary, .btn-outline-primary');
    
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s ease';
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });
}

/**
 * Inisialisasi animasi scroll
 */
function initScrollAnimations() {
    // Deteksi elemen saat scroll
    window.addEventListener('scroll', function() {
        const scrollElements = document.querySelectorAll('.scroll-animate');
        
        scrollElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const elementVisible = 150;
            
            if (elementTop < window.innerHeight - elementVisible) {
                element.classList.add('active');
            }
        });
    });
    
    // Tambahkan efek parallax pada hero section
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        window.addEventListener('scroll', function() {
            const scrollPosition = window.scrollY;
            heroSection.style.backgroundPosition = `center ${scrollPosition * 0.5}px`;
        });
    }
}

// Tambahkan efek ripple pada tombol
const buttons = document.querySelectorAll('.btn');
buttons.forEach(button => {
    button.addEventListener('click', function(e) {
        const x = e.clientX - e.target.getBoundingClientRect().left;
        const y = e.clientY - e.target.getBoundingClientRect().top;
        
        const ripple = document.createElement('span');
        ripple.classList.add('ripple-effect');
        ripple.style.left = `${x}px`;
        ripple.style.top = `${y}px`;
        
        this.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
});

// Tambahkan efek counter untuk statistik
function animateCounter(element, target, duration) {
    let start = 0;
    const increment = target > 0 ? 1 : 0;
    const stepTime = Math.abs(Math.floor(duration / target));
    
    const timer = setInterval(() => {
        start += increment;
        element.textContent = start;
        if (start >= target) {
            element.textContent = target;
            clearInterval(timer);
        }
    }, stepTime);
}

// Inisialisasi counter saat elemen statistik terlihat
const statElements = document.querySelectorAll('.stats-card .card-title');
let animated = false;

function checkIfInView() {
    if (animated) return;
    
    const statsSection = document.querySelector('.stats-card');
    if (!statsSection) return;
    
    const elementTop = statsSection.getBoundingClientRect().top;
    const elementVisible = 150;
    
    if (elementTop < window.innerHeight - elementVisible) {
        statElements.forEach(element => {
            const target = parseInt(element.textContent);
            animateCounter(element, target, 2000);
        });
        animated = true;
    }
}

window.addEventListener('scroll', checkIfInView);
// Periksa juga saat halaman dimuat
window.addEventListener('load', checkIfInView);