<?php
// ===== BAGIAN 1: TERIMA POST, PERIKSA TOKEN DAN LOGIN =====
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form.php');
    exit;
}
require __DIR__ . '/wajib-login.php';

// ===== BAGIAN 2: VALIDASI INPUT, FOTO, DAN KONEKSI =====
require __DIR__ . '/validasi.php';
$pdo = require __DIR__ . '/../koneksi.php';

// ===== BAGIAN 3: CREATE - INSERT =====
// prepare memisahkan perintah SQL dari nilai yang dimasukkan pengguna.
try {
    $query = $pdo->prepare('INSERT INTO mahasiswa (nama, nim, email) VALUES (?, ?, ?)');
    $query->execute([$nama, $nim, $email]);
} catch (PDOException $error) {
    exit('Gagal menambah data. Periksa NIM duplikat dan database. Gunakan tombol Kembali pada browser.');
}

// ===== BAGIAN 4: KEMBALI KE DAFTAR =====
// HTTP 303 membuka halaman dengan GET agar refresh tidak mengulang INSERT.
header('Location: form.php?pesan=tambah', true, 303);
exit;
