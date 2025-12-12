<?php
// hapus_barang.php
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
mysqli_query($koneksi, "DELETE FROM stok_barang WHERE id=$id");
header("Location: ../pages/stok_barang.php");
exit;
