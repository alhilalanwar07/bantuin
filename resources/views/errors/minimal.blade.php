<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('code') - @yield('title') | BantuinDong</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #a4508b 0%, #f7667f 100%);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }
        .glow {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at 60% 40%, #fff 0%, rgba(164,80,139,0.12) 40%, transparent 80%);
            z-index: 1;
            pointer-events: none;
        }
        .error-container {
            position: relative;
            z-index: 2;
            background: rgba(255,255,255,0.97);
            border-radius: 32px;
            box-shadow: 0 8px 32px rgba(164,80,139,0.13), 0 1.5px 8px rgba(0,0,0,0.07);
            padding: 48px 36px 36px 36px;
            max-width: 420px;
            text-align: center;
        }
        .error-code {
            font-size: 120px;
            font-weight: bold;
            background: linear-gradient(90deg, #a4508b 0%, #f7667f 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
            line-height: 1;
            animation: pulse 2s infinite;
        }
        .error-message {
            font-size: 24px;
            color: #343a40;
            margin: 20px 0;
            font-weight: 600;
        }
        .error-description {
            color: #6c757d;
            margin-bottom: 30px;
            font-size: 1.08rem;
        }
        .back-home {
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
        }
        .back-home:hover {
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
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.8; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="glow"></div>
    <div class="particles" id="particles"></div>
    
    <!-- Floating Icons -->
    <i class="floating-icon fas fa-question" style="top: 15%; left: 10%;"></i>
    <i class="floating-icon fas fa-search" style="top: 25%; right: 15%;"></i>
    <i class="floating-icon fas fa-map-marker-alt" style="bottom: 20%; left: 15%;"></i>
    <i class="floating-icon fas fa-compass" style="bottom: 30%; right: 10%;"></i>
    
    <div class="error-container">
        <h1 class="error-code">@yield('code')</h1>
        <h2 class="error-message">Oops! @yield('message')</h2>
        <p class="error-description">
            @yield('description', 'Halaman yang Anda cari mungkin telah dihapus, namanya berubah, atau sementara tidak tersedia.')
        </p>
        <a href="{{ url('/') }}" class="back-home">
        <i class="fas fa-home"></i>    
        Kembali ke Beranda</a>
    </div>
    
    <script>
        // Simple particle effect
        document.addEventListener('DOMContentLoaded', function() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 30;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.style.position = 'absolute';
                particle.style.width = Math.random() * 10 + 'px';
                particle.style.height = particle.style.width;
                particle.style.background = 'rgba(255, 255, 255, ' + (Math.random() * 0.3) + ')';
                particle.style.borderRadius = '50%';
                particle.style.top = Math.random() * 100 + 'vh';
                particle.style.left = Math.random() * 100 + 'vw';
                particle.style.animation = 'floatIcon ' + (Math.random() * 10 + 5) + 's infinite linear';
                particlesContainer.appendChild(particle);
            }
        });
    </script>
</body>
</html>
