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
    <title>Masuk - SIA Praktikum</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="container py-5" style="max-width: 420px">

<h1 class="h3 mb-3">Masuk SIA Praktikum</h1>
<!-- ===== BAGIAN 3: PESAN ===== -->
<?php
if ($pesan !== '') {
    echo '<p class="alert alert-danger">' . $pesan . '</p>';
}
if (($_GET['pesan'] ?? '') === 'akun') {
    echo '<p class="alert alert-success">Akun berhasil dibuat. Silakan masuk.</p>';
}
if (($_GET['pesan'] ?? '') === 'keluar') {
    echo '<p class="alert alert-secondary">Anda sudah keluar.</p>';
}
?>
<!-- ===== BAGIAN 4: FORM LOGIN ===== -->
<form action="login.php" method="post">
    <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">
    <div class="mb-3">
        <label class="form-label" for="username">Username</label>
        <input class="form-control" id="username" name="username" type="text" maxlength="30" autocomplete="username" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="password">Password</label>
        <input class="form-control" id="password" name="password" type="password" maxlength="72" autocomplete="current-password" required>
    </div>
    <button class="btn btn-primary w-100" type="submit">Masuk</button>
</form>
<p class="mt-3 small">Belum punya akun latihan? <a href="daftar-akun.php">Buat akun</a></p>
</body>
</html>
