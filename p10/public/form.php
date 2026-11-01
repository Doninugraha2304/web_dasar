<?php
// ===== BAGIAN 1: READ - AMBIL SEMUA MAHASISWA =====
require __DIR__ . '/wajib-login.php';
$pdo = require __DIR__ . '/../koneksi.php';
require __DIR__ . '/../foto.php';

$query = $pdo->query('SELECT id, nama, nim, email, foto FROM mahasiswa ORDER BY id DESC');
$mahasiswa = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Mahasiswa + Foto - SIA Praktikum P10</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="container py-4">
<?php require __DIR__ . '/nav.php'; ?>

<h1>Data Mahasiswa + Foto</h1>

<?php
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] === 'tambah') {
        echo '<p class="alert alert-success">Data berhasil ditambahkan.</p>';
    }
    if ($_GET['pesan'] === 'ubah') {
        echo '<p class="alert alert-success">Data berhasil diubah.</p>';
    }
    if ($_GET['pesan'] === 'hapus') {
        echo '<p class="alert alert-success">Data berhasil dihapus.</p>';
    }
    if ($_GET['pesan'] === 'foto') {
        echo '<p class="alert alert-warning">Foto tidak diproses; data tetap disimpan.</p>';
    }
}
?>

<h2>Tambah mahasiswa</h2>
<!-- enctype wajib agar file foto dikirim browser. -->
<form id="form-mahasiswa" action="tambah.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">
    <div class="mb-3">
        <label class="form-label" for="nama">Nama lengkap</label>
        <input class="form-control" id="nama" name="nama" type="text" maxlength="100" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="nim">NIM</label>
        <input class="form-control" id="nim" name="nim" type="text" maxlength="20" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input class="form-control" id="email" name="email" type="email" maxlength="254" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="foto">Foto (JPG/PNG/GIF/WEBP, maks 1 MB)</label>
        <!-- accept hanya petunjuk browser; server tetap memeriksa MIME dari isi file. -->
        <input class="form-control" id="foto" name="foto" type="file" accept="image/*">
    </div>
    <button class="btn btn-primary" type="submit">Simpan data</button>
</form>

<h2 class="mt-4">Daftar mahasiswa</h2>
<?php
if (count($mahasiswa) === 0) {
    echo '<p>Belum ada data mahasiswa.</p>';
}
?>
<div class="table-responsive">
<table class="table table-bordered align-middle">
    <thead><tr><th>Foto</th><th>Nama</th><th>NIM</th><th>Email</th><th>Aksi</th></tr></thead>
    <tbody>
    <?php
    foreach ($mahasiswa as $data) {
        $id = (int) $data['id'];
        $foto = urlFoto($data['foto'] ?? null);
        echo '<tr>';
        echo '<td style="width:90px">';
        if ($foto !== '') {
            echo '<img src="' . htmlspecialchars($foto, ENT_QUOTES, 'UTF-8') . '" alt="foto" style="width:72px;height:72px;object-fit:cover;border-radius:8px;">';
        } else {
            $inisial = strtoupper(substr($data['nama'], 0, 1));
            echo '<div style="width:72px;height:72px;border-radius:8px;background:#f2f1ed;display:flex;align-items:center;justify-content:center;font-weight:700;color:#D97757;">' . htmlspecialchars($inisial, ENT_QUOTES, 'UTF-8') . '</div>';
        }
        echo '</td>';
        echo '<td>' . htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($data['nim'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td><a href="edit.php?id=' . $id . '">Edit</a> ';
        echo '<a href="hapus.php?id=' . $id . '">Hapus</a></td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>
</div>
</body>
</html>
