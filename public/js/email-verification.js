// Common particle creation function
function createParticles(colors) {
    for (let i = 0; i < 30; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + 'vw';
        particle.style.top = Math.random() * 100 + 'vh';
        particle.style.width = Math.random() * 8 + 4 + 'px';
        particle.style.height = particle.style.width;
        particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        particle.style.animationDuration = Math.random() * 3 + 2 + 's';
        particle.style.animationDelay = Math.random() * 5 + 's';
        
        document.body.appendChild(particle);
        
        setTimeout(() => {
            particle.remove();
        }, 5000);
    }
}

// Initialize based on page type
document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    
    if (body.classList.contains('success-page')) {
        // Success page colors and countdown
        const colors = ['#9c27b0', '#e91e63', '#8A2BE2', '#FF69B4'];
        createParticles(colors);
        
        const countdownEl = document.getElementById('countdown');
        if (countdownEl) {
            let timeLeft = 5;
            const timer = setInterval(() => {
                timeLeft--;
                countdownEl.textContent = timeLeft;
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    window.location.href = '/dashboard';
                }
            }, 1000);
        }
    } 
    else if (body.classList.contains('error-page')) {
        // Error page colors
        const colors = ['#FF6B6B', '#FF8E53', '#FFA07A', '#FFB6C1'];
        createParticles(colors);
        
        // Add click animation to error icon
        const icon = document.querySelector('.error-icon');
        if (icon) {
            icon.addEventListener('click', () => {
                icon.style.animation = 'none';
                setTimeout(() => {
                    icon.style.animation = 'shake 0.5s ease-in-out';
                }, 10);
            });
        }
    }
    else if (body.classList.contains('invalid-page')) {
        // Invalid page colors
        const colors = ['#F7B733', '#FC4A1A', '#FFA500', '#FF6347'];
        createParticles(colors);
        
        // Add click animation to warning icon
        const icon = document.querySelector('.warning-icon');
        if (icon) {
            icon.addEventListener('click', () => {
                icon.style.animation = 'none';
                setTimeout(() => {
                    icon.style.animation = 'pulse 2s infinite';
                }, 10);
            });
        }
    }
});
