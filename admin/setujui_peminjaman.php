<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit;
}
include '../config/koneksi.php';
$id = (int)$_GET['id'];
$aksi = $_GET['aksi'] === 'terima' ? 'disetujui' : 'ditolak';
mysqli_query($koneksi, "UPDATE peminjaman_barang SET status='$aksi' WHERE id=$id");
header('Location: admin.php');
exit;
