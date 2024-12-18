Deskripsi Proyek

Website ini merupakan sistem sederhana dengan login, otorisasi pengguna, dashboard pengguna, dan dashboard admin. Website ini memiliki fitur untuk mengirim pesan, melaporkan masalah, dan mengelola laporan oleh admin.

Celah keamanan sengaja dibiarkan untuk mendemonstrasikan pentingnya sanitasi input dan praktik pengkodean yang aman.

Fitur Utama

1. Sistem Login dan Registrasi

 1.1. Login menggunakan username dan password.
 
 1.2. Registrasi pengguna baru.
 
 1.3. Pengalihan berdasarkan peran pengguna (admin atau user).
 ![image](https://github.com/user-attachments/assets/f13100d3-5d27-4034-a29c-c056a68e6c15)

![image](https://github.com/user-attachments/assets/d21a35ba-53b5-430f-b951-2ef52f6d44a7)


2. Dashboard Pengguna
   
   2.1. Menampilkan profil pengguna.
   
   2.2. Mengirim pesan ke pengguna lain.
   
   2.3. Mengirim laporan ke admin.

   ![image](https://github.com/user-attachments/assets/4e2e6f47-30e6-46ce-be2c-80610c397cba)



3. Dashboard Admin
   3.1. Menampilkan semua laporan dari pengguna.
   
   3.2. Menghapus data laporan atau pesan jika diperlukan.

   ![image](https://github.com/user-attachments/assets/9fa378b0-f1e6-494c-a182-18904ed02776)


4. Logout
   4.1. Menghapus sesi pengguna dan kembali ke halaman login.

Struktur Basis Data

Basis data menggunakan MySQL dengan struktur tabel sebagai berikut:

Tabel users:

![image](https://github.com/user-attachments/assets/dfb38f25-73c8-46a8-b432-604468259f83)

Tabel messages

![image](https://github.com/user-attachments/assets/9d829400-6909-4cd3-a618-93ebc39eb1b5)

Tabel Report

![image](https://github.com/user-attachments/assets/a7a14bde-14f7-4dcd-b02f-1a55f242ae34)

Teknologi yang Digunakan

1. Backend: PHP
2. Database: MySQL
3. Frontend: HTML & CSS
4. Server Lokal: XAMPP
5. Editor Kode: Visual Studio Code

Instalasi

1. Kloning repositori ini:

git clone https://github.com/linggapras/data

2. Import Database:

2.1. Buka phpMyAdmin.

2.2. Buat database baru bernama data.

2.3 Import file SQL yang telah disediakan (misal: data.sql).

3. Konfigurasi Database:
   
3.1 Edit file includes/db.php untuk menyesuaikan kredensial database Anda

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'data';

$conn = new mysqli($host, $user, $pass, $db_name);

4. Jalankan di XAMPP:
   
4.1. Pastikan Apache dan MySQL aktif.

4.2. Akses website melalui http://localhost/data.

Celah Keamanan yang Ditinggalkan

1. SQL Injection:
   
1.1 Query SQL tidak menggunakan prepared statements.

1.2 Input pengguna dimasukkan langsung ke dalam query.

2. Cross-Site Scripting (XSS)

2.1. Input tidak disanitasi saat ditampilkan.

3. Privilege Escalation:

3.1. Validasi peran pengguna tidak sepenuhnya aman.
