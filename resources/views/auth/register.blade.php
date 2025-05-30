<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Pastikan CSRF token ada -->
    <title>Schedula - Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* (CSS tetap sama seperti sebelumnya, hanya tambah styling untuk popup jika perlu) */
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
            right: 0;
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
            margin-bottom: 18px;
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
            margin-top: 20px;
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

        /* Loading overlay */
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

        /* Popup Styles */
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
            z-index: 1000;
        }

        .popup {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            width: 400px;
            max-width: 90%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .popup h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 15px;
        }

        .popup p {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }

        .popup button {
            background: linear-gradient(135deg, #F88CAC 0%, #5C93C9 100%);
            border: none;
            color: white;
            padding: 10px 25px;
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
                transform: translateX(30px);
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

        /* Responsive */
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
                right: auto;
                order: 2;
            }
            
            .form-section {
                width: 100%;
                padding: 40px 30px;
                order: 1;
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
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <div class="container">
        <!-- Register Form -->
        <div class="form-section">
            <img src="images/logo.png" alt="Schedula Logo" class="logo">
            <h1 class="form-title">DAFTAR</h1>
            
            <form id="registerForm">
                @csrf
                <div class="form-group">
                    <label class="form-label">Masukkan Nama Anda</label>
                    <input type="text" name="name" placeholder="Nama Anda" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Masukkan Nama Pengguna</label>
                    <input type="text" name="username" placeholder="Nama Pengguna" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Masukkan E-Mail</label>
                    <input type="email" name="email" placeholder="E-Mail Anda" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Buat Password</label>
                    <input type="password" name="password" placeholder="Password (min. 8 karakter)" required>
                </div>
                
                <button type="submit" class="submit-btn">DAFTAR</button>
            </form>
            
            <a href="#" class="switch-link" id="switchToLogin">Sudah Memiliki Akun? Masuk disini</a>
        </div>
        
        <!-- Sliding Blue Panel -->
        <div class="sliding-panel" id="slidingPanel">
            <img src="images/jam-signup.png" alt="Clock" class="clock-image">
            <h1>Don't Just Plan It,<br>Schedula It</h1>
        </div>
    </div>

    <!-- Popup Success -->
    <div class="popup-overlay" id="successPopup" style="display: none;">
        <div class="popup">
            <h2>Pendaftaran Berhasil!</h2>
            <p>Berhasil daftar, silakan masuk.</p>
            <button onclick="closePopupAndRedirect()">Lanjut ke Login</button>
        </div>
    </div>

    <!-- Popup Error -->
    <div class="popup-overlay" id="errorPopup" style="display: none;">
        <div class="popup">
            <h2>Terjadi Kesalahan</h2>
            <p id="errorMessage"></p>
            <button onclick="closeErrorPopup()">Tutup</button>
        </div>
    </div>

    <script>
        // Smooth page transition for switch to login
        document.getElementById('switchToLogin').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('loadingOverlay').style.display = 'flex';
            const panel = document.getElementById('slidingPanel');
            panel.style.transform = 'translateX(-100%)';
            setTimeout(() => {
                window.location.href = '{{ route("login") }}';
            }, 600);
        });

        // Page load animation
        window.addEventListener('load', function() {
            document.getElementById('loadingOverlay').style.display = 'none';
        });

        // Handle form submission via AJAX
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const data = {
                name: formData.get('name'),
                username: formData.get('username'),
                email: formData.get('email'),
                password: formData.get('password'),
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            };

            document.getElementById('loadingOverlay').style.display = 'flex';

            fetch('{{ route("register.post") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Pastikan CSRF dikirim
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
                    document.getElementById('errorMessage').textContent = 'Terjadi Kesalahan, periksa kembali data Anda, data telah digunakan.';
                    document.getElementById('errorPopup').style.display = 'flex';
                }
            })
            .catch(error => {
                document.getElementById('loadingOverlay').style.display = 'none';
                document.getElementById('errorMessage').textContent = 'Terjadi Kesalahan, periksa kembali data Anda, data telah digunakan.';
                document.getElementById('errorPopup').style.display = 'flex';
                console.error('Error:', error);
            });
        });

        // Close popup and redirect to login
        function closePopupAndRedirect() {
            document.getElementById('successPopup').style.display = 'none';
            document.getElementById('loadingOverlay').style.display = 'flex';
            setTimeout(() => {
                window.location.href = '{{ route("login") }}';
            }, 600);
        }

        // Close error popup
        function closeErrorPopup() {
            document.getElementById('errorPopup').style.display = 'none';
        }
    </script>
</body>
</html>