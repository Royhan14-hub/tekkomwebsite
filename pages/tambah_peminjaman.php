<?php
// Form pengajuan peminjaman bisa diakses tanpa login
include '../config/koneksi.php';

// Ambil data barang untuk pilihan
$barang = [];
$bquery = mysqli_query($koneksi, "SELECT nama_barang FROM stok_barang");
while($b = mysqli_fetch_assoc($bquery)) {
    $barang[] = $b['nama_barang'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_peminjam = mysqli_real_escape_string($koneksi, $_POST['nama_peminjam']);
    $nama_barang   = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $tanggal_pinjam= $_POST['tanggal_pinjam'];
    $tanggal_kembali= $_POST['tanggal_kembali'];
    $keterangan    = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    // Insert dengan status default 'pending'
    $sql = "INSERT INTO peminjaman_barang (nama_peminjam, nama_barang, tanggal_pinjam, tanggal_kembali, keterangan, status)
            VALUES ('$nama_peminjam', '$nama_barang', '$tanggal_pinjam', '$tanggal_kembali', '$keterangan', 'pending')";
    
    if(mysqli_query($koneksi, $sql)) {
        $success_message = "Pengajuan peminjaman berhasil dikirim! Menunggu persetujuan admin.";
    } else {
        $error_message = "Gagal mengajukan peminjaman. Silakan coba lagi.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ajukan Peminjaman Barang</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; }
        .container { max-width: 500px; margin: 50px auto; padding: 20px; }
        .box { background: #fff; padding: 30px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .box h2 { text-align: center; color: #2c3e50; margin-bottom: 25px; }
        input, select, textarea { 
            width: 100%; 
            margin: 10px 0; 
            padding: 10px; 
            border: 1px solid #ddd; 
            border-radius: 4px;
            box-sizing: border-box;
        }
        button { 
            background: #27ae60; 
            color: #fff; 
            width: 100%; 
            padding: 12px; 
            border: none; 
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover { background: #229954; }
        a { 
            display: block; 
            margin-top: 15px; 
            color: #2980b9; 
            text-align: center; 
            text-decoration: none;
        }
        a:hover { text-decoration: underline; }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 15px;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 15px;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="box">
        <h2>📝 Ajukan Peminjaman Barang</h2>
        
        <?php if(isset($success_message)): ?>
            <div class="success"><?= $success_message ?></div>
            <script>
                setTimeout(function(){
                    window.location.href = 'peminjaman_barang.php';
                }, 2000);
            </script>
        <?php endif; ?>
        
        <?php if(isset($error_message)): ?>
            <div class="error"><?= $error_message ?></div>
        <?php endif; ?>
        
        <form method="post">
            <input type="text" name="nama_peminjam" placeholder="Nama Peminjam" required>
            <select name="nama_barang" required>
                <option value="">-- Pilih Barang --</option>
                <?php 
                if(count($barang) > 0) {
                    foreach($barang as $br){ 
                        echo "<option value='$br'>$br</option>"; 
                    } 
                } else {
                    echo "<option value='' disabled>Tidak ada barang tersedia</option>";
                }
                ?>
            </select>
            <input type="date" name="tanggal_pinjam" placeholder="Tanggal Pinjam" required>
            <input type="date" name="tanggal_kembali" placeholder="Tanggal Kembali (Opsional)">
            <textarea name="keterangan" placeholder="Keterangan (Opsional)" rows="3"></textarea>
            <button type="submit">✅ Ajukan Peminjaman</button>
        </form>
        <a href="peminjaman_barang.php">← Kembali ke Daftar Peminjaman</a>
    </div>
</div>
</body>
</html>
