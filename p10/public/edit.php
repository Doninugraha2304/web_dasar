<?php
require __DIR__ . '/wajib-login.php';
$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
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
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Mahasiswa + Foto - Praktikum Web Dasar P10</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="app-bar">
    <div class="container-wide d-flex align-items-center justify-content-between">
        <span class="brand">Edit Mahasiswa</span>
        <span class="text-white-50 small">P10 Upload Foto</span>
    </div>
</div>
<main class="container-narrow">
    <?php require __DIR__ . '/nav.php'; ?>
    <div class="card-mui">
        <h1 class="h4 mb-3">Edit mahasiswa</h1>
        <?php
        $fotoUrl = urlFoto($fotoLama);
        if ($fotoUrl !== '') {
            echo '<div class="mb-3"><img class="img-thumb" src="' . htmlspecialchars($fotoUrl, ENT_QUOTES, 'UTF-8') . '" alt="foto lama" style="width:96px;height:96px;"></div>';
        } else {
            echo '<p class="text-secondary-mui mb-3">Belum ada foto.</p>';
        }
        ?>
        <form action="ubah.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($_SESSION['csrf'], ENT_QUOTES, 'UTF-8'); ?>">
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
            <div class="mb-3">
                <label class="form-label" for="foto">Ganti foto (kosongkan jika tetap)</label>
                <input class="form-control" id="foto" name="foto" type="file" accept="image/*">
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-mui btn-mui-primary" type="submit">Simpan perubahan</button>
                <a class="btn btn-mui btn-mui-secondary" href="form.php">Batal</a>
            </div>
        </form>
    </div>
</main>
</body>
</html>
