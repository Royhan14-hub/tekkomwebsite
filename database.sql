DROP DATABASE IF EXISTS inventory2;
CREATE DATABASE inventory2;
USE inventory2;

CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    divisi VARCHAR(100) NOT NULL
);

INSERT INTO users (divisi) VALUES
('Admin Gudang'),
('Produksi'),
('Keuangan');

CREATE TABLE barang (
    id_barang INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(120) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    satuan VARCHAR(50) NOT NULL,
    keterangan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE barang_masuk (
    id_masuk INT AUTO_INCREMENT PRIMARY KEY,
    id_barang INT NULL,
    jumlah INT NOT NULL,
    tanggal_masuk DATE NOT NULL,
    sumber VARCHAR(120),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_barang) REFERENCES barang(id_barang)
        ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE barang_keluar (
    id_keluar INT AUTO_INCREMENT PRIMARY KEY,
    id_barang INT NULL,
    peminjam VARCHAR(150) NOT NULL,
    jumlah INT NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    tanggal_kembali DATE,
    keperluan TEXT,
    status ENUM('Dipinjam','Dikembalikan') DEFAULT 'Dipinjam',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_barang) REFERENCES barang(id_barang)
        ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE laporan_rusak (
    id_rusak INT AUTO_INCREMENT PRIMARY KEY,
    id_barang INT NULL,
    laporan_by VARCHAR(150),
    tanggal DATE NOT NULL,
    keterangan TEXT,
    status ENUM('Diajukan','Diperbaiki','Diganti','Ditolak') DEFAULT 'Diajukan',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_barang) REFERENCES barang(id_barang)
        ON DELETE SET NULL ON UPDATE CASCADE
);
