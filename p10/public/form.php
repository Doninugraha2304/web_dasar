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
    <title>Data Mahasiswa + Foto - Praktikum Web Dasar P10</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="app-bar">
    <div class="container-wide d-flex align-items-center justify-content-between">
        <span class="brand">Data Mahasiswa</span>
        <span class="text-white-50 small">P10 Upload Foto</span>
    </div>
</div>
<main class="container-wide">
    <?php require __DIR__ . '/nav.php'; ?>

    <?php
    if (isset($_GET['pesan'])) {
        $pesanMap = [
            'tambah' => ['success', 'Data berhasil ditambahkan.'],
            'ubah' => ['success', 'Data berhasil diubah.'],
            'hapus' => ['success', 'Data berhasil dihapus.'],
            'foto' => ['warning', 'Foto tidak diproses; data tetap disimpan.'],
        ];
        if (isset($pesanMap[$_GET['pesan']])) {
            [$tipe, $teks] = $pesanMap[$_GET['pesan']];
            echo '<div class="alert alert-' . $tipe . ' alert-mui mb-3">' . htmlspecialchars($teks, ENT_QUOTES, 'UTF-8') . '</div>';
        }
    }
    ?>

    <div class="card-mui mb-4">
        <h2 class="h5 mb-3">Tambah mahasiswa</h2>
        <form id="form-mahasiswa" action="tambah.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($_SESSION['csrf'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label" for="nama">Nama lengkap</label>
                    <input class="form-control" id="nama" name="nama" type="text" maxlength="100" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="nim">NIM</label>
                    <input class="form-control" id="nim" name="nim" type="text" maxlength="20" required>
                </div>
                <div class="col-md-5">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" id="email" name="email" type="email" maxlength="254" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="foto">Foto (JPG/PNG/GIF/WEBP, maks 1 MB)</label>
                    <input class="form-control" id="foto" name="foto" type="file" accept="image/*">
                    <div class="text-secondary-mui mt-1">accept hanya petunjuk browser; server memeriksa MIME dari isi file.</div>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button class="btn btn-mui btn-mui-primary" type="submit">Simpan data</button>
                </div>
            </div>
        </form>
    </div>

    <h2 class="h5 mb-3">Daftar mahasiswa</h2>
    <?php
    if (count($mahasiswa) === 0) {
        echo '<div class="card-mui text-center text-secondary-mui">Belum ada data mahasiswa.</div>';
    }
    ?>
    <div class="table-responsive table-mui">
        <table class="table mb-0">
            <thead><tr><th>Foto</th><th>Nama</th><th>NIM</th><th>Email</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
            <?php
            foreach ($mahasiswa as $data) {
                $id = (int) $data['id'];
                $foto = urlFoto($data['foto'] ?? null);
                echo '<tr>';
                echo '<td style="width:90px">';
                if ($foto !== '') {
                    echo '<img class="img-thumb" src="' . htmlspecialchars($foto, ENT_QUOTES, 'UTF-8') . '" alt="foto">';
                } else {
                    $inisial = strtoupper(substr($data['nama'], 0, 1));
                    echo '<div class="avatar-initial">' . htmlspecialchars($inisial, ENT_QUOTES, 'UTF-8') . '</div>';
                }
                echo '</td>';
                echo '<td>' . htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8') . '</td>';
                echo '<td>' . htmlspecialchars($data['nim'], ENT_QUOTES, 'UTF-8') . '</td>';
                echo '<td>' . htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8') . '</td>';
                echo '<td class="text-end"><a class="btn btn-mui btn-mui-text btn-sm" href="edit.php?id=' . $id . '">Edit</a> ';
                echo '<a class="btn btn-mui btn-mui-text btn-sm" style="color:var(--mui-error,#d32f2f)" href="hapus.php?id=' . $id . '">Hapus</a></td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</main>
</body>
</html>
