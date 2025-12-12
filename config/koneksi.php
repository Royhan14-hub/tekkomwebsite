<?php
$DB_HOST = '127.0.0.1';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'inventory2';
$DB_PORT = 3306;

$koneksi = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
