Nama: Tinsari Rauhana
NIM: 2308107010038
Mini Project 4 — Pemrograman Berbasis Web

**Schedula — Aplikasi Manajemen Agenda**

1. Deskripsi
Schedula adalah aplikasi manajemen agenda berbasis web yang memungkinkan pengguna untuk membuat, membaca, memperbarui, dan menghapus (CRUD) jadwal kegiatan. Aplikasi ini dilengkapi dengan fitur autentikasi pengguna dan antarmuka pengguna yang interaktif. Schedula dikembangkan menggunakan framework Laravel dan menggunakan custom CSS untuk styling antarmuka pengguna. Schedula dibuat untuk memenuhi tugas Mini Project 4 mata kuliah Pemrograman Berbasis Web.

2. Fitur Utama
    
    2.1 CRUD
    Pengguna dapat:
    - Membuat, melihat, memperbarui, dan menghapus jadwal kegiatan (agenda).
    - Mengedit dan menyimpan data profil pribadi.
    
    2.2 Autentikasi Pengguna
    - Menyediakan sistem login dan registrasi untuk mengelola akses pengguna.
    
    2.4 Manajemen Profil
    - Pengguna dapat melihat dan memperbarui data profil mereka, termasuk nama, username, email, dan password.
      
    2.3 Validasi Form
    -Setiap form memiliki validasi untuk memastikan data yang dimasukkan valid dan lengkap.
    
    2.4 Database Migration
    Struktur database dibuat secara otomatis melalui Laravel migration. Tabel yang digunakan:
      - users: Menyimpan data pengguna.
      - tasks: Menyimpan data agenda.
    Perintah:
    php artisan migrate
    
    2.5 Database Seeder
      Data awal disiapkan untuk keperluan demo dan testing:
      - UserSeeder: Menambahkan satu pengguna contoh.
      - TaskSeeder: Menambahkan dua jadwal demo untuk pengguna tersebut.
      - DatabaseSeeder: Menjalankan kedua seeder secara berurutan.
    Perintah:
    php artisan db:seed
    
    2.6 Antarmuka Pengguna (UI)
      Desain UI dibuat dengan custom CSS untuk menampilkan tampilan yang interaktif.
    - Halaman Register
      
    ![Halaman Register](https://github.com/tinsarirauhanaa/TinsariRauhana_2308107010038_MiniProject4/blob/main/Schedula%20-%20Register.png?raw=true)

   - Halaman Login
     ![Halaman Login](https://github.com/tinsarirauhanaa/TinsariRauhana_2308107010038_MiniProject4/blob/main/Schedula%20-%20Login.png?raw=true)

    - Halaman Dashboard
     ![Halaman Dashboard](https://github.com/tinsarirauhanaa/TinsariRauhana_2308107010038_MiniProject4/blob/main/Schedula%20-%20Dashboard.png?raw=true)

    - Halaman Kalender
     ![Halaman Kalender](https://github.com/tinsarirauhanaa/TinsariRauhana_2308107010038_MiniProject4/blob/main/Schedula%20-%20Kalenderr.png?raw=true)

    - Halaman Profil
 ![Halaman Profil](https://github.com/tinsarirauhanaa/TinsariRauhana_2308107010038_MiniProject4/blob/main/Schedula%20-%20Profil.png?raw=true)
4. Instalasi Aplikasi
Ikuti langkah-langkah berikut untuk menginstal dan menjalankan aplikasi Schedula:

    3.1 Clone Repository:

   git clone https://github.com/tinsarirauhanaa/TinsariRauhana_2308107010038_MiniProject4.git
   
   cd TinsariRauhana_2308107010038_MiniProject4

    3.2 Install dependensi:
   
    composer install
    
    3.3 Konfigurasi Environment, salin file .env.example menjadi .env:
   
    cp .env.example .env
   
    3.4 Generate aplikasi key:
   
    php artisan key:generate

    3.5 Konfigurasi database di file .env sesuai dengan environment lokal.
   
    3.6 Jalankan migrasi dan seeder:
   
    php artisan migrate --seed
Perintah ini akan menjalankan migrasi untuk membuat tabel users dan tasks, serta mengisi data awal menggunakan seeder UserSeeder dan TaskSeeder.

    3.7 Jalankan Server:
   
    php artisan serve
Akses aplikasi melalui http://localhost:8000

5. Video Penjelasan Aplikasi

Penjelasan mengenai aplikasi Schedula, termasuk presentasi dan demo aplikasi, dapat diakses melalui tautan YouTube berikut:


Kode sumber lengkap dari aplikasi Schedula tersedia di repository GitHub berikut:
https://github.com/tinsarirauhanaa/TinsariRauhana_2308107010038_MiniProject4
