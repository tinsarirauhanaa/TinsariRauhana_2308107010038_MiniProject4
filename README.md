Nama: Tinsari Rauhana
NIM: 2308107010038
Mini Project 4 — Pemrograman Berbasis Web

**Schedula — Aplikasi Manajemen Agenda**

1. Deskripsi
Schedula adalah aplikasi manajemen agenda berbasis web yang memungkinkan pengguna untuk membuat, membaca, memperbarui, dan menghapus (CRUD) jadwal kegiatan. Aplikasi ini dilengkapi dengan fitur autentikasi pengguna dan antarmuka pengguna yang interaktif. Schedula dikembangkan menggunakan framework Laravel dan menggunakan custom CSS untuk styling antarmuka pengguna. Schedula dibuat untuk memenuhi tugas Mini Project 4 mata kuliah Pemrograman Berbasis Web.

2. Fitur Utama
    
__2.1 CRUD__
    Pengguna dapat:
    - Membuat, melihat, memperbarui, dan menghapus jadwal kegiatan (agenda).
    - Mengedit dan menyimpan data profil pribadi.
    
__2.2 Autentikasi Pengguna__
    - Menyediakan sistem login dan registrasi untuk mengelola akses pengguna.
    
__2.4 Manajemen Profil__
    - Pengguna dapat melihat dan memperbarui data profil mereka, termasuk nama, username, email, dan password.
      
__2.3 Validasi Form__
    -Setiap form memiliki validasi untuk memastikan data yang dimasukkan valid dan lengkap.
    
__2.4 Database Migration__
    Struktur database dibuat secara otomatis melalui Laravel migration. Tabel yang digunakan:
      - users: Menyimpan data pengguna.
      - tasks: Menyimpan data agenda.
    Perintah:
    php artisan migrate
    
__2.5 Database Seeder__
      Data awal disiapkan untuk keperluan demo dan testing:
      - UserSeeder: Menambahkan satu pengguna contoh.
      - TaskSeeder: Menambahkan dua jadwal demo untuk pengguna tersebut.
      - DatabaseSeeder: Menjalankan kedua seeder secara berurutan.
    Perintah:
    php artisan db:seed
    
__2.6 Antarmuka Pengguna (UI)__
      Desain UI dibuat dengan custom CSS untuk menampilkan tampilan yang interaktif.
   
- Halaman Register
      
   ![Halaman Register](https://github.com/tinsarirauhanaa/TinsariRauhana_2308107010038_MiniProject4/blob/main/Schedula%20-%20Register.png?raw=true)

    Formulir pendaftaran akun baru. Pengguna diminta mengisi nama lengkap, username, email, dan password. Validasi data secara real-time dilakukan untuk menghindari duplikasi atau format yang salah. Setelah berhasil mendaftar, pengguna akan diarahkan ke halaman login.
   
- Halaman Login
   ![Halaman Login](https://github.com/tinsarirauhanaa/TinsariRauhana_2308107010038_MiniProject4/blob/main/Schedula%20-%20Login.png?raw=true)
     
    Menampilkan formulir masuk bagi pengguna yang telah terdaftar. Terdapat validasi input seperti username dan password, serta pesan kesalahan apabila login gagal. Login yang berhasil akan diarahkan ke dashboard pengguna.

- Halaman Dashboard
     ![Halaman Dashboard](https://github.com/tinsarirauhanaa/TinsariRauhana_2308107010038_MiniProject4/blob/main/Schedula%20Dashboard.png)

     Halaman utama setelah login. Menampilkan daftar semua jadwal kegiatan (tasks) hari ini milik pengguna yang sedang login. Terdapat tombol untuk menambah jadwal baru, serta opsi untuk mengedit dan menghapus jadwal yang sudah ada.
   
- Halaman Kalender
     ![Halaman Kalender](https://github.com/tinsarirauhanaa/TinsariRauhana_2308107010038_MiniProject4/blob/main/Schedula%20-%20Kalenderr.png?raw=true)

    Menampilkan kalender bulanan interaktif dengan daftar tanggal. Halaman ini memudahkan pengguna melihat kegiatan dalam tampilan bulanan sekaligus memantau hari-hari yang telah terisi jadwal.

- Tambah Jadwal Baru
    ![Halaman Dashboard](https://github.com/tinsarirauhanaa/TinsariRauhana_2308107010038_MiniProject4/blob/main/Schedula%20_addtask.png)
    Memungkinkan pengguna menambahkan jadwal baru melalui form pop-up yang muncul saat menekan tombol + pada halaman Dashboard atau Kalender. Fitur Tambah Jadwal akan menyimpan data jika semua input valid. Jika ada field yang kosong atau salah format, validasi akan mencegah form disubmit dan memberikan feedback pada pengguna.

- Halaman Profil
     ![Halaman Profil](https://github.com/tinsarirauhanaa/TinsariRauhana_2308107010038_MiniProject4/blob/main/Schedula%20Profil.png)

    Menampilkan data akun pengguna saat ini, seperti nama, username, dan email. Pengguna dapat memperbarui informasi pribadi dan juga mengubah kata sandi. Perubahan akan divalidasi sebelum disimpan. Halaman ini memudahkan pengguna mengelola data akunnya dan keluar dari aplikasi.

- Logout
      ![Halaman Profil](https://github.com/tinsarirauhanaa/TinsariRauhana_2308107010038_MiniProject4/blob/main/SchedulaKeluar.png)
    Tombol logout tersedia di halaman Profil. Setelah pengguna menekan tombol ini, sesi mereka akan diakhiri dan mereka akan diarahkan kembali ke halaman login.
   
__4. Instalasi Aplikasi__
Ikuti langkah-langkah berikut untuk menginstal dan menjalankan aplikasi Schedula:

__3.1 Clone Repository:__

       git clone https://github.com/tinsarirauhanaa/TinsariRauhana_2308107010038_MiniProject4.git
   
       cd TinsariRauhana_2308107010038_MiniProject4

__3.2 Install dependensi:__
   
    composer install
    
__3.3 Konfigurasi Environment, salin file .env.example menjadi .env:__
   
    cp .env.example .env
   
__3.4 Generate aplikasi key:__
   
    php artisan key:generate

__3.5 Konfigurasi database di file .env sesuai dengan environment lokal.__
   
__3.6 Jalankan migrasi dan seeder:__
   
    php artisan migrate --seed
    Perintah ini akan menjalankan migrasi untuk membuat tabel users dan tasks, serta mengisi data awal menggunakan seeder UserSeeder dan TaskSeeder.

__3.7 Jalankan Server:__
   
    php artisan serve
   
    Akses aplikasi melalui http://localhost:8000

__6. Tautan Penjelasan Aplikasi:__

    Penjelasan mengenai aplikasi Schedula, termasuk presentasi dan demo aplikasi, dapat diakses melalui tautan YouTube berikut:

    PPT dapat diakses melalui tautan berikut:


    Kode sumber lengkap dari aplikasi Schedula tersedia di repository GitHub berikut:
https://github.com/tinsarirauhanaa/TinsariRauhana_2308107010038_MiniProject4
