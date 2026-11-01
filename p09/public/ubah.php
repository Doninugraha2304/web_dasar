<?php
// ===== BAGIAN 1: TERIMA POST, PERIKSA TOKEN DAN LOGIN =====
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form.php');
    exit;
}
require __DIR__ . '/wajib-login.php';

// ===== BAGIAN 2: VALIDASI INPUT DAN ID =====
require __DIR__ . '/validasi.php';
$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    exit('ID tidak valid. Buka kembali form.php.');
}
$pdo = require __DIR__ . '/../koneksi.php';
$query = $pdo->prepare('SELECT id, nama, nim, email FROM mahasiswa WHERE id = ?');
$query->execute([$id]);
$data = $query->fetch(PDO::FETCH_ASSOC);
if (!$data) {
    exit('Data mahasiswa tidak ditemukan. Buka kembali form.php.');
}

// ===== BAGIAN 3: UPDATE - UBAH SATU BARIS =====
// WHERE membatasi perubahan pada ID terpilih. Tanpa WHERE, seluruh mahasiswa ikut berubah.
try {
    $query = $pdo->prepare('UPDATE mahasiswa SET nama = ?, nim = ?, email = ? WHERE id = ?');
    $query->execute([$nama, $nim, $email, $id]);
} catch (PDOException $error) {
    exit('Gagal mengubah data. Periksa NIM duplikat dan database. Gunakan tombol Kembali pada browser.');
}

// ===== BAGIAN 4: KEMBALI KE DAFTAR =====
header('Location: form.php?pesan=ubah', true, 303);
exit;
