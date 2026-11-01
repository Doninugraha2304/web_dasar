<?php
// ===== BAGIAN 1: SIAPKAN SESSION =====
// Halaman ini hanya untuk latihan lokal. Pada sistem nyata, akun dibuat oleh admin.
require __DIR__ . '/keamanan.php';
$pesan = '';

// ===== BAGIAN 2: VALIDASI DAN SIMPAN AKUN =====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Koneksi dibuka lebih dulu, baru input dibaca, agar variabel koneksi tidak menimpa input.
    $pdo = require __DIR__ . '/../koneksi.php';
    $username = is_string($_POST['username'] ?? null) ? trim($_POST['username']) : '';
    $nama = is_string($_POST['nama'] ?? null) ? trim($_POST['nama']) : '';
    $password = is_string($_POST['password'] ?? null) ? $_POST['password'] : '';
    $ulang = is_string($_POST['ulang'] ?? null) ? $_POST['ulang'] : '';

    if (!preg_match('/^[a-z0-9_]{4,30}$/', $username)) {
        $pesan = 'Username 4-30 karakter: huruf kecil, angka, atau garis bawah.';
    } elseif ($nama === '' || mb_strlen($nama) > 100) {
        $pesan = 'Nama wajib diisi, maksimal 100 karakter.';
    } elseif (strlen($password) < 8 || strlen($password) > 72) {
        $pesan = 'Password 8-72 karakter.';
    } elseif (!hash_equals($password, $ulang)) {
        $pesan = 'Konfirmasi password tidak sama.';
    } else {
        try {
            // password_hash membuat hash bcrypt dengan salt acak. Hasilnya berbeda setiap kali dibuat.
            $query = $pdo->prepare('INSERT INTO pengguna (username, nama, password_hash) VALUES (?, ?, ?)');
            $query->execute([$username, $nama, password_hash($password, PASSWORD_DEFAULT)]);
            header('Location: login.php?pesan=akun', true, 303);
            exit;
        } catch (PDOException $error) {
            $pesan = 'Username sudah dipakai. Pilih username lain.';
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Akun - SIA Praktikum</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="container py-5" style="max-width: 420px">

<h1 class="h3 mb-3">Buat akun latihan</h1>
<?php
if ($pesan !== '') {
    echo '<p class="alert alert-danger">' . $pesan . '</p>';
}
?>
<!-- ===== BAGIAN 3: FORM AKUN ===== -->
<form action="daftar-akun.php" method="post">
    <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">
    <div class="mb-3">
        <label class="form-label" for="username">Username</label>
        <input class="form-control" id="username" name="username" type="text" pattern="[a-z0-9_]{4,30}" maxlength="30" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="nama">Nama lengkap</label>
        <input class="form-control" id="nama" name="nama" type="text" maxlength="100" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="password">Password (minimal 8 karakter)</label>
        <input class="form-control" id="password" name="password" type="password" minlength="8" maxlength="72" autocomplete="new-password" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="ulang">Ulangi password</label>
        <input class="form-control" id="ulang" name="ulang" type="password" minlength="8" maxlength="72" autocomplete="new-password" required>
    </div>
    <button class="btn btn-primary w-100" type="submit">Buat akun</button>
</form>
<p class="mt-3 small"><a href="login.php">Kembali ke halaman masuk</a></p>
</body>
</html>
