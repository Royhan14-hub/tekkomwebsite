<?php 
session_start();
require "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Utama</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6fb;
        margin: 0;
        padding: 0;
    }

    /* TOPBAR FULL WIDTH */
    .topbar {
        width: 96.7%;
        background: white;
        padding: 14px 25px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .btn {
        padding: 8px 20px;
        border-radius: 8px;
        text-decoration: none;
        background: #0A53FF;
        color: white;
    }

    /* LOGO */
    .logo-area {
        width: 100%;
        text-align: center;
        margin-top: 20px;
    }

    .logo-area img {
        width: 160px;
        height: auto;
        display: block;
        margin: auto;
    }

    /* MAIN TITLE */
    .hero-title {
        font-size: 32px;
        font-weight: 700;
        text-align: center;
        margin-top: 15px;
    }

    .hero-sub {
        font-size: 16px;
        text-align: center;
        color: #555;
        margin-bottom: 40px;
    }

    /* KOTAK MENU */
    .menu-container {
        max-width: 1100px;
        margin: auto;
        display: flex;
        justify-content: center;
        gap: 25px;
        flex-wrap: wrap;
    }

    .menu-card {
        width: 280px;
        background: white;
        padding: 30px;
        border-radius: 18px;
        text-align: center;
        border: 1px solid #eee;
        box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        transition: 0.25s ease;
        text-decoration: none;
        color: black;
    }

    .menu-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 80, 255, 0.18);
        border-color: #0A53FF;
    }

    .menu-card .icon {
        font-size: 55px;
        margin-bottom: 15px;
    }

    .menu-card h3 {
        margin: 10px 0;
        font-size: 20px;
        color: #0A53FF;
    }

    .menu-card p {
        font-size: 14px;
        color: #666;
    }
</style>

</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
    <a href="login.php" class="btn">Login</a>
</div>

<!-- LOGO -->
<div class="logo-area">
    <img src="tekkom.jpg" alt="Logo TEKKOM">
</div>

<h1 class="hero-title">Peminjaman Barang</h1>
<p class="hero-sub">Silahkan pilih menu di bawah ini</p>

<!-- MENU -->
<div class="menu-container">

    <a href="peminjaman_barang.php" class="menu-card">
        <div class="icon">📦</div>
        <h3>Peminjaman Barang</h3>
        <p>Ajukan peminjaman barang</p>
    </a>

    <a href="stok_barang.php" class="menu-card">
        <div class="icon">📋</div>
        <h3>Stok Barang</h3>
        <p>Lihat seluruh stok barang</p>
    </a>

    <a href="riwayat.php" class="menu-card">
        <div class="icon">⏳</div>
        <h3>Riwayat Peminjaman</h3>
        <p>Lihat history peminjaman barang</p>
    </a>

</div>

</body>
</html>
