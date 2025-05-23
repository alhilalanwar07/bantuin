/* Navbar Animations for Bantu Indong */

document.addEventListener('DOMContentLoaded', function() {
    // Add animation classes to navbar elements
    const navbarBrand = document.querySelector('.navbar-brand');
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    const searchForm = document.querySelector('.navbar form');
    const navButtons = document.querySelectorAll('.nav-buttons .btn');
    
    // Add animations with slight delay for each element
    if (navbarBrand) {
        navbarBrand.classList.add('animate__animated', 'animate__fadeInDown');
    }
    
    // Animate nav links with delay
    navLinks.forEach((link, index) => {
        link.classList.add('animate__animated', 'animate__fadeInDown');
        link.style.animationDelay = `${0.1 + (index * 0.1)}s`;
    });
    
    // Animate search form
    if (searchForm) {
        searchForm.classList.add('animate__animated', 'animate__fadeInDown');
        searchForm.style.animationDelay = '0.5s';
    }
    
    // Animate buttons
    navButtons.forEach((btn, index) => {
        btn.classList.add('animate__animated', 'animate__fadeInDown');
        btn.style.animationDelay = `${0.6 + (index * 0.1)}s`;
    });
    
    // Add scroll effect to navbar
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.modern-navbar');
        if (navbar) {
            if (window.scrollY > 50) {
                navbar.style.padding = '0.5rem 0';
                navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.15)';
            } else {
                navbar.style.padding = '0.8rem 0';
                navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';
            }
        }
    });
    
    // Add hover effects for nav links
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            const icon = this.querySelector('i');
            if (icon) {
                icon.classList.add('animate__animated', 'animate__heartBeat');
                
                // Remove animation class after it completes
                setTimeout(() => {
                    icon.classList.remove('animate__animated', 'animate__heartBeat');
                }, 1000);
            }
        });
    });
});