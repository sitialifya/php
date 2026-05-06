<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Mengambil data dari environment variables Railway
$host = getenv('MYSQLHOST');
$user = getenv('MYSQLUSER');
$pass = getenv('MYSQLPASSWORD');
$db   = getenv('MYSQLDATABASE');
$port = getenv('MYSQLPORT');

// Melakukan koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db, $port);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
