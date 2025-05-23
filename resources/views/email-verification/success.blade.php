<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Sukses | BantuinDong</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/email-verification.css') }}">
    <style>
        body.success-page {
            background: linear-gradient(135deg, #a4508b 0%, #f7667f 100%);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .glow {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at 60% 40%, #fff 0%, rgba(164,80,139,0.12) 40%, transparent 80%);
            z-index: 1;
            pointer-events: none;
        }
        .verification-container.success-container {
            position: relative;
            z-index: 2;
            background: rgba(255,255,255,0.97);
            border-radius: 32px;
            box-shadow: 0 8px 32px rgba(164,80,139,0.13), 0 1.5px 8px rgba(0,0,0,0.07);
            padding: 48px 36px 36px 36px;
            max-width: 420px;
            width: 100%;
            text-align: center;
            animation: fadeInUp 1s cubic-bezier(.23,1.01,.32,1) 0.1s both;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .success-animation {
            margin-bottom: 24px;
        }
        .checkmark {
            width: 90px;
            height: 90px;
            display: block;
            margin: 0 auto;
        }
        .checkmark__circle {
            stroke: #a4508b;
            stroke-width: 4;
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            animation: strokeCircle 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }
        .checkmark__check {
            stroke: #f7667f;
            stroke-width: 4;
            stroke-linecap: round;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: strokeCheck 0.4s 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }
        @keyframes strokeCircle {
            to { stroke-dashoffset: 0; }
        }
        @keyframes strokeCheck {
            to { stroke-dashoffset: 0; }
        }
        h1 {
            font-size: 2.1rem;
            font-weight: 700;
            color: #a4508b;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }
        p {
            color: #333;
            font-size: 1.08rem;
            margin-bottom: 18px;
        }
        #countdown {
            font-weight: 600;
            color: #f7667f;
            font-size: 1.2rem;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(90deg, #a4508b 0%, #f7667f 100%);
            color: #fff;
            font-weight: 600;
            padding: 12px 32px;
            border-radius: 24px;
            font-size: 1.1rem;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(164,80,139,0.12);
            transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
            margin-top: 10px;
        }
        .btn:hover {
            background: linear-gradient(90deg, #f7667f 0%, #a4508b 100%);
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 4px 16px rgba(164,80,139,0.18);
        }
        .particles {
            position: absolute;
            top: 0; left: 0; width: 100vw; height: 100vh;
            pointer-events: none;
            z-index: 0;
        }
        .floating-icon {
            position: absolute;
            font-size: 2.2rem;
            opacity: 0.13;
            animation: floatIcon 6s infinite linear;
        }
        @keyframes floatIcon {
            0% { transform: translateY(0) scale(1) rotate(0deg); }
            50% { transform: translateY(-30px) scale(1.1) rotate(10deg); }
            100% { transform: translateY(0) scale(1) rotate(0deg); }
        }
        @media (max-width: 600px) {
            .verification-container.success-container {
                padding: 32px 10px 24px 10px;
                max-width: 98vw;
            }
            h1 { font-size: 1.3rem; }
        }
    </style>
</head>
<body class="success-page">
    <div class="glow"></div>
    <canvas class="particles"></canvas>
    <i class="fas fa-star floating-icon" style="top:10%;left:12%;color:#a4508b;"></i>
    <i class="fas fa-bolt floating-icon" style="top:80%;left:80%;color:#f7667f;"></i>
    <i class="fas fa-heart floating-icon" style="top:60%;left:20%;color:#a4508b;"></i>
    <i class="fas fa-magic floating-icon" style="top:25%;left:75%;color:#f7667f;"></i>
    <div class="verification-container success-container">
        <div class="success-animation">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
            </svg>
        </div>
        <h1>Verifikasi Berhasil! 🎉</h1>
        <p>Akun Anda telah berhasil diverifikasi.<br>Selamat menggunakan layanan <b>BantuinDong</b>!</p>
        <p>Anda akan dialihkan ke aplikasi dalam <span id="countdown">5</span> detik</p>
        <div id="desktop-message" style="display:none;color:#a4508b;font-weight:600;margin-bottom:12px;">
            Anda akan diarahkan ke dashboard web.
        </div>
        <a href="{{ url('/') }}" class="btn">
            Mulai Sekarang <i class="fas fa-arrow-right"></i>
        </a>
        <div style="margin-top:24px;">
            <p style="color:#a4508b;font-weight:600;">Atau buka aplikasi:</p>
            <a href="#" class="btn" onclick="redirectToApp()">
                Buka Aplikasi <i class="fas fa-mobile-alt"></i>
            </a>
        </div>
    </div>
    <script>
        // Konfigurasi Deep Link
        const appDeepLinks = {
            android: {
                uri: 'bantuindong://open',
                store: 'https://play.google.com/store/apps/details?id=com.bantuindong'
            },
            ios: {
                uri: 'bantuindong-ios://open',
                store: 'https://apps.apple.com/id/app/bantuindong/id123456789'
            },
            web: 'https://bantuindong.gardanusa.tech/login'
        };

        // Deteksi platform
        function detectPlatform() {
            const userAgent = navigator.userAgent || navigator.vendor || window.opera;
            if (/android/i.test(userAgent)) return 'android';
            if (/iPad|iPhone|iPod/.test(userAgent)) return 'ios';
            return 'desktop';
        }

        // Redirect logic
        function redirectToApp() {
            const platform = detectPlatform();
            const countdownEl = document.getElementById('countdown');
            const desktopMessage = document.getElementById('desktop-message');

            if (platform === 'desktop') {
                desktopMessage.style.display = 'block';
                countdownEl.style.display = 'none';
                window.location.href = appDeepLinks.web;
                return;
            }

            // Coba buka deep link
            window.location.href = appDeepLinks[platform].uri;
            // Fallback ke app store jika gagal
            setTimeout(() => {
                window.location.href = appDeepLinks[platform].store;
            }, 250);
        }

        // Countdown timer
        let seconds = 5;
        const countdown = setInterval(() => {
            seconds--;
            document.getElementById('countdown').textContent = seconds;
            if (seconds <= 0) {
                clearInterval(countdown);
                redirectToApp();
            }
        }, 1000);

        // Particle effect (tetap seperti sebelumnya)
        const canvas = document.querySelector('.particles');
        const ctx = canvas.getContext('2d');
        let particles = [];
        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();
        function createParticle() {
            const colors = ['#a4508b', '#f7667f', '#fff'];
            return {
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                r: Math.random() * 2.5 + 1.5,
                d: Math.random() * 1.5 + 0.5,
                color: colors[Math.floor(Math.random()*colors.length)],
                alpha: Math.random() * 0.5 + 0.3
            };
        }
        for(let i=0;i<60;i++) particles.push(createParticle());
        function drawParticles() {
            ctx.clearRect(0,0,canvas.width,canvas.height);
            for(let p of particles) {
                ctx.globalAlpha = p.alpha;
                ctx.beginPath();
                ctx.arc(p.x,p.y,p.r,0,2*Math.PI);
                ctx.fillStyle = p.color;
                ctx.fill();
                p.y += p.d;
                if(p.y > canvas.height) {
                    p.x = Math.random()*canvas.width;
                    p.y = -10;
                }
            }
            ctx.globalAlpha = 1;
            requestAnimationFrame(drawParticles);
        }
        drawParticles();
    </script>
</body>
</html>