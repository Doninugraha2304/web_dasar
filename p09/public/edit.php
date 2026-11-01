<?php
// ===== BAGIAN 1: READ - CARI SATU MAHASISWA =====
require __DIR__ . '/wajib-login.php';
$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    exit('ID tidak valid. Buka kembali form.php.');
}
$pdo = require __DIR__ . '/../koneksi.php';
// ID pada URL hanya memilih data; perubahan disimpan oleh ubah.php.
$query = $pdo->prepare('SELECT id, nama, nim, email FROM mahasiswa WHERE id = ?');
$query->execute([$id]);
$data = $query->fetch(PDO::FETCH_ASSOC);
if (!$data) {
    exit('Data mahasiswa tidak ditemukan. Buka kembali form.php.');
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Mahasiswa - SIA Praktikum</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="container py-4">
<?php require __DIR__ . '/nav.php'; ?>

<h1>Edit mahasiswa</h1>
<!-- ===== BAGIAN 2: FORM DENGAN NILAI LAMA ===== -->
<!-- Input hidden membawa ID agar server tahu baris yang akan diubah. -->
<form action="ubah.php" method="post">
    <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="mb-3">
        <label class="form-label" for="nama">Nama lengkap</label>
        <input class="form-control" id="nama" name="nama" type="text" maxlength="100" value="<?php echo htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="nim">NIM</label>
        <input class="form-control" id="nim" name="nim" type="text" maxlength="20" value="<?php echo htmlspecialchars($data['nim'], ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input class="form-control" id="email" name="email" type="email" maxlength="254" value="<?php echo htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>
    <button class="btn btn-primary" type="submit">Simpan perubahan</button>
    <a href="form.php">Batal</a>
</form>
</body>
</html>
