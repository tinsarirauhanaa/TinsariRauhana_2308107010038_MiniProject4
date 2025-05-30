<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Schedula Dashboard</title>
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

        .header .date {
            font-size: 18px;
            color: #666;
            font-weight: 500;
        }

        .add-btn {
            position: absolute;
            top: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background-color: #5C93C9;
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 24px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(92, 147, 201, 0.3);
        }

        .add-btn:hover {
            background-color: #4A7BA7;
            transform: translateY(-2px);
        }

        .task-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
        }

        .task-item {
            padding: 25px;
            border-radius: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #F88CAC; /* Default ke pink */
        }

        .task-info h3 {
            color: white;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .task-info p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 3px;
        }

        .task-buttons {
            display: flex;
            gap: 10px;
        }

        .task-btn {
            padding: 8px 20px;
            border: none;
            border-radius: 20px;
            background-color: white;
            color: #333;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .task-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
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

        /* Popup Modal */
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

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #E8E8E8;
            border-radius: 10px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
        }

        .form-group textarea {
            height: 100px;
            resize: vertical;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background-color: #5C93C9;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #4A7BA7;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Schedula Logo" class="logo" onerror="this.src='https://via.placeholder.com/140';">
        </div>
        
        <div class="menu-item active">
            <div class="menu-icon">
                <img src="{{ asset('images/dashboard-navbar.png') }}" alt="Dashboard" onerror="this.src='https://via.placeholder.com/55';">
            </div>
            <div class="menu-text">Dashboard</div>
        </div>
        
        <a href="{{ route('calendar') }}" class="menu-item">
            <div class="menu-icon">
                <img src="{{ asset('images/calendar-navbar.png') }}" alt="Kalender" onerror="this.src='https://via.placeholder.com/55';">
            </div>
            <div class="menu-text">Kalender</div>
        </a>
        
        <a href="{{ route('profile') }}" class="menu-item">
            <div class="menu-icon">
                <img src="{{ asset('images/profil-navbar.png') }}" alt="Profil" onerror="this.src='https://via.placeholder.com/55';">
            </div>
            <div class="menu-text">Profil</div>
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <div>
                <h1>Jadwal Hari Ini</h1>
                <div class="date">{{ $today }}</div>
            </div>
        </div>
        
        <button class="add-btn" id="add-task-btn">+</button>
        
        <div class="task-list" id="task-list">
            <!-- Debugging: Tampilkan jumlah task -->
            <p>Jumlah task: {{ count($tasks) }}</p>
            @forelse($tasks as $task)
                <div class="task-item" data-id="{{ $task->id }}" data-date="{{ $task->date }}" data-time="{{ $task->time }}">
                    <div class="task-info">
                        <h3>{{ $task->title }}</h3>
                        <p>{{ $task->description }}</p>
                        <p>{{ \Carbon\Carbon::parse($task->date)->locale('id')->isoFormat('D MMMM YYYY') }} pukul {{ \Carbon\Carbon::parse($task->time)->format('H.i') }}</p>
                    </div>
                    <div class="task-buttons">
                        <button class="task-btn edit-btn">Edit</button>
                        <button class="task-btn delete-btn">Hapus</button>
                    </div>
                </div>
            @empty
                <p>Tidak ada jadwal untuk hari ini.</p>
            @endforelse
        </div>
        
        <div class="scroll-indicator">
            <div class="scroll-arrow up"></div>
            <div class="scroll-arrow down"></div>
        </div>
    </div>

    <!-- Modal Popup untuk Add/Edit Task -->
    <div id="task-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modal-title">Tambah Jadwal Baru</h2>
                <button class="close">×</button>
            </div>
            <form id="task-form">
                @csrf
                <input type="hidden" id="task-id" name="task-id">
                <div class="form-group">
                    <label for="task-name">Nama Jadwal</label>
                    <input type="text" id="task-name" name="task-name" required>
                </div>
                
                <div class="form-group">
                    <label for="task-desc">Deskripsi Singkat</label>
                    <textarea id="task-desc" name="task-desc" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="date">Tanggal</label>
                    <input type="date" id="date" name="date" required>
                </div>
                
                <div class="form-group">
                    <label for="time">Waktu</label>
                    <input type="time" id="time" name="time" required>
                </div>
                
                <button type="submit" class="submit-btn" id="submit-btn">Tambah Jadwal</button>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('task-modal');
        const addBtn = document.getElementById('add-task-btn');
        const closeBtn = document.querySelector('.close');
        const modalTitle = document.getElementById('modal-title');
        const submitBtn = document.getElementById('submit-btn');
        const taskForm = document.getElementById('task-form');
        const taskList = document.getElementById('task-list');
        let editingTaskId = null;

        // Popup untuk menambahkan tugas baru
        addBtn.addEventListener('click', function() {
            resetModal();
            modalTitle.textContent = 'Tambah Jadwal Baru';
            submitBtn.textContent = 'Tambah Jadwal';
            editingTaskId = null;
            modal.style.display = 'block';
        });

        // tutup modal
        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Reset modal
        function resetModal() {
            taskForm.reset();
            document.getElementById('task-id').value = '';
            document.getElementById('date').value = '{{ now()->toDateString() }}'; // Set default to today
        }

        // Untuk menampilkan format tanggal
        function formatDateForDisplay(date) {
            return new Date(date).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        }

        // Untuk menampilkan format waktu
        function formatTimeForDisplay(time) {
            return new Date(`2000-01-01 ${time}`).toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        // Mengatur tombol edit
        function handleEditClick(taskItem) {
            const taskId = taskItem.dataset.id;
            const taskInfo = taskItem.querySelector('.task-info');
            const taskName = taskInfo.querySelector('h3').textContent;
            const taskDesc = taskInfo.querySelectorAll('p')[0].textContent;
            const taskDate = taskItem.dataset.date;
            const taskTime = taskItem.dataset.time;

            // Menentukan nilai form
            document.getElementById('task-id').value = taskId;
            document.getElementById('task-name').value = taskName;
            document.getElementById('task-desc').value = taskDesc;
            document.getElementById('date').value = taskDate;
            document.getElementById('time').value = taskTime;

            // Menentukan modal untuk edit
            modalTitle.textContent = 'Edit Jadwal';
            submitBtn.textContent = 'Update Jadwal';
            editingTaskId = taskId;
            modal.style.display = 'block';
        }

        // Hapus jadwal
        function handleDeleteClick(taskItem) {
            if (!confirm('Apakah Anda yakin ingin menghapus jadwal ini?')) {
                return;
            }

            const taskId = taskItem.dataset.id;

            fetch(`/tasks/${taskId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    taskItem.remove();
                    alert(data.message);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus jadwal: ' + error.message);
            });
        }

        document.querySelectorAll('.task-item').forEach(taskItem => {
            const editBtn = taskItem.querySelector('.edit-btn');
            const deleteBtn = taskItem.querySelector('.delete-btn');

            editBtn.addEventListener('click', () => handleEditClick(taskItem));
            deleteBtn.addEventListener('click', () => handleDeleteClick(taskItem));
        });

        // Form pengisian menggunakan AJAX
        taskForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const taskId = document.getElementById('task-id').value;
            const taskName = document.getElementById('task-name').value;
            const taskDesc = document.getElementById('task-desc').value;
            const taskDate = document.getElementById('date').value;
            const taskTime = document.getElementById('time').value;

            const url = taskId ? `/tasks/${taskId}` : '/tasks';
            const method = taskId ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    task_name: taskName,
                    task_desc: taskDesc,
                    date: taskDate,
                    time: taskTime,
                    color: 'pink', // Warna default pink
                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    if (taskId) {
                        // Perbarui task yang ada
                        const taskItem = document.querySelector(`.task-item[data-id="${taskId}"]`);
                        taskItem.className = `task-item`;
                        taskItem.dataset.date = taskDate;
                        taskItem.dataset.time = taskTime;
                        const taskInfo = taskItem.querySelector('.task-info');
                        taskInfo.innerHTML = `
                            <h3>${taskName}</h3>
                            <p>${taskDesc}</p>
                            <p>${formatDateForDisplay(taskDate)} pukul ${formatTimeForDisplay(taskTime)}</p>
                        `;
                    } else {
                        // Tambah task baru
                        const newTask = document.createElement('div');
                        newTask.className = `task-item`;
                        newTask.dataset.id = data.task.id;
                        newTask.dataset.date = taskDate;
                        newTask.dataset.time = taskTime;
                        newTask.innerHTML = `
                            <div class="task-info">
                                <h3>${taskName}</h3>
                                <p>${taskDesc}</p>
                                <p>${formatDateForDisplay(taskDate)} pukul ${formatTimeForDisplay(taskTime)}</p>
                            </div>
                            <div class="task-buttons">
                                <button class="task-btn edit-btn">Edit</button>
                                <button class="task-btn delete-btn">Hapus</button>
                            </div>
                        `;

                        const editBtn = newTask.querySelector('.edit-btn');
                        const deleteBtn = newTask.querySelector('.delete-btn');
                        editBtn.addEventListener('click', () => handleEditClick(newTask));
                        deleteBtn.addEventListener('click', () => handleDeleteClick(newTask));

                        taskList.appendChild(newTask);
                    }

                    alert(data.message);
                    modal.style.display = 'none';
                    resetModal();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan jadwal: ' + error.message);
            });
        });
    </script>
</body>
</html>