/**
 * Frontend JavaScript for Bantu Indong Application
 */

// Initialize when document is ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[data-scroll][href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if(targetId === '#' || !targetId) return;
            const targetElement = document.querySelector(targetId);
            if(targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Scrollspy: highlight nav-link saat section aktif
    const sections = document.querySelectorAll('section[id], footer[id]');
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link[data-scroll]');
    function activateNavLink() {
        let scrollPos = window.scrollY || window.pageYOffset;
        let offset = 80; // navbar height
        sections.forEach(section => {
            const top = section.offsetTop - offset;
            const bottom = top + section.offsetHeight;
            if (scrollPos >= top && scrollPos < bottom) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + section.id) {
                        link.classList.add('active');
                    }
                });
            }
        });
    }
    window.addEventListener('scroll', activateNavLink);
    window.addEventListener('load', activateNavLink);

    // Initialize Notyf for notifications if available
    if(typeof Notyf !== 'undefined') {
        window.notyf = new Notyf({
            position: {
                x: 'right',
                y: 'top',
            },
            types: [
                {
                    type: 'info',
                    background: '#0d6efd',
                    icon: {
                        className: 'fas fa-info-circle',
                        tagName: 'i',
                        color: '#fff'
                    },
                    dismissible: true
                },
                {
                    type: 'warning',
                    background: '#ffc107',
                    icon: {
                        className: 'fas fa-exclamation-circle',
                        tagName: 'i',
                        color: '#fff'
                    },
                    dismissible: true
                },
                {
                    type: 'error',
                    background: '#dc3545',
                    icon: {
                        className: 'fas fa-exclamation-triangle',
                        tagName: 'i',
                        color: '#fff'
                    },
                    dismissible: true
                },
                {
                    type: 'success',
                    background: '#198754',
                    icon: {
                        className: 'fas fa-check-circle',
                        tagName: 'i',
                        color: '#fff'
                    },
                    dismissible: true
                }
            ]
        });
    }

    // Add active class to current nav item
    const currentLocation = window.location.pathname;
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    navLinks.forEach(link => {
        if(link.getAttribute('href') === currentLocation) {
            link.classList.add('active');
        }
    });

    // Counter animation for statistics
    const statElements = document.querySelectorAll('.card-title');
    statElements.forEach(element => {
        const value = parseInt(element.textContent);
        if(!isNaN(value)) {
            let startValue = 0;
            const duration = 2000;
            const increment = value / (duration / 16);
            const counter = setInterval(() => {
                startValue += increment;
                if(startValue >= value) {
                    element.textContent = value;
                    clearInterval(counter);
                } else {
                    element.textContent = Math.floor(startValue);
                }
            }, 16);
        }
    });
});