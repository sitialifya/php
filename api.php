<?php 
include 'koneksi.php'; 

// Aktifkan error reporting untuk mempermudah debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// --- LOGIKA CREATE (TAMBAH DATA) ---
if (isset($_POST['tambah'])) {
    // Escape string untuk mencegah SQL Injection dasar
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    
    // Sangat disarankan melakukan hashing pada password agar aman di database
    $sandi_input = $_POST['sandi'];
    $sandi_hashed = password_hash($sandi_input, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO users (nama, sandi) VALUES ('$nama', '$sandi_hashed')";
    
    if (mysqli_query($koneksi, $query)) {
        // Gunakan redirect agar saat di-refresh data tidak terkirim dua kali
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menambah data: " . mysqli_error($koneksi);
    }
}

// --- LOGIKA DELETE (HAPUS DATA) ---
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']); // Pastikan ID adalah angka untuk keamanan
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
        body { font-family: sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 60%; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn-hapus { color: red; text-decoration: none; }
    </style>
</head>
<body>

    <h2>Tambah Data User</h2>
    <form method="POST" action="">
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
        <input type="password" name="sandi" placeholder="Kata Sandi" required>
        <button type="submit" name="tambah">Simpan</button>
    </form>

    <hr>

    <h2>Data Users di Database</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Sandi (Hashed)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = mysqli_query($koneksi, "SELECT * FROM users ORDER BY id DESC");
            if (mysqli_num_rows($data) > 0) {
                while($d = mysqli_fetch_assoc($data)) {
            ?>
            <tr>
                <td><?php echo $d['id']; ?></td>
                <td><?php echo htmlspecialchars($d['nama']); ?></td>
                <td><small><?php echo substr($d['sandi'], 0, 15); ?>...</small></td>
                <td>
                    <a href="index.php?hapus=<?php echo $d['id']; ?>" 
                       class="btn-hapus" 
                       onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php 
                } 
            } else {
                echo "<tr><td colspan='4' style='text-align:center;'>Belum ada data.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
