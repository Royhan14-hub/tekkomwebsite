<?php
include 'koneksi.php';

// Ambil data peminjaman barang dari database
$query = "SELECT * FROM peminjaman_barang";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Peminjaman Barang</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 30px auto; }
        th, td { border: 1px solid #444; padding: 8px 12px; text-align: center; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Daftar Peminjaman Barang</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Nama Barang</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Keterangan</th>
        </tr>
        <?php
        $no = 1;
        if($result && mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>
                    <td>{$no}</td>
                    <td>{$row['nama_peminjam']}</td>
                    <td>{$row['nama_barang']}</td>
                    <td>{$row['tanggal_pinjam']}</td>
                    <td>{$row['tanggal_kembali']}</td>
                    <td>{$row['keterangan']}</td>
                </tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data peminjaman.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
