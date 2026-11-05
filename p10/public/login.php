<?php
// ===== BAGIAN 1: SIAPKAN SESSION =====
require __DIR__ . '/keamanan.php';
if (isset($_SESSION['pengguna'])) {
    header('Location: form.php', true, 303);
    exit;
}
$pesan = '';

// ===== BAGIAN 2: PERIKSA USERNAME DAN PASSWORD =====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Koneksi dibuka lebih dulu, baru input dibaca, agar variabel koneksi tidak menimpa input.
    $pdo = require __DIR__ . '/../koneksi.php';
    $username = is_string($_POST['username'] ?? null) ? trim($_POST['username']) : '';
    $password = is_string($_POST['password'] ?? null) ? $_POST['password'] : '';
    $query = $pdo->prepare('SELECT id, nama, password_hash FROM pengguna WHERE username = ?');
    $query->execute([$username]);
    $akun = $query->fetch(PDO::FETCH_ASSOC);

    // password_verify membandingkan password yang diketik dengan hash di database.
    if ($akun && password_verify($password, $akun['password_hash'])) {
        // ID session baru mencegah penyerang memakai ID session lama (session fixation).
        session_regenerate_id(true);
        $_SESSION['pengguna'] = ['id' => (int) $akun['id'], 'nama' => $akun['nama']];
        header('Location: form.php', true, 303);
        exit;
    }
    // Pesan sengaja dibuat sama agar tidak membocorkan username mana yang terdaftar.
    $pesan = 'Username atau password salah.';
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - Praktikum Web Dasar</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="app-bar">
    <div class="container-wide d-flex align-items-center justify-content-between">
        <span class="brand">Praktikum Web Dasar<span class="brand-sub">/ P10</span></span>
    </div>
</div>
<main>
    <div class="login-shell">
        <div class="login-brand">
            <span class="badge-pill">Upload Foto &middot; CRUD Mahasiswa</span>
            <h1>Selamat datang kembali</h1>
            <p>Kelola data mahasiswa lengkap dengan foto. Masuk untuk melanjutkan ke dashboard.</p>
        </div>
        <div class="card-mui">
            <h1 class="card-title">Masuk</h1>
            <p class="card-subtitle">Gunakan akun latihan Anda.</p>

            <?php
            if ($pesan !== '') {
                echo '<div class="alert alert-danger alert-mui mb-3">' . htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8') . '</div>';
            }
            if (($_GET['pesan'] ?? '') === 'akun') {
                echo '<div class="alert alert-success alert-mui mb-3">Akun berhasil dibuat. Silakan masuk.</div>';
            }
            if (($_GET['pesan'] ?? '') === 'keluar') {
                echo '<div class="alert alert-secondary alert-mui mb-3">Anda sudah keluar.</div>';
            }
            ?>
            <form action="login.php" method="post">
                <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($_SESSION['csrf'], ENT_QUOTES, 'UTF-8'); ?>">
                <div class="mb-3">
                    <label class="form-label" for="username">Username</label>
                    <input class="form-control" id="username" name="username" type="text" maxlength="30" autocomplete="username" required placeholder="nama_pengguna">
                </div>
                <div class="mb-4">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" id="password" name="password" type="password" maxlength="72" autocomplete="current-password" required placeholder="••••••••">
                </div>
                <button class="btn btn-mui btn-mui-primary w-100" type="submit">Masuk</button>
            </form>
            <p class="mt-3 mb-0 text-secondary-mui">Belum punya akun latihan? <a class="link-mui" href="daftar-akun.php">Buat akun</a></p>
        </div>
    </div>
</main>
</body>
</html>
