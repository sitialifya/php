<?php
// Mengambil data dari environment variables Railway
$host = getenv('MYSQLHOST') ?: 'mysql.railway.internal';
$user = getenv('MYSQLUSER') ?: 'root';
$pass = getenv('MYSQLPASSWORD') ?: ''; // Jangan hardcode password di sini jika memungkinkan
$db   = getenv('MYSQLDATABASE') ?: 'railway';
$port = getenv('MYSQLPORT') ?: 3306;

// Melakukan koneksi menggunakan mysqli
// Disarankan menggunakan try-catch atau pengecekan error yang bersih
$koneksi = mysqli_connect($host, $user, $pass, $db, $port);

// Cek koneksi
if (!$koneksi) {
    // Di fase produksi, jangan tampilkan detail error ke user. Gunakan log.
    error_log("Koneksi gagal: " . mysqli_connect_error());
    die("Maaf, terjadi masalah pada koneksi database.");
}

// Set charset ke utf8mb4 agar mendukung karakter khusus/emoji
mysqli_set_charset($koneksi, "utf8mb4");
?>
