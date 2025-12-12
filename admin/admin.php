<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit;
}
include '../config/koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {font-family: Arial;}
        .container { width:90%; margin: 30px auto;}
        h2 { margin-top: 40px;}
        table { width:100%; border-collapse: collapse; margin: 10px 0;}
        th,td { border:1px solid #999; padding:8px; text-align:center;}
        th { background: #eee; }
        .aksi-btn { margin:0 3px; padding:5px 14px; border-radius:2px; }
        .edit { background:#2980b9; color:#fff; border:none;}
        .hapus { background:#c0392b; color:#fff; border:none;}
        .terima { background:#27ae60; color:#fff; border:none;}
        .tolak { background:#c0392b; color:#fff; border:none;}
    </style>
</head>
<body>
<div class="container">
<h1>Dashboard Admin</h1>
<a href="../auth/logout.php" style="float:right;">Logout</a>
<h2>Manajemen Stok Barang</h2>
<a href="tambah_barang.php" class="aksi-btn edit" style="background:#27ae60">Tambah Barang</a>
<table>
<tr>
    <th>No</th><th>Nama Barang</th><th>Jumlah</th><th>Keterangan</th><th>Aksi</th>
</tr>
<?php
$q = mysqli_query($koneksi, "SELECT * FROM stok_barang");
$n=1;
while($row = mysqli_fetch_assoc($q)){
    echo "<tr>
        <td>{$n}</td>
        <td>{$row['nama_barang']}</td>
        <td>{$row['jumlah']}</td>
        <td>{$row['keterangan']}</td>
        <td>
            <a class='aksi-btn edit' href='edit_barang.php?id={$row['id_stok']}'>Edit</a>
            <a class='aksi-btn hapus' href='hapus_barang.php?id={$row['id_stok']}' onclick=\"return confirm('Yakin hapus?')\">Hapus</a>
        </td>
    </tr>";
    $n++;
}
?>
</table>

<h2>Pengajuan Peminjaman (Belum Diproses)</h2>
<table>
<tr>
    <th>No</th><th>Nama Peminjam</th><th>Barang</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Keterangan</th><th>Aksi</th>
</tr>
<?php
$q2 = mysqli_query($koneksi, "SELECT * FROM peminjaman_barang WHERE status='pending'");
$n=1;
while($row = mysqli_fetch_assoc($q2)){
    echo "<tr>
        <td>{$n}</td>
        <td>{$row['nama_peminjam']}</td>
        <td>{$row['nama_barang']}</td>
        <td>{$row['tanggal_pinjam']}</td>
        <td>{$row['tanggal_kembali']}</td>
        <td>{$row['keterangan']}</td>
        <td>
            <a class='aksi-btn terima' href='setujui_peminjaman.php?id={$row['id']}&aksi=terima' onclick=\"return confirm('Terima permohonan?')\">Terima</a>
            <a class='aksi-btn tolak' href='setujui_peminjaman.php?id={$row['id']}&aksi=tolak' onclick=\"return confirm('Tolak permohonan?')\">Tolak</a>
        </td>
    </tr>";
    $n++;
}
?>
</table>
</div>
</body>
</html>
