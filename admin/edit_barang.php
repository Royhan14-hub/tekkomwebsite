<?php
// edit_barang.php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../auth/login.php');
    exit;
}
include '../config/koneksi.php';
if (!isset($_GET['id'])) {
    header('Location: ../pages/stok_barang.php');
    exit;
}
$id = (int) $_GET['id'];
// Proses update data jika form di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $jumlah = (int) $_POST['jumlah'];
    $ket = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
    $sql = "UPDATE stok_barang SET nama_barang='$nama', jumlah=$jumlah, keterangan='$ket' WHERE id_stok=$id";
    mysqli_query($koneksi, $sql);
    header("Location: ../pages/stok_barang.php");
    exit;
}
// Ambil data sebelumnya
$sql = "SELECT * FROM stok_barang WHERE id_stok=$id";
$res = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($res);
if (!$row) {
    header('Location: ../pages/stok_barang.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; }
        .box { background: #fff; width: 350px; margin: 50px auto; padding: 24px 30px; border: 1px solid #ddd; border-radius: 4px; }
        .box h2 { text-align: center; }
        input, textarea { width: 100%; margin: 8px 0; padding: 6px; }
        button { background: #2980b9; color: #fff; width: 100%; padding: 8px; border: none; }
        a { display: block; margin-top: 6px; color: #2980b9; text-align: center; }
    </style>
</head>
<body>
<div class="box">
    <h2>Edit Barang</h2>
    <form method="post">
        <input type="text" name="nama_barang" placeholder="Nama Barang" value="<?= htmlspecialchars($row['nama_barang']); ?>" required>
        <input type="number" min="0" name="jumlah" placeholder="Jumlah" value="<?= $row['jumlah']; ?>" required>
        <input type="text" name="keterangan" placeholder="Keterangan" value="<?= htmlspecialchars($row['keterangan']); ?>">
        <button type="submit">Update</button>
    </form>
    <a href="../pages/stok_barang.php">Kembali</a>
</div>
</body>
</html>
