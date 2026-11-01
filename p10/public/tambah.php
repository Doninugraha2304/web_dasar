<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form.php');
    exit;
}
require __DIR__ . '/wajib-login.php';
require __DIR__ . '/validasi.php';
$pdo = require __DIR__ . '/../koneksi.php';
require __DIR__ . '/../foto.php';

$foto = null;
try {
    $foto = simpanFoto($_FILES['foto'] ?? []);
} catch (RuntimeException $error) {
    exit('Foto tidak valid: ' . htmlspecialchars($error->getMessage(), ENT_QUOTES, 'UTF-8') . ' Gunakan tombol Kembali pada browser.');
}

try {
    $query = $pdo->prepare('INSERT INTO mahasiswa (nama, nim, email, foto) VALUES (?, ?, ?, ?)');
    $query->execute([$nama, $nim, $email, $foto]);
} catch (PDOException $error) {
    // Jika SQL gagal setelah file dipindah, bersihkan file baru.
    hapusFoto($foto);
    exit('Gagal menambah data. Periksa NIM duplikat dan database. Gunakan tombol Kembali pada browser.');
}

header('Location: form.php?pesan=tambah', true, 303);
exit;
