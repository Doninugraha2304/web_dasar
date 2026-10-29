-- Jalankan melalui tab Import di phpMyAdmin. File ini aman dijalankan ulang.
-- Database baru (sia_praktikum) dipakai agar tidak bentrok dengan database UTS Anda.
CREATE DATABASE IF NOT EXISTS sia_praktikum CHARACTER SET utf8mb4;

USE sia_praktikum;

-- NIM disimpan sebagai teks agar angka nol di awal tidak hilang.
CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nim VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(254) NOT NULL
) ENGINE=InnoDB;

-- P9: akun pengguna. Kolom password_hash menyimpan hasil password_hash(), bukan password asli.
CREATE TABLE IF NOT EXISTS pengguna (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    dibuat DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
