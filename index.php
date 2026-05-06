<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP CRUD Railway</title>
</head>
<body>
    <h2>Tambah Data</h2>
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit" name="tambah">Simpan</button>
    </form>

    <?php
    // Logika Create
    if(isset($_POST['tambah'])){
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        mysqli_query($koneksi, "INSERT INTO users (nama, email) VALUES('$nama', '$email')");
    }

    // Logika Delete
    if(isset($_GET['hapus'])){
        $id = $_GET['hapus'];
        mysqli_query($koneksi, "DELETE FROM users WHERE id=$id");
        header("Location: index.php");
    }
    ?>

    <h2>Data Users</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
        <?php
        $data = mysqli_query($koneksi, "SELECT * FROM users");
        while($d = mysqli_fetch_array($data)){
        ?>
        <tr>
            <td><?php echo $d['id']; ?></td>
            <td><?php echo $d['nama']; ?></td>
            <td><?php echo $d['email']; ?></td>
            <td>
                <a href="index.php?hapus=<?php echo $d['id']; ?>">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
