# Struktur Folder Tekkom Website

## 📁 Struktur Direktori

```
tekkomwebsite/
├── 📄 index.php                 # Halaman utama/landing page
├── 📄 README.md                  # Dokumentasi utama
├── 📄 STRUCTURE.md              # Dokumentasi struktur folder (file ini)
│
├── 📁 config/                   # File konfigurasi
│   ├── koneksi.php              # Koneksi database
│   └── path_helper.php          # Helper function untuk path
│
├── 📁 assets/                    # File static (CSS, gambar, dll)
│   ├── 📁 css/
│   │   └── style.css            # Stylesheet utama
│   └── 📁 images/
│       └── tekkom.jpg           # Logo TEKKOM
│
├── 📁 admin/                     # Halaman admin (perlu login admin)
│   ├── admin.php                # Dashboard admin
│   ├── tambah_barang.php        # Tambah barang baru
│   ├── edit_barang.php          # Edit data barang
│   ├── hapus_barang.php         # Hapus barang
│   └── setujui_peminjaman.php   # Setujui/tolak peminjaman
│
├── 📁 pages/                     # Halaman publik/user
│   ├── peminjaman_barang.php    # Daftar peminjaman
│   ├── tambah_peminjaman.php    # Form ajukan peminjaman
│   ├── stok_barang.php          # Daftar stok barang
│   ├── riwayat.php              # Riwayat penyimpanan
│   └── laporan.php              # Laporan transaksi
│
├── 📁 auth/                      # Autentikasi
│   ├── login.php                # Halaman login
│   └── logout.php               # Logout user
│
├── 📁 database/                  # File SQL database
│   ├── database.sql             # Schema database lengkap
│   └── update_users_table.sql   # Script update tabel users
│
└── 📁 tools/                     # Script utility/tools
    ├── fix_all_tables.php       # Script perbaiki semua tabel
    ├── fix_users_table.php     # Script perbaiki tabel users
    └── hash.php                 # Generator password hash
```

## 🔗 Path Reference

### Dari Root (index.php)
- Config: `config/koneksi.php`
- Assets: `assets/css/style.css`, `assets/images/tekkom.jpg`
- Pages: `pages/peminjaman_barang.php`, `pages/stok_barang.php`, dll
- Auth: `auth/login.php`, `auth/logout.php`
- Admin: `admin/admin.php`

### Dari Admin Folder
- Config: `../config/koneksi.php`
- Auth: `../auth/login.php`
- Pages: `../pages/stok_barang.php`
- Root: `../index.php`

### Dari Pages Folder
- Config: `../config/koneksi.php`
- Auth: `../auth/login.php`
- Admin: `../admin/admin.php`
- Root: `../index.php`

### Dari Auth Folder
- Config: `../config/koneksi.php`
- Admin: `../admin/admin.php`
- Root: `../index.php`

## 🚀 Setup Awal

1. **Import Database:**
   - Buka phpMyAdmin atau MySQL client
   - Import file `database/database.sql`

2. **Atau Perbaiki Database yang Sudah Ada:**
   - Akses `tools/fix_all_tables.php` di browser
   - Script akan otomatis memperbaiki semua tabel

3. **Login:**
   - Username: `admin`
   - Password: `admin123`

## 📝 Catatan

- Semua file PHP yang membutuhkan koneksi database harus include `config/koneksi.php`
- File di folder `admin/` memerlukan session dengan level 'admin'
- File di folder `pages/` bisa diakses publik (kecuali yang ada session check)
- File di folder `tools/` adalah utility script, bisa dihapus setelah setup selesai

