<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedula - Welcome</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #FFE2F4 0%, #F8BBD9 50%, #5C93C9 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .landing-container {
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        .logo-container {
            position: relative;
            margin-bottom: 30px;
        }

        .logo {
            width: 400px;
            height: 400px;
            opacity: 0;
            transform: scale(0.5) rotate(-180deg);
            animation: logoAnimation 3s ease-in-out forwards;
            filter: drop-shadow(0 10px 30px rgba(0, 0, 0, 0.2));
        }

        .welcome-text {
            opacity: 0;
            transform: translateY(30px);
            animation: textSlideUp 1s ease-out 2s forwards;
        }

        .welcome-text h1 {
            font-size: 3rem;
            color: #ffffff; 
            margin-bottom: 15px;
            font-weight: bold; 
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .welcome-text p {
            font-size: 1.2rem;
            color: #ffffff; 
            margin-bottom: 30px;
            font-weight: bold;
        }

        .loading-bar {
            width: 300px;
            height: 4px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
            margin: 20px auto;
            overflow: hidden;
            opacity: 0;
            animation: fadeIn 0.5s ease-in-out 3.5s forwards;
        }

        .loading-progress {
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, #F88CAC, #5C93C9);
            border-radius: 2px;
            animation: loadingProgress 2s ease-in-out 4s forwards;
        }

        .redirect-text {
            font-size: 0.9rem;
            font-weight: bold;
            color: #ffffff;
            margin-top: 15px;
            opacity: 0;
            animation: fadeIn 0.5s ease-in-out 4.5s forwards;
        }

        /* Animasi partike mengambang */
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) {
            width: 10px;
            height: 10px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            width: 15px;
            height: 15px;
            top: 60%;
            left: 85%;
            animation-delay: 2s;
        }

        .particle:nth-child(3) {
            width: 8px;
            height: 8px;
            top: 80%;
            left: 20%;
            animation-delay: 4s;
        }

        .particle:nth-child(4) {
            width: 12px;
            height: 12px;
            top: 30%;
            left: 80%;
            animation-delay: 1s;
        }

        .particle:nth-child(5) {
            width: 6px;
            height: 6px;
            top: 70%;
            left: 60%;
            animation-delay: 3s;
        }

        /* Animasi menggunakan keyframe */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes logoAnimation {
            0% {
                opacity: 0;
                transform: scale(0.5) rotate(-180deg);
            }
            50% {
                opacity: 1;
                transform: scale(1.2) rotate(0deg);
            }
            70% {
                transform: scale(0.95) rotate(10deg);
            }
            85% {
                transform: scale(1.05) rotate(-5deg);
            }
            100% {
                opacity: 1;
                transform: scale(1) rotate(0deg);
            }
        }

        @keyframes textSlideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes loadingProgress {
            from {
                width: 0%;
            }
            to {
                width: 100%;
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            33% {
                transform: translateY(-20px) rotate(120deg);
            }
            66% {
                transform: translateY(10px) rotate(240deg);
            }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .logo {
                width: 150px;
                height: 150px;
            }
            
            .welcome-text h1 {
                font-size: 2rem;
            }
            
            .welcome-text p {
                font-size: 1rem;
            }
            
            .loading-bar {
                width: 250px;
            }
        }
    </style>
</head>
<body>
    <!-- Partikel mengambang -->
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>

    <div class="landing-container">
        <div class="logo-container">
            <img src="images/logo.png" alt="Schedula Logo" class="logo">
        </div>
        
        <div class="welcome-text">
            <h1>Don't Just Plan It, Schedula It!</h1>
        </div>
        
        <div class="loading-bar">
            <div class="loading-progress"></div>
        </div>
        
        <div class="redirect-text">
            Mengarahkan ke halaman login...
        </div>
    </div>

    <script>
        // Arahkan ke halaman login secara otomatis
        setTimeout(function() {
            window.location.href = '/login'; 
        }, 6000);

        document.addEventListener('click', function() {
            window.location.href = '/login';
        });

        document.addEventListener('keydown', function(event) {
            if (event.code === 'Space') {
                window.location.href = '/login';
            }
        });
    </script>
</body>
</html>