<?php 
include 'koneksi.php'; 

// Aktifkan error reporting untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Logika Create
if (isset($_POST['tambah'])) {
    // Amankan input dari karakter berbahaya (SQL Injection)
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $sandi = mysqli_real_escape_string($koneksi, $_POST['sandi']);
    
    $query = "INSERT INTO users (nama, sandi) VALUES ('$nama', '$sandi')";
    
    if (mysqli_query($koneksi, $query)) {
        // Redirect ke halaman yang sama untuk mengosongkan form
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

// Logika Delete
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']); // Pastikan ID adalah angka
    $query = "DELETE FROM users WHERE id = $id";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menghapus: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PHP CRUD Railway</title>
    <style>
        table { border-collapse: collapse; width: 50%; margin-top: 20px; }
        th, td { padding: 10px; text-align: left; }
        form { margin-bottom: 30px; }
    </style>
</head>
<body>
    <h2>Tambah Data</h2>
    <form method="POST" action="">
        <input type="text" name="nama" placeholder="Nama" required>
        <!-- Gunakan type="password" agar karakter tersembunyi -->
        <input type="password" name="sandi" placeholder="Sandi" required>
        <button type="submit" name="tambah">Simpan</button>
    </form>

    <hr>

    <h2>Data Users</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Sandi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = mysqli_query($koneksi, "SELECT * FROM users ORDER BY id DESC");
            if (mysqli_num_rows($data) > 0) {
                while($d = mysqli_fetch_array($data)) {
            ?>
            <tr>
                <td><?php echo $d['id']; ?></td>
                <td><?php echo htmlspecialchars($d['nama']); ?></td>
                <td>******</td> <!-- Sebaiknya jangan tampilkan sandi asli di tabel -->
                <td>
                    <a href="index.php?hapus=<?php echo $d['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php 
                } 
            } else {
                echo "<tr><td colspan='4'>Belum ada data.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
