<?php
// koneksi.php
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = ''; // isi kalau ada
$DB_NAME = 'inventory2';

$koneksi = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
mysqli_set_charset($koneksi, 'utf8');
?>
