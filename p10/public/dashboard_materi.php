<?php
// public/dashboard_materi.php - Dashboard materi P10: kode + instruksi
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Materi - P10 Upload Foto</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .code-block { background:#1e1e2e; color:#eaeaea; padding:14px; border-radius:8px; overflow-x:auto; font-size:0.85em; white-space:pre; }
    </style>
</head>
<body>
<div class="app-bar">
    <div class="container-wide d-flex align-items-center justify-content-between">
        <span class="brand">Dashboard Materi</span>
        <span class="text-white-50 small">P10 Upload Foto</span>
    </div>
</div>
<main class="container-wide">
    <div class="card-mui mb-4">
        <h1 class="h4 mb-2">📚 Dashboard Materi: P10 Upload Foto</h1>
        <p class="text-secondary-mui">Halaman ini berisi kode dan instruksi untuk menyelesaikan praktikum upload foto.</p>
    </div>

    <div class="card-mui mb-4">
        <h2 class="h5 mb-3">1. TODO / Pekerjaan Inti</h2>
        <ul>
            <li><strong>P10-1:</strong> <code>form.php</code> dan <code>edit.php</code> → lengkapi <code>enctype="multipart/form-data"</code>, input foto. Jangan hapus field csrf.</li>
            <li><strong>P10-2:</strong> <code>tambah.php</code> → ganti nilai sementara <code>$foto</code> dengan <code>simpanFoto()</code> dari helper <code>foto.php</code>. INSERT berparameter dan pembersihan saat gagal sudah disediakan.</li>
            <li><strong>P10-3:</strong> <code>ubah.php</code> → isi <code>$fotoBaru</code> dari <code>simpanFoto()</code>. Pertahankan cabang null (foto tidak diganti), UPDATE, dan hapus foto lama hanya setelah berhasil.</li>
            <li>Opsional: placeholder inisial bila foto kosong. Jangan menambah jenis file atau menghapus pemeriksaan MIME (media type atau content type).</li>
        </ul>
    </div>

    <div class="card-mui mb-4">
        <h2 class="h5 mb-3">2. Instruksi Pengujian</h2>
        <ol>
            <li>Buka <code>daftar-akun.php</code>, buat akun latihan.</li>
            <li>Login, lalu tambah mahasiswa dengan foto (JPG/PNG/GIF/WEBP, maks 1 MB).</li>
            <li>Pastikan foto tampil di tabel.</li>
            <li>Edit mahasiswa tanpa memilih foto → foto lama tetap.</li>
            <li>Edit dengan foto baru → foto lama dihapus setelah UPDATE berhasil.</li>
            <li>Uji upload file bukan gambar / >1 MB → harus ditolak.</li>
            <li>Hapus mahasiswa → foto ikut terhapus.</li>
        </ol>
    </div>

    <?php foreach ([
        '3. Kode: foto.php (helper)' => '/../foto.php',
        '4. Kode: koneksi.php' => '/../koneksi.php',
        '5. Kode: form.php' => '/form.php',
        '6. Kode: tambah.php' => '/tambah.php',
        '7. Kode: edit.php' => '/edit.php',
        '8. Kode: ubah.php' => '/ubah.php',
        '9. Kode: hapus.php' => '/hapus.php',
        '10. Kode: validasi.php' => '/validasi.php',
    ] as $title => $path): ?>
    <div class="card-mui mb-4">
        <h2 class="h5 mb-2"><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h2>
        <pre class="code-block"><?php echo htmlspecialchars(file_get_contents(__DIR__ . $path)); ?></pre>
    </div>
    <?php endforeach; ?>

    <div class="card-mui mb-4">
        <h2 class="h5 mb-3">11. Miskonsepsi Umum</h2>
        <ul>
            <li><code>$_FILES</code> kosong: periksa <code>enctype</code>, <code>name="foto"</code>, dan method POST.</li>
            <li>Foto null setelah simpan: periksa pemanggilan helper dan parameter INSERT, bukan mengganti MIME (media type atau content type) agar lolos.</li>
            <li>Upload ditolak: baca pesan ukuran/jenis. Jangan memakai nama file asli sebagai path.</li>
        </ul>
    </div>

    <div class="card-mui mb-4">
        <h2 class="h5 mb-3">12. Tugas / Latihan</h2>
        <ul>
            <li>Tambahkan validasi NIM unik di level aplikasi.</li>
            <li>Tambahkan fitur pencarian mahasiswa.</li>
            <li>Tambahkan role admin/user (otorisasi).</li>
            <li>(Tantangan) Ganti tampilan dengan template Bootstrap lain.</li>
        </ul>
    </div>

    <p><a class="link-mui" href="index.php">Kembali ke beranda (redirect ke login)</a></p>
</main>
</body>
</html>
