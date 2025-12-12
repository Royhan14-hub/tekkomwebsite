<?php
// Helper function untuk mendapatkan base URL
function base_url($path = '') {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $script = $_SERVER['SCRIPT_NAME'];
    $base = dirname($script);
    if ($base === '/' || $base === '\\') {
        $base = '';
    }
    return $protocol . '://' . $host . $base . ($path ? '/' . ltrim($path, '/') : '');
}

// Helper untuk include koneksi
function require_koneksi() {
    // Cek apakah file ada di folder config (jika dipanggil dari root)
    if (file_exists(__DIR__ . '/koneksi.php')) {
        require_once __DIR__ . '/koneksi.php';
    } 
    // Jika dipanggil dari subfolder, naik satu level
    elseif (file_exists(__DIR__ . '/../config/koneksi.php')) {
        require_once __DIR__ . '/../config/koneksi.php';
    }
    // Fallback ke path relatif
    else {
        require_once 'config/koneksi.php';
    }
}
?>

