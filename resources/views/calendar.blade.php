<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Schedula - Kalender</title>
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

        .calendar-month {
            text-align: center;
            margin-bottom: 30px;
        }

        .month-title {
            font-size: 24px;
            font-weight: 600;
            color: #666;
            margin-bottom: 20px;
        }

        .calendar-nav {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .nav-arrow {
            width: 40px;
            height: 40px;
            background: #f8f8f8;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: #666;
            transition: all 0.3s ease;
        }

        .nav-arrow:hover {
            background: #5C93C9;
            color: white;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 20px;
        }

        .calendar-day-header {
            background: #f8f8f8;
            padding: 15px;
            text-align: center;
            font-weight: 600;
            color: #666;
            font-size: 14px;
        }

        .calendar-day {
            background: white;
            min-height: 80px;
            padding: 10px;
            position: relative;
            cursor: pointer;
            transition: background-color 0.2s ease;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .calendar-day:hover {
            background: #f9f9f9;
        }

        .calendar-day.other-month {
            background: #f5f5f5;
            color: #ccc;
        }

        .calendar-day.today {
            background: #5C93C9;
            color: white;
        }

        .calendar-day.has-tasks {
            cursor: pointer;
        }

        .calendar-day.has-tasks:hover {
            background: #e8f4fd;
        }

        .day-number {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .task-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            margin: 1px;
            background: #F88CAC; /* Default ke pink */
        }

        .task-dots {
            display: flex;
            flex-wrap: wrap;
            gap: 2px;
        }

        /* Modal */
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

        /* Schedule List Modal */
        .schedule-modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 30px;
            border-radius: 20px;
            width: 600px;
            max-width: 90%;
            max-height: 70vh;
            overflow-y: auto;
        }

        .schedule-item {
            background: #f8f9fa;
            padding: 15px 20px;
            margin-bottom: 15px;
            border-radius: 15px;
            border-left: 5px solid #F88CAC; /* Default ke pink */
            position: relative;
        }

        .schedule-time {
            font-size: 14px;
            color: #666;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .schedule-name {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .schedule-desc {
            font-size: 14px;
            color: #666;
        }

        .no-schedule {
            text-align: center;
            color: #999;
            font-size: 16px;
            padding: 20px;
        }

        .schedule-buttons {
            position: absolute;
            top: 15px;
            right: 20px;
            display: flex;
            gap: 10px;
        }

        .schedule-btn {
            padding: 5px 15px;
            border: none;
            border-radius: 15px;
            background-color: #5C93C9;
            color: white;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .schedule-btn.delete-btn {
            background-color: #dc3545;
        }

        .schedule-btn:hover {
            opacity: 0.9;
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
        
        <div class="menu-item active">
            <div class="menu-icon">
                <img src="{{ asset('images/calendar-navbar.png') }}" alt="Kalender" onerror="this.src='https://via.placeholder.com/55';">
            </div>
            <div class="menu-text">Kalender</div>
        </div>
        
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
            <h1>Kalender</h1>
        </div>
        
        <button class="add-btn" id="add-task-btn">+</button>

        <div class="calendar-month">
            <h2 class="month-title">Mei 2025</h2>
            <div class="calendar-nav">
                <button class="nav-arrow" id="prev-month">‹</button>
                <button class="nav-arrow" id="next-month">›</button>
            </div>
        </div>

        <div class="calendar-grid">
            <!-- Day headers -->
            <div class="calendar-day-header">Min</div>
            <div class="calendar-day-header">Sen</div>
            <div class="calendar-day-header">Sel</div>
            <div class="calendar-day-header">Rab</div>
            <div class="calendar-day-header">Kam</div>
            <div class="calendar-day-header">Jum</div>
            <div class="calendar-day-header">Sab</div>
        </div>
    </div>

    <!-- Modal Popup untuk Add/Edit Task -->
    <div id="task-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modal-title">Tambah Jadwal Baru</h2>
                <button class="close" id="close-task-modal">×</button>
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
                    <label for="task-date">Tanggal</label>
                    <input type="date" id="task-date" name="task-date" required>
                </div>
                
                <div class="form-group">
                    <label for="task-time">Waktu</label>
                    <input type="time" id="task-time" name="task-time" required>
                </div>
                
                <button type="submit" class="submit-btn" id="submit-btn">Tambah Jadwal</button>
            </form>
        </div>
    </div>

    <!-- Modal Popup untuk Schedule List -->
    <div id="schedule-modal" class="modal">
        <div class="schedule-modal-content">
            <div class="modal-header">
                <h2 id="schedule-date-title">Jadwal Hari Ini</h2>
                <button class="close" id="close-schedule-modal">×</button>
            </div>
            <div id="schedule-list">
                <!-- Schedule items will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <script>
    // Initialize tasks from database with error handling
    let tasks = {};
    @php
        // Pastikan $tasks ada, jika tidak set ke koleksi kosong
        $tasks = isset($tasks) ? $tasks : collect([]);
        
        // Format data untuk JSON
        $formattedTasks = $tasks->groupBy('date')->map(function ($dateTasks) {
            return $dateTasks->map(function ($task) {
                return [
                    'id' => $task->id,
                    'name' => $task->title,
                    'description' => $task->description,
                    'time' => $task->time instanceof \Carbon\Carbon ? $task->time->format('H:i') : (string)$task->time,
                    'color' => 'pink', // Default ke pink
                ];
            })->values()->toArray();
        })->toArray();
    @endphp

    try {
        tasks = @json($formattedTasks);
        console.log('Tasks loaded successfully:', tasks);
    } catch (e) {
        console.error('Error parsing tasks:', e);
        tasks = {};
    }

    // Untuk Fungsi Kalender
    const currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();
    
    const months = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    function generateCalendar(month, year) {
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const daysInPrevMonth = new Date(year, month, 0).getDate();
        
        const calendarGrid = document.querySelector('.calendar-grid');
        const monthTitle = document.querySelector('.month-title');
        
        monthTitle.textContent = `${months[month]} ${year}`;
        
        // Hapus hari yang sudah ada
        const existingDays = calendarGrid.querySelectorAll('.calendar-day');
        existingDays.forEach(day => day.remove());
        
        // Tambah Hari terakhir bulan selanjutnya
        for (let i = firstDay - 1; i >= 0; i--) {
            const day = createDayElement(daysInPrevMonth - i, true, year, month - 1);
            calendarGrid.appendChild(day);
        }
        
        // Tambah hari bulan ini
        for (let day = 1; day <= daysInMonth; day++) {
            const dayElement = createDayElement(day, false, year, month);
            calendarGrid.appendChild(dayElement);
        }
        
        // Tambah hari pertama bulan depan
        const totalCells = calendarGrid.children.length - 7; // Subtract headers
        const remainingCells = 42 - totalCells; // 6 rows × 7 days
        for (let day = 1; day <= remainingCells; day++) {
            const dayElement = createDayElement(day, true, year, month + 1);
            calendarGrid.appendChild(dayElement);
        }
    }

    function createDayElement(dayNumber, isOtherMonth, year, month) {
        const dayElement = document.createElement('div');
        dayElement.className = 'calendar-day';
        if (isOtherMonth) dayElement.classList.add('other-month');
        
        // Periksa hariini
        const today = new Date();
        if (!isOtherMonth && dayNumber === today.getDate() && 
            month === today.getMonth() && year === today.getFullYear()) {
            dayElement.classList.add('today');
        }
        
        const dayNumberDiv = document.createElement('div');
        dayNumberDiv.className = 'day-number';
        dayNumberDiv.textContent = dayNumber;
        
        const taskDots = document.createElement('div');
        taskDots.className = 'task-dots';
        
        dayElement.appendChild(dayNumberDiv);
        dayElement.appendChild(taskDots);
        
        // Tambah dot kalau ada jadwal hariini
        const dateKey = `${year}-${String(month + 1).padStart(2, '0')}-${String(dayNumber).padStart(2, '0')}`;
        if (tasks[dateKey]) {
            dayElement.classList.add('has-tasks');
            tasks[dateKey].forEach(task => {
                const dot = document.createElement('div');
                dot.className = `task-dot`;
                taskDots.appendChild(dot);
            });
            
            // Klik untuk menunjukan popup modal jadwal
            dayElement.addEventListener('click', function() {
                showScheduleModal(dateKey, dayNumber, month, year);
            });
        }
        
        return dayElement;
    }

    function showScheduleModal(dateKey, dayNumber, month, year) {
        const scheduleModal = document.getElementById('schedule-modal');
        const scheduleDateTitle = document.getElementById('schedule-date-title');
        const scheduleList = document.getElementById('schedule-list');
        
        const dateStr = `${dayNumber} ${months[month]} ${year}`;
        scheduleDateTitle.textContent = `Jadwal ${dateStr}`;
        
        scheduleList.innerHTML = '';
        
        if (tasks[dateKey] && tasks[dateKey].length > 0) {
            // Urutkan jadwal berdasarkan waktu
            const sortedTasks = tasks[dateKey].sort((a, b) => a.time.localeCompare(b.time));
            
            sortedTasks.forEach(task => {
                const scheduleItem = document.createElement('div');
                scheduleItem.className = `schedule-item`;
                scheduleItem.dataset.id = task.id;
                
                scheduleItem.innerHTML = `
                    <div class="schedule-time">${task.time}</div>
                    <div class="schedule-name">${task.name}</div>
                    <div class="schedule-desc">${task.description}</div>
                    <div class="schedule-buttons">
                        <button class="schedule-btn edit-btn">Edit</button>
                        <button class="schedule-btn delete-btn">Hapus</button>
                    </div>
                `;
                
                scheduleList.appendChild(scheduleItem);

                const editBtn = scheduleItem.querySelector('.edit-btn');
                const deleteBtn = scheduleItem.querySelector('.delete-btn');

                editBtn.addEventListener('click', () => handleEditClick(task, dateKey));
                deleteBtn.addEventListener('click', () => handleDeleteClick(task.id, dateKey));
            });
        } else {
            scheduleList.innerHTML = '<div class="no-schedule">Tidak ada jadwal untuk hari ini</div>';
        }
        
        scheduleModal.style.display = 'block';
    }

    function handleEditClick(task, dateKey) {
        const taskModal = document.getElementById('task-modal');
        const modalTitle = document.getElementById('modal-title');
        const submitBtn = document.getElementById('submit-btn');

        // Menentukan nilai form
        document.getElementById('task-id').value = task.id;
        document.getElementById('task-name').value = task.name;
        document.getElementById('task-desc').value = task.description;
        document.getElementById('task-date').value = dateKey;
        document.getElementById('task-time').value = task.time;

        // Modal untuk diedit
        modalTitle.textContent = 'Edit Jadwal';
        submitBtn.textContent = 'Update Jadwal';
        editingTaskId = task.id;
        taskModal.style.display = 'block';

        // Tutup modal jadwal
        document.getElementById('schedule-modal').style.display = 'none';
    }

    function handleDeleteClick(taskId, dateKey) {
        if (!confirm('Apakah Anda yakin ingin menghapus jadwal ini?')) {
            return;
        }

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
                // Hapus jadwal dari objek tasks
                tasks[dateKey] = tasks[dateKey].filter(task => task.id !== taskId);
                if (tasks[dateKey].length === 0) {
                    delete tasks[dateKey];
                }

                // Buat kembali kalender
                generateCalendar(currentMonth, currentYear);

                // Perbarui modal jadwal
                showScheduleModal(dateKey, parseInt(dateKey.split('-')[2]), currentMonth, currentYear);

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

    // Fungsi modal
    const taskModal = document.getElementById('task-modal');
    const scheduleModal = document.getElementById('schedule-modal');
    const addBtn = document.getElementById('add-task-btn');
    const closeTaskBtn = document.getElementById('close-task-modal');
    const closeScheduleBtn = document.getElementById('close-schedule-modal');
    const taskForm = document.getElementById('task-form');
    let editingTaskId = null;

    addBtn.addEventListener('click', function() {
        resetModal();
        taskModal.style.display = 'block';
    });

    closeTaskBtn.addEventListener('click', function() {
        taskModal.style.display = 'none';
    });

    closeScheduleBtn.addEventListener('click', function() {
        scheduleModal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === taskModal) {
            taskModal.style.display = 'none';
        }
        if (event.target === scheduleModal) {
            scheduleModal.style.display = 'none';
        }
    });

    function resetModal() {
        taskForm.reset();
        document.getElementById('task-id').value = '';
        const modalTitle = document.getElementById('modal-title');
        const submitBtn = document.getElementById('submit-btn');
        modalTitle.textContent = 'Tambah Jadwal Baru';
        submitBtn.textContent = 'Tambah Jadwal';
        editingTaskId = null;
        document.getElementById('task-date').value = '{{ now()->toDateString() }}'; // Set default to today
    }

    // Form pengisian dengan AJAX
    taskForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const taskId = document.getElementById('task-id').value;
        const taskName = document.getElementById('task-name').value;
        const taskDesc = document.getElementById('task-desc').value;
        const taskDate = document.getElementById('task-date').value;
        const taskTime = document.getElementById('task-time').value;

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
                const taskData = {
                    id: data.task.id,
                    name: data.task.title,
                    description: data.task.description,
                    time: data.task.time,
                    color: 'pink' // Default ke pink
                };

                if (taskId) {
                    const dateKey = taskDate;
                    tasks[dateKey] = tasks[dateKey].map(task => 
                        task.id === taskId ? taskData : task
                    );
                } else {
                    if (!tasks[taskDate]) {
                        tasks[taskDate] = [];
                    }
                    tasks[taskDate].push(taskData);
                }

                // Tambah task dot baru
                generateCalendar(currentMonth, currentYear);

                alert(data.message);
                taskModal.style.display = 'none';
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

    // Navigasi
    document.getElementById('prev-month').addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        generateCalendar(currentMonth, currentYear);
    });

    document.getElementById('next-month').addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar(currentMonth, currentYear);
    });

    // Inisialisasi Kalender
    generateCalendar(currentMonth, currentYear);
    </script>
</body>
</html>