<?php
// Railway menyediakan variabel ini secara otomatis di tab Variables
$host     = getenv('MYSQLHOST');     
$user     = getenv('MYSQLUSER');     
$password = getenv('MYSQLPASSWORD'); 
$db_name  = getenv('MYSQLDATABASE'); 
$port     = getenv('MYSQLPORT');     

// Pastikan port tidak kosong, kalau kosong pakai default 3306
if (!$port) $port = "3306";

// Melakukan koneksi ke database Railway
$koneksi = mysqli_connect($host, $user, $password, $db_name, $port);

// Cek koneksi agar kita tahu persis kalau gagal lagi
if (!$koneksi) {
    die("Koneksi ke Database Gagal: " . mysqli_connect_error());
}
?>
