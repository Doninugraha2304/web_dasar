<?php
// ===== BAGIAN 1: AMBIL ID DARI GET ATAU POST =====
require __DIR__ . '/wajib-login.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
} else {
    $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
}
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

// ===== BAGIAN 2: DELETE HANYA SETELAH POST =====
// Membuka tautan Hapus dengan GET belum menghapus apa pun.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $query = $pdo->prepare('DELETE FROM mahasiswa WHERE id = ?');
        $query->execute([$id]);
        // Hapus file foto setelah data berhasil dihapus.
        hapusFoto($data['foto'] ?? null);
    } catch (PDOException $error) {
        http_response_code(400);
        echo '<!doctype html><html lang="id"><head><meta charset="UTF-8"><link rel="stylesheet" href="css/bootstrap.min.css"><link rel="stylesheet" href="css/style.css"></head><body><div class="container-narrow" style="margin-top:2rem"><div class="card-mui"><div class="alert alert-danger alert-mui">Gagal menghapus data. Periksa database.</div><a class="btn btn-mui btn-mui-secondary mt-2" href="form.php">Kembali</a></div></div></body></html>';
        exit;
    }
    header('Location: form.php?pesan=hapus', true, 303);
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hapus Mahasiswa - Praktikum Web Dasar</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="app-bar">
    <div class="container-wide d-flex align-items-center justify-content-between">
        <span class="brand">Hapus Mahasiswa</span>
        <span class="text-white-50 small">P10 Upload Foto</span>
    </div>
</div>
<main class="container-narrow">
    <?php require __DIR__ . '/nav.php'; ?>
    <div class="card-mui">
        <h1 class="h4 mb-2">Hapus mahasiswa</h1>
        <p class="text-secondary-mui mb-3">Yakin ingin menghapus mahasiswa berikut? Data tidak dapat dikembalikan.</p>
        <div class="card-mui mb-3" style="background:#fafafa">
            <strong><?php echo htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8'); ?></strong>
            <div class="text-secondary-mui"><?php echo htmlspecialchars($data['nim'], ENT_QUOTES, 'UTF-8'); ?> &middot; <?php echo htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8'); ?></div>
        </div>
        <form action="hapus.php" method="post" class="d-flex gap-2">
            <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($_SESSION['csrf'], ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button class="btn btn-mui btn-mui-danger" type="submit">Ya, hapus</button>
            <a class="btn btn-mui btn-mui-secondary" href="form.php">Batal</a>
        </form>
    </div>
</main>
</body>
</html>
