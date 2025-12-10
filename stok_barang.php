<?php
include 'koneksi.php';

// Ambil data stok barang dari database
$query = "SELECT * FROM stok_barang";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Stok Barang</title>
    <style>
        table { border-collapse: collapse; width: 60%; margin: 30px auto; }
        th, td { border: 1px solid #444; padding: 8px 12px; text-align: center; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Daftar Stok Barang</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
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
                    <td>{$row['keterangan']}</td>
                </tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data barang.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
