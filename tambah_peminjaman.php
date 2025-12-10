<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
include 'koneksi.php';

// Ambil data barang untuk pilihan
$barang = [];
$bquery = mysqli_query($koneksi, "SELECT nama_barang FROM stok_barang");
while($b = mysqli_fetch_assoc($bquery)) {
    $barang[] = $b['nama_barang'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_peminjam = mysqli_real_escape_string($koneksi, $_POST['nama_peminjam']);
    $nama_barang   = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $tanggal_pinjam= $_POST['tanggal_pinjam'];
    $tanggal_kembali= $_POST['tanggal_kembali'];
    $keterangan    = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    $sql = "INSERT INTO peminjaman_barang (nama_peminjam, nama_barang, tanggal_pinjam, tanggal_kembali, keterangan)
            VALUES ('$nama_peminjam', '$nama_barang', '$tanggal_pinjam', '$tanggal_kembali', '$keterangan')";
    mysqli_query($koneksi, $sql);
    header("Location: peminjaman_barang.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ajukan Peminjaman Barang</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; }
        .box { background: #fff; width: 350px; margin: 50px auto; padding: 24px 30px; border: 1px solid #ddd; border-radius: 4px; }
        .box h2 { text-align: center; }
        input, select { width: 100%; margin: 8px 0; padding: 6px; }
        button { background: #27ae60; color: #fff; width: 100%; padding: 8px; border: none; }
        a { display: block; margin-top: 6px; color: #2980b9; text-align: center; }
    </style>
</head>
<body>
<div class="box">
    <h2>Ajukan Peminjaman</h2>
    <form method="post">
        <input type="text" name="nama_peminjam" placeholder="Nama Peminjam" required>
        <select name="nama_barang" required>
            <option value="">Pilih Barang</option>
            <?php foreach($barang as $br){ echo "<option>$br</option>"; } ?>
        </select>
        <input type="date" name="tanggal_pinjam" required>
        <input type="date" name="tanggal_kembali">
        <input type="text" name="keterangan" placeholder="Keterangan">
        <button type="submit">Ajukan</button>
    </form>
    <a href="peminjaman_barang.php">Kembali</a>
</div>
</body>
</html>
