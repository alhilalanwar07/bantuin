<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Verifikasi Tidak Valid | BantuinDong</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/email-verification.css') }}">
    <style>
        body {
            background: linear-gradient(135deg, #f7667f 0%, #a4508b 100%);
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
            background: radial-gradient(circle at 60% 40%, #fff 0%, rgba(247,102,127,0.12) 40%, transparent 80%);
            z-index: 1;
            pointer-events: none;
        }
        .verification-container {
            position: relative;
            z-index: 2;
            background: rgba(255,255,255,0.97);
            border-radius: 32px;
            box-shadow: 0 8px 32px rgba(247,102,127,0.13), 0 1.5px 8px rgba(0,0,0,0.07);
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
        .warning-animation {
            margin-bottom: 24px;
        }
        .warning-icon {
            width: 90px; height: 90px; margin: 0 auto; display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, #f7667f 0%, #a4508b 100%);
            border-radius: 50%;
            box-shadow: 0 2px 12px rgba(247,102,127,0.13);
            animation: shake 1.2s infinite alternate;
        }
        .warning-icon i {
            font-size: 2.8rem;
            color: #fff;
        }
        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-6px); }
            50% { transform: translateX(6px); }
            75% { transform: translateX(-6px); }
            100% { transform: translateX(0); }
        }
        h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #f7667f;
            margin-bottom: 10px;
        }
        p {
            color: #333;
            font-size: 1.08rem;
            margin-bottom: 18px;
        }
        .btn-warning {
            display: inline-block;
            background: linear-gradient(90deg, #f7667f 0%, #a4508b 100%);
            color: #fff;
            font-weight: 600;
            padding: 12px 32px;
            border-radius: 24px;
            font-size: 1.1rem;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(247,102,127,0.12);
            transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
            margin-top: 10px;
        }
        .btn-warning:hover {
            background: linear-gradient(90deg, #a4508b 0%, #f7667f 100%);
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 4px 16px rgba(247,102,127,0.18);
        }
        @media (max-width: 600px) {
            .verification-container {
                padding: 32px 10px 24px 10px;
                max-width: 98vw;
            }
            h1 { font-size: 1.2rem; }
        }
    </style>
</head>
<body>
    <div class="glow"></div>
    <div class="verification-container">
        <div class="warning-animation">
            <div class="warning-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
        </div>
        <h1>Link Verifikasi Tidak Valid</h1>
        <p>Maaf, link verifikasi yang Anda gunakan sudah tidak valid atau kadaluwarsa.<br>Silakan request link verifikasi baru.</p>
        <a href="{{ url('/login') }}" class="btn-warning">
            <i class="fas fa-redo"></i> Login & Request Link Baru
        </a>
    </div>
</body>
</html>
