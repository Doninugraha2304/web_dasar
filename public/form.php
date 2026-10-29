<?php
// ===== BAGIAN 1: READ - AMBIL SEMUA MAHASISWA =====
// wajib-login.php memastikan halaman ini hanya terbuka setelah login.
require __DIR__ . '/wajib-login.php';
$pdo = require __DIR__ . '/../koneksi.php';
// DESC berarti urut dari ID terbesar (data terbaru).
$query = $pdo->query('SELECT id, nama, nim, email FROM mahasiswa ORDER BY id DESC');
$mahasiswa = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Mahasiswa - SIA Praktikum</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="container py-4">
<?php require __DIR__ . '/nav.php'; ?>

<h1>Data Mahasiswa</h1>
<!-- ===== BAGIAN 2: PESAN HASIL ===== -->
<?php
// Pesan tetap ditentukan program, bukan mencetak isi URL secara langsung.
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
}
?>
<!-- ===== BAGIAN 3: CREATE - FORM TAMBAH ===== -->
<h2>Tambah mahasiswa</h2>
<form id="form-mahasiswa" action="tambah.php" method="post">
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
    <button class="btn btn-primary" type="submit">Simpan data</button>
</form>

<!-- ===== BAGIAN 4: READ - TABEL DI BAWAH FORM ===== -->
<h2 class="mt-4">Daftar mahasiswa</h2>
<?php
if (count($mahasiswa) === 0) {
    echo '<p>Belum ada data mahasiswa.</p>';
}
?>
<div class="table-responsive">
<table class="table table-bordered align-middle" id="tabel-mahasiswa">
    <thead><tr><th>Nama</th><th>NIM</th><th>Email</th><th>Aksi</th></tr></thead>
    <tbody>
    <?php
    // foreach mengulang setiap mahasiswa menjadi satu baris tabel.
    // htmlspecialchars membuat input tampil sebagai teks biasa.
    foreach ($mahasiswa as $data) {
        $id = (int) $data['id'];
        echo '<tr>';
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
