<?php
// public/login.php - Form login
require_once __DIR__ . '/../src/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';
    if (!csrf_check($token)) {
        flash_set('error', 'Token CSRF tidak valid.');
        header('Location: /login.php');
        exit;
    }

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        flash_set('error', 'Username dan password wajib diisi.');
        header('Location: /login.php');
        exit;
    }

    if (login_user($username, $password)) {
        flash_set('success', 'Login berhasil.');
        header('Location: /dashboard.php');
        exit;
    } else {
        flash_set('error', 'Username atau password salah.');
        header('Location: /login.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Masuk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Masuk</h1>

        <?php if ($err = flash_get('error')): ?>
            <div class="message error"><?php echo htmlspecialchars($err); ?></div>
        <?php endif; ?>
        <?php if ($msg = flash_get('success')): ?>
            <div class="message success"><?php echo htmlspecialchars($msg); ?></div>
        <?php endif; ?>

        <form method="post" action="/login.php">
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Masuk</button>
        </form>

        <div class="links">
            <a href="/register.php">Belum punya akun? Daftar</a>
        </div>
    </div>
</body>
</html>
