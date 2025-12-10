<?php
include 'koneksi.php';

// Ambil data riwayat penyimpanan dari database
$query = "SELECT * FROM riwayat_penyimpanan";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Penyimpanan Barang</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 30px auto; }
        th, td { border: 1px solid #444; padding: 8px 12px; text-align: center; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Riwayat Penyimpanan Barang</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Tanggal Simpan</th>
            <th>Nama Penyimpan</th>
            <th>Keterangan</th>
        </tr>
        <?php
        $no = 1;
        if($result && mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>
                    <td>{$no}</td>
                    <td>{$row['nama_barang']}</td>
                    <td>{$row['jumlah']}</td>
                    <td>{$row['tanggal_simpan']}</td>
                    <td>{$row['nama_penyimpan']}</td>
                    <td>{$row['keterangan']}</td>
                </tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data riwayat penyimpanan.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
