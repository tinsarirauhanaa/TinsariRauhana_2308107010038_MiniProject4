<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Schedula Profil</title>
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
            min-height: 90vh;
            display: flex;
            padding: 20px;
            gap: 20px;
        }

        .sidebar {
            background-color: white;
            border-radius: 20px;
            padding: 25px;
            width: 320px;
            min-height: 90vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .logo {
            width: 140px;
            height: 140px;
            margin-bottom: 20px;
        }

        .logo-icon {
            width: 45px;
            height: 45px;
            background-color: #F88CAC;
            border-radius: 10px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            margin-bottom: 8px;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #666;
        }

        .menu-item.active {
            background-color: #E8E8E8;
            color: #333;
        }

        .menu-item:hover {
            background-color: #F0F0F0;
        }

        .menu-icon {
            width: 55px;
            height: 55px;
        }

        .menu-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .menu-text {
            font-size: 16px;
            font-weight: 500;
        }

        .main-content {
            flex: 1;
            background-color: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 32px;
            font-weight: 700;
            color: #333;
        }

        .profile-content {
            display: flex;
            gap: 30px;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .profile-form {
            max-width: 500px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            flex: 1;
        }

        .clipboard-image {
            width: 500px; 
            height: auto;
            flex-shrink: 0;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-label {
            font-size: 16px;
            font-weight: 600;
            color: #F88CAC;
        }

        .form-input {
            padding: 15px 20px;
            border: 2px solid #E8E8E8;
            border-radius: 10px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            font-weight: 500;
            color: #333;
            background-color: #F8F8F8;
        }

        .form-input:focus {
            outline: none;
            border-color: #5C93C9;
            background-color: white;
        }

        .form-input:disabled {
            background-color: #F0F0F0;
            color: #666;
            cursor: not-allowed;
        }

        .form-input[readonly] {
            background-color: #F8F8F8;
            color: #666;
            cursor: default;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background-color: #5C93C9;
            color: white;
        }

        .btn-edit:hover {
            background-color: #4A7BA7;
            transform: translateY(-1px);
        }

        .btn-logout {
            background-color: #F88CAC;
            color: white;
        }

        .btn-logout:hover {
            background-color: #e07398;
            transform: translateY(-1px);
        }

        .btn-save {
            background-color: #5C93C9;
            color: white;
        }

        .btn-save:hover {
            background-color: #4A7BA7;
            transform: translateY(-1px);
        }

        .btn-cancel {
            background-color: #E8E8E8;
            color: #333;
        }

        .btn-cancel:hover {
            background-color: #D0D0D0;
            transform: translateY(-1px);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 30px;
            border-radius: 20px;
            width: 500px;
            max-width: 90%;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .modal-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }

        .close {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: #999;
        }

        .modal-text {
            font-size: 16px;
            color: #666;
            margin-bottom: 25px;
            text-align: center;
        }

        .modal-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .scroll-indicator {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .scroll-arrow {
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
        }

        .scroll-arrow.up {
            border-bottom: 8px solid #ccc;
        }

        .scroll-arrow.down {
            border-top: 8px solid #ccc;
        }
    </style>
</head>
<body> 
    
<!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Schedula Logo" class="logo" onerror="this.src='https://via.placeholder.com/140';">
        </div>
        
        <a href="{{ route('dashboard') }}" class="menu-item">
            <div class="menu-icon">
                <img src="{{ asset('images/dashboard-navbar.png') }}" alt="Dashboard" onerror="this.src='https://via.placeholder.com/55';">
            </div>
            <div class="menu-text">Dashboard</div>
        </a>
        
        <a href="{{ route('calendar') }}" class="menu-item">
            <div class="menu-icon">
                <img src="{{ asset('images/calendar-navbar.png') }}" alt="Kalender" onerror="this.src='https://via.placeholder.com/55';">
            </div>
            <div class="menu-text">Kalender</div>
        </a>
        
        <div class="menu-item active">
            <div class="menu-icon">
                <img src="{{ asset('images/profil-navbar.png') }}" alt="Profil" onerror="this.src='https://via.placeholder.com/55';">
            </div>
            <div class="menu-text">Profil</div>
        </div>


        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <div>
                <h1>Profil Pengguna</h1>
            </div>
        </div>
        
        <div class="profile-content">
            <div class="profile-form">
                <div class="form-group">
                    <label class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-input" id="nama" value="{{ $user->name }}" readonly>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-input" id="username" value="{{ $user->username }}" readonly>
                </div>
                
                <div class="form-group">
                    <label class="form-label">E-Mail</label>
                    <input type="email" class="form-input" id="email" value="{{ $user->email }}" readonly>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-input" id="password" value="********" readonly>
                </div>
                
                <div class="button-group">
                    <button class="btn btn-edit" id="edit-btn">Edit</button>
                    <button class="btn btn-logout" id="logout-btn">Keluar</button>
                </div>
            </div>
            
            <img src="{{ asset('images/profil-clipboard.png') }}" alt="Clipboard" class="clipboard-image" onerror="this.src='https://via.placeholder.com/500';">
        </div>
        
        <div class="scroll-indicator">
            <div class="scroll-arrow up"></div>
            <div class="scroll-arrow down"></div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div id="edit-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Profil</h2>
                <button class="close" id="close-edit">×</button>
            </div>
            <form id="edit-form">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-input" id="edit-nama" name="name" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-input" id="edit-username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">E-Mail</label>
                    <input type="email" class="form-input" id="edit-email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Password Baru</label>
                    <input type="password" class="form-input" id="edit-password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                </div>
                
                <div class="modal-buttons">
                    <button type="submit" class="btn btn-save">Simpan</button>
                    <button type="button" class="btn btn-cancel" id="cancel-edit">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Logout -->
    <div id="logout-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Konfirmasi Keluar</h2>
                <button class="close" id="close-logout">×</button>
            </div>
            <div class="modal-text">
                Apakah Anda yakin ingin keluar dari akun?
            </div>
            <div class="modal-buttons">
                <button class="btn btn-logout" id="confirm-logout">Ya, Keluar</button>
                <button class="btn btn-cancel" id="cancel-logout">Batal</button>
            </div>
        </div>
    </div>

    <script>
        // Menyimpan nilai asli
        let originalValues = {
            nama: '{{ $user->name }}',
            username: '{{ $user->username }}',
            email: '{{ $user->email }}',
            password: '********'
        };

        // Edit fungsi modal 
        const editBtn = document.getElementById('edit-btn');
        const editModal = document.getElementById('edit-modal');
        const closeEditBtn = document.getElementById('close-edit');
        const cancelEditBtn = document.getElementById('cancel-edit');
        const editForm = document.getElementById('edit-form');

        editBtn.addEventListener('click', function() {

            document.getElementById('edit-nama').value = originalValues.nama;
            document.getElementById('edit-username').value = originalValues.username;
            document.getElementById('edit-email').value = originalValues.email;
            document.getElementById('edit-password').value = '';
            
            editModal.style.display = 'block';
        });

        closeEditBtn.addEventListener('click', function() {
            editModal.style.display = 'none';
        });

        cancelEditBtn.addEventListener('click', function() {
            editModal.style.display = 'none';
        });

        editForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const newNama = document.getElementById('edit-nama').value;
            const newUsername = document.getElementById('edit-username').value;
            const newEmail = document.getElementById('edit-email').value;
            const newPassword = document.getElementById('edit-password').value;

            // Validasi inputan
            if (!newNama || !newUsername || !newEmail) {
                alert('Harap isi semua field yang wajib!');
                return;
            }

            // Perbarui menggunakan AJAX
            fetch('{{ route("profile.update") }}', {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    name: newNama,
                    username: newUsername,
                    email: newEmail,
                    password: newPassword,
                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Perbarui nilai yang tersimpan
                    originalValues.nama = data.user.name;
                    originalValues.username = data.user.username;
                    originalValues.email = data.user.email;
                    
                    document.getElementById('nama').value = data.user.name;
                    document.getElementById('username').value = data.user.username;
                    document.getElementById('email').value = data.user.email;
                    
                    if (newPassword) {
                        originalValues.password = '********';
                        document.getElementById('password').value = '********';
                    }

                    editModal.style.display = 'none';
                    alert(data.message);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memperbarui profil: ' + error.message);
            });
        });

        // Fungsi untuk modal keluar
        const logoutBtn = document.getElementById('logout-btn');
        const logoutModal = document.getElementById('logout-modal');
        const closeLogoutBtn = document.getElementById('close-logout');
        const confirmLogout = document.getElementById('confirm-logout');
        const cancelLogout = document.getElementById('cancel-logout');

        logoutBtn.addEventListener('click', function() {
            logoutModal.style.display = 'block';
        });

        closeLogoutBtn.addEventListener('click', function() {
            logoutModal.style.display = 'none';
        });

        cancelLogout.addEventListener('click', function() {
            logoutModal.style.display = 'none';
        });

        confirmLogout.addEventListener('click', function() {
            document.getElementById('logout-form').submit();
        });

        window.addEventListener('click', function(event) {
            if (event.target === editModal) {
                editModal.style.display = 'none';
            }
            if (event.target === logoutModal) {
                logoutModal.style.display = 'none';
            }
        });
    </script>
</body>
</html>