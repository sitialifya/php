<?php
// 1. Ambil data dari environment variables Railway.
// JANGAN mengisi password asli di dalam file ini jika akan di-upload ke GitHub/Public.
$host = getenv('MYSQLHOST') ?: "mysql-0sfr.railway.internal";
$user = getenv('MYSQLUSER') ?: "root";
$pass = getenv('MYSQLPASSWORD') ?: "dvsFQveoANNUPfFidSzgHwLhZOXqaIFd"; 
$db   = getenv('MYSQLDATABASE') ?: "railway";
$port = getenv('MYSQLPORT') ?: 3306;

// 2. Melakukan koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db, $port);

// 3. Cek koneksi
if (!$koneksi) {
    // Gunakan error_log untuk mencatat detail teknis di server, 
    // tapi tampilkan pesan umum ke pengguna agar lebih aman.
    error_log("Koneksi gagal: " . mysqli_connect_error());
    die("Maaf, koneksi ke database sedang bermasalah.");
}

// 4. Set Charset agar mendukung berbagai karakter (opsional tapi disarankan)
mysqli_set_charset($koneksi, "utf8mb4");
?>
