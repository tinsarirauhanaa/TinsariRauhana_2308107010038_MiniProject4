<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <title>Schedula - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #FFE2F4;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
        }

        .container {
            width: 1000px;
            height: 650px;
            position: relative;
            background: white;
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
        }

        .sliding-panel {
            position: absolute;
            top: 0;
            left: 0;
            width: 50%;
            height: 100%;
            background: linear-gradient(135deg, #91BDE2 0%, #5C93C9 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding: 40px;
            transition: transform 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            z-index: 100;
        }

        .form-section {
            width: 50%;
            padding: 80px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 10;
        }

        .form-section.left {
            margin-left: 50%;
        }

        .logo {
            width: 60px;
            height: 60px;
            margin-bottom: 20px;
        }

        .form-title {
            font-size: 32px;
            font-weight: 700;
            color: #F88CAC;
            margin-bottom: 30px;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .form-group {
            width: 100%;
            margin-bottom: 20px;
            text-align: left;
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #43708D;
            margin-bottom: 8px;
        }

        input {
            background-color: #FFE2F4;
            border: none;
            padding: 15px 20px;
            width: 100%;
            border-radius: 25px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
        }

        input:focus {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(248, 140, 172, 0.3);
        }

        input::placeholder {
            color: #43708D;
            font-weight: 400;
        }

        .submit-btn {
            background: linear-gradient(135deg, #F88CAC 0%, #5C93C9 100%);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 25px;
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 25px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            animation: fadeInUp 0.8s ease-out 0.6s both;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(248, 140, 172, 0.4);
        }

        .switch-link {
            color: #F88CAC;
            font-size: 14px;
            text-decoration: none;
            margin-top: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            animation: fadeInUp 0.8s ease-out 0.8s both;
            cursor: pointer;
            text-align: center;
        }

        .switch-link:hover {
            text-decoration: underline;
            color: #5C93C9;
            transform: translateY(-1px);
        }

        .clock-image {
            width: 120px;
            height: 120px;
            margin-bottom: 30px;
            animation: float 3s ease-in-out infinite;
        }

        .sliding-panel h1 {
            font-size: 32px;
            font-weight: 700;
            line-height: 1.2;
            animation: slideInContent 0.8s ease-out 0.3s both;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 226, 244, 0.95);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #FFE2F4;
            border-top: 5px solid #F88CAC;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }

        .popup {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-out;
        }

        .popup h2 {
            font-size: 24px;
            color: #F88CAC;
            margin-bottom: 15px;
        }

        .popup p {
            font-size: 16px;
            color: #43708D;
            margin-bottom: 20px;
        }

        .popup button {
            background: linear-gradient(135deg, #F88CAC 0%, #5C93C9 100%);
            border: none;
            color: white;
            padding: 10px 30px;
            border-radius: 25px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .popup button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(248, 140, 172, 0.4);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInContent {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 95%;
                height: auto;
                max-width: 400px;
            }
            
            .sliding-panel {
                position: relative;
                width: 100%;
                height: 200px;
                transform: none !important;
            }
            
            .form-section {
                width: 100%;
                padding: 40px 30px;
                margin-left: 0;
            }
            
            .form-section.left {
                margin-left: 0;
            }
            
            .clock-image {
                width: 100px;
                height: 100px;
            }
            
            .sliding-panel h1 {
                font-size: 24px;
            }
            
            .form-title {
                font-size: 28px;
            }

            .popup {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <!-- Popup Sukses -->
    <div class="popup-overlay" id="successPopup">
        <div class="popup">
            <h2>Login Berhasil!</h2>
            <p>Selamat datang di Schedula!</p>
            <button onclick="closePopupAndRedirect()">Lanjut ke Dashboard</button>
        </div>
    </div>

    <!-- Popup Error -->
    <div class="popup-overlay" id="errorPopup" style="display: none;">
        <div class="popup">
            <h2>Login Gagal</h2>
            <p>Periksa kembali data Anda.</p>
            <button onclick="closeErrorPopup()">Tutup</button>
        </div>
    </div>

    <div class="container">
        <div class="sliding-panel" id="slidingPanel">
            <img src="{{ asset('images/jam-signup.png') }}" alt="Clock" class="clock-image">
            <h1>Don't Just Plan It,<br>Schedula It</h1>
        </div>
        
        <div class="form-section left">
            <img src="{{ asset('images/logo.png') }}" alt="Schedula Logo" class="logo">
            <h1 class="form-title">MASUK</h1>
            
            <form id="loginForm">
                @csrf
                <div class="form-group">
                    <label class="form-label">Masukkan Nama Pengguna</label>
                    <input type="text" name="username" placeholder="Nama Pengguna" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Masukkan Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                
                <button type="submit" class="submit-btn">MASUK</button>
            </form>
            
            <a href="#" class="switch-link" id="switchToRegister">Belum Memiliki Akun? Daftar disini</a>
        </div>
    </div>

    <script>
        document.getElementById('switchToRegister').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('loadingOverlay').style.display = 'flex';
            const panel = document.getElementById('slidingPanel');
            panel.style.transform = 'translateX(100%)';
            setTimeout(() => {
                window.location.href = '{{ route("register") }}';
            }, 600);
        });

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('loadingOverlay').style.display = 'flex';

            const formData = new FormData(this);
            const data = {
                username: formData.get('username'),
                password: formData.get('password'),
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            };

            fetch('{{ route("login.post") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('loadingOverlay').style.display = 'none';
                if (data.success) {
                    document.getElementById('successPopup').style.display = 'flex';
                } else {
                    document.getElementById('errorPopup').style.display = 'flex';
                }
            })
            .catch(error => {
                document.getElementById('loadingOverlay').style.display = 'none';
                document.getElementById('errorPopup').style.display = 'flex';
                console.error('Error:', error);
            });
        });

        function closePopupAndRedirect() {
            document.getElementById('successPopup').style.display = 'none';
            document.getElementById('loadingOverlay').style.display = 'flex';
            setTimeout(() => {
                window.location.href = '{{ route("dashboard") }}';
            }, 600);
        }

        function closeErrorPopup() {
            document.getElementById('errorPopup').style.display = 'none';
        }

        window.addEventListener('load', function() {
            document.getElementById('loadingOverlay').style.display = 'none';
        });
    </script>
</body>
</html>