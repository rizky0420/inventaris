CREATE DATABASE inventaris;

USE inventaris;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    role ENUM('admin', 'coadmin') NOT NULL
);

CREATE TABLE inventaris (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(100) NOT NULL,
    jumlah_stok INT NOT NULL,
    barang_masuk INT NOT NULL,
    barang_keluar INT NOT NULL,
    uang_masuk DECIMAL(10, 2) NOT NULL,
    uang_keluar DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);