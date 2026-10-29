<?php
// public/dashboard_materi.php - Dashboard materi + kode + instruksi praktikum
require_once __DIR__ . '/../src/auth.php';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Dashboard Materi - Login/Auth</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .materi-wrap { max-width: 980px; margin: 0 auto; text-align: left; }
        .materi-wrap h1 { text-align: center; }
        .step { background:#f8f9ff; border:1px solid #e0e7ff; border-radius:10px; padding:18px; margin-bottom:18px; }
        .step h2 { color:#4f46e5; margin-bottom:10px; font-size:1.25em; }
        .step h3 { color:#764ba2; margin:12px 0 6px; font-size:1.05em; }
        pre.code { background:#1e1e2e; color:#eaeaea; padding:14px; border-radius:8px; overflow-x:auto; font-size:0.85em; line-height:1.5; }
        code.inline { background:#eef2ff; color:#4f46e5; padding:2px 6px; border-radius:4px; font-size:0.9em; }
        .task { background:#fff8e1; border-left:4px solid #ffa726; padding:12px 14px; border-radius:6px; margin:10px 0; }
        .ok { background:#e8f5e9; border-left:4px solid #4caf50; padding:12px 14px; border-radius:6px; margin:10px 0; }
    </style>
</head>
<body>
<div class="container materi-wrap">
    <h1>📚 Dashboard Materi: Login / Auth (PHP Native)</h1>
    <p>Halaman ini berisi kode dan instruksi untuk menyelesaikan praktikum login/auth.</p>

    <div class="step">
        <h2>1. Persiapan</h2>
        <ul>
            <li>Pastikan PHP &amp; MySQL (atau MariaDB) terpasang.</li>
            <li>Buat folder proyek seperti struktur di README.</li>
            <li>Jalankan server: <code class="inline">cd public && php -S localhost:8000</code></li>
        </ul>
        <div class="ok">Database &amp; tabel dibuat otomatis oleh <code class="inline">src/config.php</code>.</div>
    </div>

    <div class="step">
        <h2>2. Struktur Folder</h2>
        <pre class="code">web_dasar_prak/
├── sql/webdasar_auth.sql
├── src/config.php
├── src/auth.php
└── public/
    ├── index.php
    ├── register.php
    ├── login.php
    ├── logout.php
    ├── dashboard.php
    └── style.css</pre>
    </div>

    <div class="step">
        <h2>3. Kode: src/config.php</h2>
        <pre class="code"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/../src/config.php')); ?></pre>
    </div>

    <div class="step">
        <h2>4. Kode: src/auth.php</h2>
        <pre class="code"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/../src/auth.php')); ?></pre>
    </div>

    <div class="step">
        <h2>5. Kode: public/register.php</h2>
        <pre class="code"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/register.php')); ?></pre>
    </div>

    <div class="step">
        <h2>6. Kode: public/login.php</h2>
        <pre class="code"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/login.php')); ?></pre>
    </div>

    <div class="step">
        <h2>7. Kode: public/dashboard.php</h2>
        <pre class="code"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/dashboard.php')); ?></pre>
    </div>

    <div class="step">
        <h2>8. Instruksi Pengujian</h2>
        <ol>
            <li>Buka <code class="inline">http://localhost:8000/register.php</code>, daftar user baru.</li>
            <li>Buka <code class="inline">http://localhost:8000/login.php</code>, login dengan akun tersebut.</li>
            <li>Pastikan redirect ke <code class="inline">dashboard.php</code> dan nama user tampil.</li>
            <li>Coba akses <code class="inline">dashboard.php</code> tanpa login (harus redirect ke login).</li>
            <li>Klik logout, pastikan session berakhir.</li>
            <li>Coba SQL injection di form login (harus gagal karena prepared statement).</li>
        </ol>
    </div>

    <div class="step">
        <h2>9. Tugas / Latihan</h2>
        <div class="task">Tambahkan kolom <code class="inline">email</code> pada tabel users dan field email di form register.</div>
        <div class="task">Buat halaman <code class="inline">profile.php</code> untuk mengganti password.</div>
        <div class="task">Tambahkan validasi: username hanya boleh huruf dan angka.</div>
        <div class="task">(Tantangan) Tambahkan role admin/user dan batasi akses halaman admin.</div>
    </div>

    <div class="links">
        <a href="/index.php">Beranda</a> |
        <a href="/register.php">Daftar</a> |
        <a href="/login.php">Masuk</a> |
        <a href="/dashboard.php">Dashboard</a>
    </div>
</div>
</body>
</html>
