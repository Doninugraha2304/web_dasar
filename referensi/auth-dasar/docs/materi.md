# Materi Dasar: Login / Autentikasi (PHP Native)

## 1. Apa itu Autentikasi?

Autentikasi adalah proses memverifikasi identitas pengguna.
Alur dasar:

1. **Register**: pengguna membuat akun (username + password).
2. **Login**: sistem memverifikasi username & password.
3. **Session**: sistem "mengingat" pengguna yang sudah login.
4. **Logout**: sistem menghapus session.

> Autentikasi (siapa kamu?) berbeda dengan Otorisasi (apa yang boleh kamu lakukan?).

## 2. Menyimpan Password dengan Aman

Jangan simpan password dalam bentuk teks biasa. Gunakan:

```php
// Saat register
$hash = password_hash($password, PASSWORD_DEFAULT);

// Saat login
if (password_verify($password, $hashDariDatabase)) {
    // password cocok
}
```

`password_hash()` menghasilkan hash bcrypt yang sudah mengandung "salt".

## 3. Database (MySQL)

Tabel `users`:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## 4. Koneksi Database (PDO)

```php
$db = new PDO("mysql:host=localhost;dbname=webdasar_auth;charset=utf8mb4", "root", "");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```

## 5. Prepared Statement (Cegah SQL Injection)

```php
$stmt = $db->prepare('SELECT * FROM users WHERE username = :u');
$stmt->execute([':u' => $username]);
$user = $stmt->fetch();
```

Jangan gabungkan input user langsung ke string SQL.

## 6. Session Management

```php
session_start();                 // mulai session
$_SESSION['user'] = [...];       // simpan data user
session_regenerate_id(true);      // cegah session fixation (saat login)
session_destroy();               // hapus session (saat logout)
```

Halaman terproteksi:

```php
function require_login() {
    if (!isset($_SESSION['user'])) {
        header('Location: /login.php');
        exit;
    }
}
```

## 7. CSRF Token (Dasar)

Token unik disimpan di session dan dikirim lewat hidden input form.
Saat form disubmit, bandingkan token dari form dengan token di session.

## 8. Latihan

1. Tambahkan kolom `email` pada tabel users dan field email di form register.
2. Buat halaman `profile.php` untuk mengganti password.
3. Tambahkan validasi: username hanya boleh huruf dan angka.
4. (Tantangan) Tambahkan role (admin/user) dan batasi akses halaman admin.

## 9. Checklist Keamanan Dasar

- [x] Password di-hash (`password_hash`)
- [x] Verifikasi dengan `password_verify`
- [x] Prepared statement (PDO)
- [x] Escape output (`htmlspecialchars`)
- [x] Regenerasi session ID saat login
- [x] Hapus session saat logout
- [ ] HTTPS (untuk produksi)
- [ ] Rate limiting (untuk produksi)
