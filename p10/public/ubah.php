<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form.php');
    exit;
}
require __DIR__ . '/wajib-login.php';
require __DIR__ . '/validasi.php';

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    http_response_code(400);
    echo '<!doctype html><html lang="id"><head><meta charset="UTF-8"><link rel="stylesheet" href="css/bootstrap.min.css"><link rel="stylesheet" href="css/style.css"></head><body><div class="container-narrow" style="margin-top:2rem"><div class="card-mui"><div class="alert alert-danger alert-mui">ID tidak valid.</div><a class="btn btn-mui btn-mui-secondary mt-2" href="form.php">Kembali</a></div></div></body></html>';
    exit;
}

$pdo = require __DIR__ . '/../koneksi.php';
require __DIR__ . '/../foto.php';

$query = $pdo->prepare('SELECT id, nama, nim, email, foto FROM mahasiswa WHERE id = ?');
$query->execute([$id]);
$data = $query->fetch(PDO::FETCH_ASSOC);
if (!$data) {
    http_response_code(404);
    echo '<!doctype html><html lang="id"><head><meta charset="UTF-8"><link rel="stylesheet" href="css/bootstrap.min.css"><link rel="stylesheet" href="css/style.css"></head><body><div class="container-narrow" style="margin-top:2rem"><div class="card-mui"><div class="alert alert-danger alert-mui">Data mahasiswa tidak ditemukan.</div><a class="btn btn-mui btn-mui-secondary mt-2" href="form.php">Kembali</a></div></div></body></html>';
    exit;
}
$fotoLama = $data['foto'] ?? null;

$fotoBaru = null;
try {
    $fotoBaru = simpanFoto($_FILES['foto'] ?? []);
} catch (RuntimeException $error) {
    http_response_code(400);
    echo '<!doctype html><html lang="id"><head><meta charset="UTF-8"><link rel="stylesheet" href="css/bootstrap.min.css"><link rel="stylesheet" href="css/style.css"></head><body><div class="container-narrow" style="margin-top:2rem"><div class="card-mui"><div class="alert alert-danger alert-mui">Foto tidak valid: ' . htmlspecialchars($error->getMessage(), ENT_QUOTES, 'UTF-8') . '</div><a class="btn btn-mui btn-mui-secondary mt-2" href="edit.php?id=' . $id . '">Kembali</a></div></div></body></html>';
    exit;
}

// Jika tidak memilih foto, pertahankan foto lama (cabang null).
$fotoSimpan = $fotoBaru !== null ? $fotoBaru : $fotoLama;

try {
    $query = $pdo->prepare('UPDATE mahasiswa SET nama = ?, nim = ?, email = ?, foto = ? WHERE id = ?');
    $query->execute([$nama, $nim, $email, $fotoSimpan, $id]);
} catch (PDOException $error) {
    // Jika UPDATE gagal setelah foto baru dipindah, bersihkan foto baru.
    hapusFoto($fotoBaru);
    http_response_code(400);
    echo '<!doctype html><html lang="id"><head><meta charset="UTF-8"><link rel="stylesheet" href="css/bootstrap.min.css"><link rel="stylesheet" href="css/style.css"></head><body><div class="container-narrow" style="margin-top:2rem"><div class="card-mui"><div class="alert alert-danger alert-mui">Gagal mengubah data. Periksa NIM duplikat dan database.</div><a class="btn btn-mui btn-mui-secondary mt-2" href="edit.php?id=' . $id . '">Kembali</a></div></div></body></html>';
    exit;
}

// Foto lama dihapus hanya setelah UPDATE berhasil.
if ($fotoBaru !== null && $fotoLama !== null && $fotoBaru !== $fotoLama) {
    hapusFoto($fotoLama);
}

header('Location: form.php?pesan=ubah', true, 303);
exit;
