<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form.php');
    exit;
}
require __DIR__ . '/wajib-login.php';
require __DIR__ . '/validasi.php';

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    exit('ID tidak valid. Buka kembali form.php.');
}

$pdo = require __DIR__ . '/../koneksi.php';
require __DIR__ . '/../foto.php';

$query = $pdo->prepare('SELECT id, nama, nim, email, foto FROM mahasiswa WHERE id = ?');
$query->execute([$id]);
$data = $query->fetch(PDO::FETCH_ASSOC);
if (!$data) {
    exit('Data mahasiswa tidak ditemukan. Buka kembali form.php.');
}
$fotoLama = $data['foto'] ?? null;

$fotoBaru = null;
try {
    $fotoBaru = simpanFoto($_FILES['foto'] ?? []);
} catch (RuntimeException $error) {
    exit('Foto tidak valid: ' . htmlspecialchars($error->getMessage(), ENT_QUOTES, 'UTF-8') . ' Gunakan tombol Kembali pada browser.');
}

// Jika tidak memilih foto, pertahankan foto lama (cabang null).
$fotoSimpan = $fotoBaru !== null ? $fotoBaru : $fotoLama;

try {
    $query = $pdo->prepare('UPDATE mahasiswa SET nama = ?, nim = ?, email = ?, foto = ? WHERE id = ?');
    $query->execute([$nama, $nim, $email, $fotoSimpan, $id]);
} catch (PDOException $error) {
    // Jika UPDATE gagal setelah foto baru dipindah, bersihkan foto baru.
    hapusFoto($fotoBaru);
    exit('Gagal mengubah data. Periksa NIM duplikat dan database. Gunakan tombol Kembali pada browser.');
}

// Foto lama dihapus hanya setelah UPDATE berhasil.
if ($fotoBaru !== null && $fotoLama !== null && $fotoBaru !== $fotoLama) {
    hapusFoto($fotoLama);
}

header('Location: form.php?pesan=ubah', true, 303);
exit;
