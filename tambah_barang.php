<?php
// tambah_barang.php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $jumlah = (int) $_POST['jumlah'];
    $ket = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    $sql = "INSERT INTO stok_barang (nama_barang, jumlah, keterangan)
            VALUES ('$nama', $jumlah, '$ket')";
    mysqli_query($koneksi, $sql);
    header("Location: stok_barang.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; }
        .box { background: #fff; width: 350px; margin: 50px auto; padding: 24px 30px; border: 1px solid #ddd; border-radius: 4px; }
        .box h2 { text-align: center; }
        input, textarea { width: 100%; margin: 8px 0; padding: 6px; }
        button { background: #27ae60; color: #fff; width: 100%; padding: 8px; border: none; }
        a { display: block; margin-top: 6px; color: #2980b9; text-align: center; }
    </style>
</head>
<body>
<div class="box">
    <h2>Tambah Barang</h2>
    <form method="post">
        <input type="text" name="nama_barang" placeholder="Nama Barang" required>
        <input type="number" min="0" name="jumlah" placeholder="Jumlah" required>
        <input type="text" name="keterangan" placeholder="Keterangan">
        <button type="submit">Simpan</button>
    </form>
    <a href="stok_barang.php">Kembali</a>
</div>
</body>
</html>
