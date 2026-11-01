<?php
header('Content-Type: text/plain; charset=utf-8');

try {
    // __DIR__ memastikan lokasi file tetap benar dari direktori mana pun.
    $pdo = require __DIR__ . '/../koneksi.php';

    // Query sederhana untuk memastikan database dapat merespons.
    $hasil = $pdo->query('SELECT 1')->fetchColumn();

    if ((int) $hasil !== 1) {
        throw new RuntimeException('Hasil pengecekan database tidak sesuai.');
    }

    echo 'Koneksi database MySQL berhasil!';
} catch (PDOException | RuntimeException $error) {
    http_response_code(500);
    // Jangan tampilkan detail koneksi atau password di browser.
    error_log('Pengecekan koneksi database gagal: ' . get_class($error));
    echo 'Koneksi database gagal. Periksa konfigurasi, ekstensi pdo_mysql, dan layanan MySQL.';
}
