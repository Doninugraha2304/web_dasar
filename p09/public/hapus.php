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
$query = $pdo->prepare('SELECT id, nama, nim, email FROM mahasiswa WHERE id = ?');
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
    } catch (PDOException $error) {
        exit('Gagal menghapus data. Periksa database.');
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
    <title>Hapus Mahasiswa - SIA Praktikum</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="container py-4">
<?php require __DIR__ . '/nav.php'; ?>

<!-- ===== BAGIAN 3: KONFIRMASI SEBELUM MENGHAPUS ===== -->
<h1>Hapus mahasiswa</h1>
<p>Yakin ingin menghapus mahasiswa berikut? Data tidak dapat dikembalikan.</p>
<p><?php echo htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8'); ?></p>
<form action="hapus.php" method="post">
    <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <button class="btn btn-danger" type="submit">Ya, hapus</button>
    <a href="form.php">Batal</a>
</form>
</body>
</html>
