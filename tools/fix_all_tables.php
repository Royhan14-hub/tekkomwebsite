<?php
include '../config/koneksi.php';

echo "<h2>Memperbaiki Semua Tabel Database...</h2>";
echo "<style>body{font-family:Arial;padding:20px;} p{margin:5px 0;} .success{color:green;} .error{color:red;} .warning{color:orange;}</style>";

// 1. Fix users table
echo "<h3>1. Memperbaiki Tabel Users...</h3>";
$check = mysqli_query($koneksi, "SHOW COLUMNS FROM users LIKE 'username'");
$username_exists = mysqli_num_rows($check) > 0;

if (!$username_exists) {
    $queries = [
        "ALTER TABLE users ADD COLUMN username VARCHAR(100) UNIQUE AFTER id_user",
        "ALTER TABLE users ADD COLUMN password VARCHAR(255) AFTER username",
        "ALTER TABLE users ADD COLUMN level VARCHAR(50) DEFAULT 'user' AFTER password",
        "ALTER TABLE users ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP AFTER divisi"
    ];
    
    foreach ($queries as $query) {
        if (mysqli_query($koneksi, $query)) {
            echo "<p class='success'>✓ Berhasil menambahkan kolom</p>";
        } else {
            $error = mysqli_error($koneksi);
            if (strpos($error, 'Duplicate column name') === false) {
                echo "<p class='error'>✗ Error: " . htmlspecialchars($error) . "</p>";
            }
        }
    }
} else {
    echo "<p class='warning'>Kolom username sudah ada.</p>";
}

// Add admin user
$check_admin = mysqli_query($koneksi, "SELECT * FROM users WHERE username='admin'");
if (mysqli_num_rows($check_admin) == 0) {
    $password_hash = '$2y$10$e9LYH9blWF1lP./mNOnI1e/VqmYIX3zfSZ3KiChudLBlUWhzZtyO.';
    $sql = "INSERT INTO users (username, password, level, divisi) 
            VALUES ('admin', '$password_hash', 'admin', 'Admin Gudang')";
    if (mysqli_query($koneksi, $sql)) {
        echo "<p class='success'>✓ User admin berhasil ditambahkan!</p>";
    }
} else {
    $password_hash = '$2y$10$e9LYH9blWF1lP./mNOnI1e/VqmYIX3zfSZ3KiChudLBlUWhzZtyO.';
    mysqli_query($koneksi, "UPDATE users SET password='$password_hash', level='admin' WHERE username='admin'");
    echo "<p class='success'>✓ Password admin telah diperbarui!</p>";
}

// 2. Create riwayat_penyimpanan table
echo "<h3>2. Membuat Tabel Riwayat Penyimpanan...</h3>";
$check_table = mysqli_query($koneksi, "SHOW TABLES LIKE 'riwayat_penyimpanan'");
if (mysqli_num_rows($check_table) == 0) {
    $sql = "CREATE TABLE riwayat_penyimpanan (
        id_riwayat INT AUTO_INCREMENT PRIMARY KEY,
        nama_barang VARCHAR(150) NOT NULL,
        jumlah INT NOT NULL,
        tanggal_simpan DATE NOT NULL,
        nama_penyimpan VARCHAR(150) NOT NULL,
        keterangan TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    if (mysqli_query($koneksi, $sql)) {
        echo "<p class='success'>✓ Tabel riwayat_penyimpanan berhasil dibuat!</p>";
    } else {
        echo "<p class='error'>✗ Error: " . mysqli_error($koneksi) . "</p>";
    }
} else {
    echo "<p class='warning'>Tabel riwayat_penyimpanan sudah ada.</p>";
}

// 3. Create peminjaman_barang table
echo "<h3>3. Membuat Tabel Peminjaman Barang...</h3>";
$check_table = mysqli_query($koneksi, "SHOW TABLES LIKE 'peminjaman_barang'");
if (mysqli_num_rows($check_table) == 0) {
    $sql = "CREATE TABLE peminjaman_barang (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama_peminjam VARCHAR(150) NOT NULL,
        nama_barang VARCHAR(150) NOT NULL,
        tanggal_pinjam DATE NOT NULL,
        tanggal_kembali DATE,
        keterangan TEXT,
        status ENUM('pending', 'disetujui', 'ditolak') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    if (mysqli_query($koneksi, $sql)) {
        echo "<p class='success'>✓ Tabel peminjaman_barang berhasil dibuat!</p>";
    } else {
        echo "<p class='error'>✗ Error: " . mysqli_error($koneksi) . "</p>";
    }
} else {
    echo "<p class='warning'>Tabel peminjaman_barang sudah ada.</p>";
}

echo "<hr>";
echo "<h3>Selesai!</h3>";
echo "<p><strong>Login dengan:</strong></p>";
echo "<p>Username: <strong>admin</strong></p>";
echo "<p>Password: <strong>admin123</strong></p>";
echo "<p><a href='../auth/login.php' style='background:#2980b9;color:white;padding:10px 20px;text-decoration:none;border-radius:4px;display:inline-block;margin-top:10px;'>Kembali ke Login</a></p>";
echo "<p><a href='../admin/admin.php' style='background:#27ae60;color:white;padding:10px 20px;text-decoration:none;border-radius:4px;display:inline-block;margin-top:10px;'>Ke Admin Dashboard</a></p>";
?>

