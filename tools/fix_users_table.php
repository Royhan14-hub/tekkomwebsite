<?php
include '../config/koneksi.php';

echo "<h2>Memperbaiki Tabel Users...</h2>";

// Check if columns exist
$check = mysqli_query($koneksi, "SHOW COLUMNS FROM users LIKE 'username'");
$username_exists = mysqli_num_rows($check) > 0;

if (!$username_exists) {
    echo "<p>Menambahkan kolom username, password, level, dan created_at...</p>";
    
    // Add columns one by one
    $queries = [
        "ALTER TABLE users ADD COLUMN username VARCHAR(100) UNIQUE AFTER id_user",
        "ALTER TABLE users ADD COLUMN password VARCHAR(255) AFTER username",
        "ALTER TABLE users ADD COLUMN level VARCHAR(50) DEFAULT 'user' AFTER password",
        "ALTER TABLE users ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP AFTER divisi"
    ];
    
    foreach ($queries as $query) {
        if (mysqli_query($koneksi, $query)) {
            echo "<p style='color:green;'>✓ Berhasil: " . htmlspecialchars($query) . "</p>";
        } else {
            $error = mysqli_error($koneksi);
            // Ignore "Duplicate column name" errors
            if (strpos($error, 'Duplicate column name') === false) {
                echo "<p style='color:red;'>✗ Error: " . htmlspecialchars($error) . "</p>";
            } else {
                echo "<p style='color:orange;'>⚠ Kolom sudah ada, dilewati.</p>";
            }
        }
    }
} else {
    echo "<p>Kolom username sudah ada.</p>";
}

// Check if admin user exists
$check_admin = mysqli_query($koneksi, "SELECT * FROM users WHERE username='admin'");
if (mysqli_num_rows($check_admin) == 0) {
    echo "<p>Menambahkan user admin...</p>";
    $password_hash = '$2y$10$e9LYH9blWF1lP./mNOnI1e/VqmYIX3zfSZ3KiChudLBlUWhzZtyO.';
    $sql = "INSERT INTO users (username, password, level, divisi) 
            VALUES ('admin', '$password_hash', 'admin', 'Admin Gudang')";
    
    if (mysqli_query($koneksi, $sql)) {
        echo "<p style='color:green;'>✓ User admin berhasil ditambahkan!</p>";
        echo "<p><strong>Username:</strong> admin</p>";
        echo "<p><strong>Password:</strong> admin123</p>";
    } else {
        echo "<p style='color:red;'>✗ Error: " . mysqli_error($koneksi) . "</p>";
    }
} else {
    echo "<p>User admin sudah ada.</p>";
    // Update password hash if needed
    $password_hash = '$2y$10$e9LYH9blWF1lP./mNOnI1e/VqmYIX3zfSZ3KiChudLBlUWhzZtyO.';
    mysqli_query($koneksi, "UPDATE users SET password='$password_hash', level='admin' WHERE username='admin'");
    echo "<p style='color:green;'>✓ Password admin telah diperbarui!</p>";
}

echo "<hr>";
echo "<p><a href='../auth/login.php' style='background:#2980b9;color:white;padding:10px 20px;text-decoration:none;border-radius:4px;'>Kembali ke Login</a></p>";
?>

