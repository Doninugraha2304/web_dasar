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
    http_response_code(400);
    echo '<!doctype html><html lang="id"><head><meta charset="UTF-8"><link rel="stylesheet" href="css/bootstrap.min.css"><link rel="stylesheet" href="css/style.css"></head><body><div class="container-narrow" style="margin-top:2rem"><div class="card-mui"><div class="alert alert-danger alert-mui">Foto tidak valid: ' . htmlspecialchars($error->getMessage(), ENT_QUOTES, 'UTF-8') . '</div><a class="btn btn-mui btn-mui-secondary mt-2" href="form.php">Kembali</a></div></div></body></html>';
    exit;
}

try {
    $query = $pdo->prepare('INSERT INTO mahasiswa (nama, nim, email, foto) VALUES (?, ?, ?, ?)');
    $query->execute([$nama, $nim, $email, $foto]);
} catch (PDOException $error) {
    // Jika SQL gagal setelah file dipindah, bersihkan file baru.
    hapusFoto($foto);
    http_response_code(400);
    echo '<!doctype html><html lang="id"><head><meta charset="UTF-8"><link rel="stylesheet" href="css/bootstrap.min.css"><link rel="stylesheet" href="css/style.css"></head><body><div class="container-narrow" style="margin-top:2rem"><div class="card-mui"><div class="alert alert-danger alert-mui">Gagal menambah data. Periksa NIM duplikat dan database.</div><a class="btn btn-mui btn-mui-secondary mt-2" href="form.php">Kembali</a></div></div></body></html>';
    exit;
}

header('Location: form.php?pesan=tambah', true, 303);
exit;
