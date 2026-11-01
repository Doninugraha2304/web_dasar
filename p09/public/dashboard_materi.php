<?php
// public/dashboard_materi.php - Dashboard materi P09: kode + instruksi praktikum
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Materi - P09 Login Session</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .code-block { background:#1e1e2e; color:#eaeaea; padding:14px; border-radius:8px; overflow-x:auto; font-size:0.85em; line-height:1.5; white-space:pre; }
        .step { margin-bottom: 1.25rem; }
    </style>
</head>
<body class="container py-4">
    <h1 class="mb-3">📚 Dashboard Materi: P09 Login Session</h1>
    <p>Halaman ini berisi kode dan instruksi untuk menyelesaikan praktikum login/session (SIA).</p>

    <div class="step">
        <h2>1. Persiapan</h2>
        <ul>
            <li>Jalankan MySQL (port 3306 atau 3307, sesuaikan di <code>koneksi.php</code>).</li>
            <li>Import <code>database.sql</code> lewat phpMyAdmin.</li>
            <li>Jalankan server dari folder <code>public</code>: <code>php -S localhost:8000</code>.</li>
        </ul>
    </div>

    <div class="step">
        <h2>2. Instruksi Pengujian</h2>
        <ol>
            <li>Buka <code>daftar-akun.php</code>, buat akun latihan.</li>
            <li>Buka <code>login.php</code>, masuk dengan akun tersebut.</li>
            <li>Pastikan redirect ke <code>form.php</code> dan nama tampil di navigasi.</li>
            <li>Coba akses <code>form.php</code> tanpa login (harus redirect ke login).</li>
            <li>Tambah/edit/hapus data mahasiswa.</li>
            <li>Klik Keluar (POST bertoken), pastikan session berakhir.</li>
        </ol>
    </div>

    <div class="step">
        <h2>3. Kode: koneksi.php</h2>
        <pre class="code-block"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/../koneksi.php')); ?></pre>
    </div>

    <div class="step">
        <h2>4. Kode: keamanan.php (session + CSRF)</h2>
        <pre class="code-block"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/keamanan.php')); ?></pre>
    </div>

    <div class="step">
        <h2>5. Kode: login.php</h2>
        <pre class="code-block"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/login.php')); ?></pre>
    </div>

    <div class="step">
        <h2>6. Kode: daftar-akun.php</h2>
        <pre class="code-block"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/daftar-akun.php')); ?></pre>
    </div>

    <div class="step">
        <h2>7. Kode: wajib-login.php</h2>
        <pre class="code-block"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/wajib-login.php')); ?></pre>
    </div>

    <div class="step">
        <h2>8. Kode: form.php (daftar + tambah)</h2>
        <pre class="code-block"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/form.php')); ?></pre>
    </div>

    <div class="step">
        <h2>9. Kode: tambah.php</h2>
        <pre class="code-block"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/tambah.php')); ?></pre>
    </div>

    <div class="step">
        <h2>10. Kode: ubah.php</h2>
        <pre class="code-block"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/ubah.php')); ?></pre>
    </div>

    <div class="step">
        <h2>11. Kode: hapus.php</h2>
        <pre class="code-block"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/hapus.php')); ?></pre>
    </div>

    <div class="step">
        <h2>12. Kode: validasi.php</h2>
        <pre class="code-block"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/validasi.php')); ?></pre>
    </div>

    <div class="step">
        <h2>13. Tugas / Latihan</h2>
        <ul>
            <li>Tambahkan validasi NIM unik di level aplikasi.</li>
            <li>Tambahkan fitur pencarian mahasiswa.</li>
            <li>Tambahkan role admin/user (otorisasi).</li>
            <li>(Tantangan) Ganti tampilan dengan template Bootstrap lain.</li>
        </ul>
    </div>

    <p><a href="index.php">Kembali ke beranda (redirect ke login)</a></p>
</body>
</html>
