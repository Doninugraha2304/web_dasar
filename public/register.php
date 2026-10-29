<?php
// public/register.php - Form pendaftaran
require_once __DIR__ . '/../src/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';
    if (!csrf_check($token)) {
        flash_set('error', 'Token CSRF tidak valid.');
        header('Location: /register.php');
        exit;
    }

    $username  = trim($_POST['username'] ?? '');
    $password  = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    // Validasi dasar
    if ($username === '' || $password === '') {
        flash_set('error', 'Username dan password wajib diisi.');
        header('Location: /register.php');
        exit;
    }
    if (strlen($username) < 3) {
        flash_set('error', 'Username minimal 3 karakter.');
        header('Location: /register.php');
        exit;
    }
    if ($password !== $password2) {
        flash_set('error', 'Konfirmasi password tidak cocok.');
        header('Location: /register.php');
        exit;
    }
    if (strlen($password) < 6) {
        flash_set('error', 'Password minimal 6 karakter.');
        header('Location: /register.php');
        exit;
    }

    $res = register_user($username, $password);
    if ($res) {
        flash_set('success', 'Pendaftaran berhasil. Silakan login.');
        header('Location: /login.php');
        exit;
    } else {
        flash_set('error', 'Pendaftaran gagal. Username mungkin sudah dipakai.');
        header('Location: /register.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Daftar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Daftar</h1>

        <?php if ($err = flash_get('error')): ?>
            <div class="message error"><?php echo htmlspecialchars($err); ?></div>
        <?php endif; ?>
        <?php if ($msg = flash_get('success')): ?>
            <div class="message success"><?php echo htmlspecialchars($msg); ?></div>
        <?php endif; ?>

        <form method="post" action="/register.php">
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password2">Konfirmasi Password</label>
                <input type="password" id="password2" name="password2" required>
            </div>

            <button type="submit">Daftar</button>
        </form>

        <div class="links">
            <a href="/login.php">Sudah punya akun? Masuk</a>
        </div>
    </div>
</body>
</html>
