<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verified Successfully</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f0ff, #fff0f7);
            min-height: 100vh;
        }
        .verification-container {
            max-width: 600px;
            margin: 80px auto;
        }
        .verification-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(147, 51, 234, 0.2);
            overflow: hidden;
            border: none;
        }
        .success-icon {
            font-size: 80px;
            color: #d946ef;
            animation: pulse 2s infinite;
        }
        .card-header {
            background: linear-gradient(135deg, #8b5cf6, #ec4899);
            color: white;
            font-weight: 600;
            padding: 20px;
            text-align: center;
            font-size: 1.5rem;
        }
        .card-body {
            padding: 40px 30px;
            text-align: center;
            background-color: white;
        }
        .countdown {
            font-size: 24px;
            font-weight: bold;
            color: #8b5cf6;
            margin: 20px 0;
        }
        .btn-primary {
            background: linear-gradient(135deg, #8b5cf6, #ec4899);
            border: none;
            padding: 10px 25px;
            font-weight: 600;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(236, 72, 153, 0.4);
            background: linear-gradient(135deg, #9f75ff, #f472b6);
        }
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #f00;
            animation: confetti-fall 3s linear infinite;
        }
        @keyframes confetti-fall {
            0% {
                transform: translateY(-100px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(600px) rotate(360deg);
                opacity: 0;
            }
        }
        h2 {
            color: #8b5cf6;
            font-weight: 700;
        }
        .lead {
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="verification-container">
        <div class="verification-card card">
            <div class="card-header">
                Email Verification Successful
            </div>
            <div class="card-body">
                <div class="success-icon mb-4">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2 class="mb-3">Congratulations!</h2>
                <p class="lead mb-4">Your email has been successfully verified. Thank you for completing this important step.</p>
                
                <p>You will be redirected to the dashboard in</p>
                <div class="countdown" id="countdown">5</div>
                
                <div class="mt-4">
                    <a href="/dashboard" class="btn btn-primary btn-lg">
                        <i class="fas fa-home me-2"></i> Go to Dashboard Now
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Countdown timer
        let seconds = 5;
        const countdownElement = document.getElementById('countdown');
        
        const countdownTimer = setInterval(() => {
            seconds--;
            countdownElement.textContent = seconds;
            
            if (seconds <= 0) {
                clearInterval(countdownTimer);
                window.location.href = '/dashboard';
            }
        }, 1000);

        // Create confetti effect
        function createConfetti() {
            const colors = ['#8b5cf6', '#ec4899', '#d946ef', '#a855f7', '#f472b6', '#e879f9'];
            
            for (let i = 0; i < 100; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.width = Math.random() * 10 + 5 + 'px';
                confetti.style.height = Math.random() * 10 + 5 + 'px';
                confetti.style.animationDuration = Math.random() * 3 + 2 + 's';
                confetti.style.animationDelay = Math.random() * 5 + 's';
                
                document.body.appendChild(confetti);
                
                // Remove confetti after animation
                setTimeout(() => {
                    confetti.remove();
                }, 5000);
            }
        }
        
        // Run confetti
        createConfetti();
    </script>
</body>
</html>