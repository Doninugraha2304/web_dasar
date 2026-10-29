<?php
// public/dashboard.php - Halaman terproteksi (butuh login)
require_once __DIR__ . '/../src/auth.php';

require_login();
$user = current_user();
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>

        <p>Selamat datang, <strong><?php echo htmlspecialchars($user['username']); ?></strong>!</p>
        <p>Halaman ini hanya bisa diakses setelah login.</p>

        <div class="links">
            <a href="/index.php">Beranda</a> |
            <a href="/dashboard_materi.php">Materi &amp; Kode</a> |
            <a href="/logout.php">Keluar</a>
        </div>
    </div>
</body>
</html>
