# Web Dasar - Pertemuan: Login / Autentikasi (PHP Native)

Materi praktikum dasar untuk mata kuliah/praktikum **Web Dasar** dengan topik **Login / Autentikasi** menggunakan **PHP native** (tanpa framework) dan **MySQL**.

## Tujuan Pembelajaran

Setelah pertemuan ini, mahasiswa mampu:

1. Memahami konsep autentikasi (register, login, logout).
2. Menyimpan password dengan aman menggunakan `password_hash()` dan `password_verify()`.
3. Menggunakan session PHP untuk menjaga status login.
4. Melindungi halaman agar hanya bisa diakses user yang sudah login.
5. Menggunakan prepared statement untuk mencegah SQL injection.
6. (Bonus) Memahami CSRF token dasar.

## Struktur Folder

```
web_dasar_prak/
├── README.md
├── sql/
│   └── webdasar_auth.sql
├── src/
│   ├── config.php      # konfigurasi DB, session, helper
│   └── auth.php        # fungsi autentikasi
├── public/             # document root (jalankan server dari sini)
│   ├── index.php
│   ├── register.php
│   ├── login.php
│   ├── logout.php
│   ├── dashboard.php
│   └── style.css
└── docs/
    └── materi.md       # catatan teori & latihan
```

## Cara Menjalankan

1. Pastikan PHP 7.4+ dan MySQL/MariaDB terpasang.
2. Buat database (otomatis juga dibuat oleh `config.php`, tapi bisa manual):

   ```sql
   CREATE DATABASE webdasar_auth CHARACTER SET utf8mb4;
   ```

3. Sesuaikan kredensial di `src/config.php` jika perlu (default: host=localhost, user=root, pass='').
4. Jalankan server bawaan PHP dari folder `public`:

   ```bash
   cd public
   php -S localhost:8000
   ```

5. Buka browser: `http://localhost:8000/index.php`
6. Materi + kode + instruksi praktikum: `http://localhost:8000/dashboard_materi.php`

## Alur Aplikasi

```
Register -> simpan user (password di-hash)
Login    -> verifikasi password -> buat session
Dashboard -> halaman terproteksi (butuh login)
Logout   -> hapus session
```

## Akun

Tidak ada akun bawaan. Silakan **Daftar** terlebih dahulu, lalu **Masuk**.

## Catatan Keamanan

- Password tidak pernah disimpan dalam bentuk teks biasa.
- Query menggunakan prepared statement (PDO).
- Session ID diregenerasi saat login (cegah session fixation).
- Output di-escape dengan `htmlspecialchars()`.
- CSRF token pada form.
- Ini contoh pembelajaran; untuk produksi tambahkan HTTPS, rate limiting, validasi password kuat, dll.
