<?php
include '../config/koneksi.php';

// Ambil data peminjaman barang dari database
$query = "SELECT * FROM peminjaman_barang ORDER BY created_at DESC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Peminjaman Barang</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; }
        .container { max-width: 1200px; margin: 20px auto; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .btn-ajukan { 
            display: inline-block; 
            background: #27ae60; 
            color: white; 
            padding: 12px 24px; 
            text-decoration: none; 
            border-radius: 5px; 
            margin-bottom: 20px;
            font-weight: bold;
        }
        .btn-ajukan:hover { background: #229954; }
        .btn-kembali {
            display: inline-block;
            background: #95a5a6;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        table { 
            border-collapse: collapse; 
            width: 100%; 
            margin: 20px auto; 
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 12px; 
            text-align: center; 
        }
        th { 
            background: #3498db; 
            color: white; 
            font-weight: bold;
        }
        tr:nth-child(even) { background: #f9f9f9; }
        tr:hover { background: #f5f5f5; }
        .status-pending { 
            background: #f39c12; 
            color: white; 
            padding: 5px 10px; 
            border-radius: 3px; 
            font-weight: bold;
        }
        .status-disetujui { 
            background: #27ae60; 
            color: white; 
            padding: 5px 10px; 
            border-radius: 3px; 
            font-weight: bold;
        }
        .status-ditolak { 
            background: #e74c3c; 
            color: white; 
            padding: 5px 10px; 
            border-radius: 3px; 
            font-weight: bold;
        }
        .keterangan-status {
            font-style: italic;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Daftar Peminjaman Barang</h2>
        <a href="tambah_peminjaman.php" class="btn-ajukan">➕ Ajukan Peminjaman Barang</a>
    </div>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Nama Barang</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>Keterangan</th>
        </tr>
        <?php
        $no = 1;
        if($result && mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $status = $row['status'];
                $status_class = '';
                $status_text = '';
                
                if($status == 'pending') {
                    $status_class = 'status-pending';
                    $status_text = 'Menunggu Persetujuan';
                } elseif($status == 'disetujui') {
                    $status_class = 'status-disetujui';
                    $status_text = 'Disetujui';
                } elseif($status == 'ditolak') {
                    $status_class = 'status-ditolak';
                    $status_text = 'Ditolak';
                } else {
                    $status_class = 'status-pending';
                    $status_text = ucfirst($status);
                }
                
                $keterangan = !empty($row['keterangan']) ? $row['keterangan'] : '-';
                $keterangan_status = "<span class='keterangan-status'>Status: {$status_text}</span>";
                
                echo "<tr>
                    <td>{$no}</td>
                    <td>{$row['nama_peminjam']}</td>
                    <td>{$row['nama_barang']}</td>
                    <td>{$row['tanggal_pinjam']}</td>
                    <td>" . ($row['tanggal_kembali'] ? $row['tanggal_kembali'] : '-') . "</td>
                    <td><span class='{$status_class}'>{$status_text}</span></td>
                    <td>{$keterangan}<br>{$keterangan_status}</td>
                </tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='7' style='padding: 30px; text-align: center; color: #7f8c8d;'>Tidak ada data peminjaman. Silakan ajukan peminjaman barang terlebih dahulu.</td></tr>";
        }
        ?>
    </table>
    <div style="text-align: center;">
        <a href="../index.php" class="btn-kembali">← Kembali ke Halaman Utama</a>
    </div>
</div>
</body>
</html>
