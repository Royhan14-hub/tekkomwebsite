<?php
// hapus_barang.php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
include 'koneksi.php';
if (!isset($_GET['id'])) {
    header('Location: stok_barang.php');
    exit;
}
$id = (int) $_GET['id'];
mysqli_query($koneksi, "DELETE FROM stok_barang WHERE id=$id");
header("Location: stok_barang.php");
exit;
