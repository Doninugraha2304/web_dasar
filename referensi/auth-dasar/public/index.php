<?php
// public/index.php - Halaman beranda
require_once __DIR__ . '/../src/auth.php';
$user = current_user();
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Web Dasar - Login/Auth</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Selamat Datang<?php echo $user ? ', ' . htmlspecialchars($user['username']) : ''; ?></h1>

        <?php if (isset($_GET['loggedout'])): ?>
            <div class="message success">Anda telah keluar.</div>
        <?php endif; ?>
        <?php if ($msg = flash_get('success')): ?>
            <div class="message success"><?php echo htmlspecialchars($msg); ?></div>
        <?php endif; ?>
        <?php if ($err = flash_get('error')): ?>
            <div class="message error"><?php echo htmlspecialchars($err); ?></div>
        <?php endif; ?>

        <p>Ini adalah contoh aplikasi dasar autentikasi dengan PHP native.</p>

        <?php if ($user): ?>
            <div class="links">
                <a href="/dashboard.php">Dashboard</a> |
                <a href="/dashboard_materi.php">Materi &amp; Kode</a> |
                <a href="/logout.php">Keluar</a>
            </div>
        <?php else: ?>
            <div class="links">
                <a href="/register.php">Daftar</a> |
                <a href="/login.php">Masuk</a> |
                <a href="/dashboard_materi.php">Materi &amp; Kode</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
