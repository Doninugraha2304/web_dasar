# SIA Praktikum - Pertemuan 9 (Login Session)

Kode awal praktikum Pemrograman Web. Lanjutan dari CRUD Mahasiswa (Praktikum 5-7).

Fitur pada tahap ini:
- login dan logout dengan session
- password disimpan sebagai hash (password_hash)
- semua halaman data hanya terbuka setelah login

---

## 1. Prasyarat

Sebelum menjalankan, pastikan sudah terpasang:

- **PHP 7.4+** (biasanya sudah ada di XAMPP)
- **MySQL / MariaDB** (XAMPP/Laragon/MAMP)
- **Git** (untuk clone/pull kode)
- **Web browser** (Chrome/Edge/Firefox)

> Rata-rata mahasiswa memakai XAMPP, jadi tutorial di bawah mengikuti XAMPP (Windows). Jika pakai Laragon/MAMP, sesuaikan path/port.

---

## 2. Ambil Kode dari GitHub (Clone / Pull)

### Clone (pertama kali)
Buka terminal/CMD, lalu:
```bash
git clone https://github.com/Doninugraha2304/web_dasar.git
cd web_dasar
```

### Pull (jika sudah ada folder dan ingin update)
```bash
cd web_dasar
git pull origin main
```

---

## 3. Setup Database MySQL

### Cara A: phpMyAdmin (paling mudah)
1. Jalankan **Apache** dan **MySQL** di XAMPP Control Panel.
2. Buka browser: `http://localhost/phpmyadmin`
3. Klik tab **Import**.
4. Pilih file `database.sql` dari folder proyek.
5. Klik **Go / Kirim**.
   - File ini membuat database `sia_praktikum` dan tabel `mahasiswa`, `pengguna`.
   - Aman diimpor ulang (tidak menimpa data lama secara kasar).

### Cara B: Command Line (CLI)
```bash
mysql -u root -p < database.sql
```
(Jika password root kosong, tekan Enter.)

---

## 4. Konfigurasi Koneksi (`koneksi.php`)

Buka file `koneksi.php`, sesuaikan port MySQL:

```php
$host = '127.0.0.1';
$port = 3306;          // XAMPP standar: 3306 | Paket lab: 3307
$database = 'sia_praktikum';
$userDb = 'root';
$passwordDb = '';
```

- **XAMPP standar** → port `3306`
- **Paket laboratorium** → port `3307`

Jika koneksi gagal, cek:
- MySQL sudah running?
- Port sudah benar?
- Ekstensi `pdo_mysql` aktif di PHP?

---

## 5. Menjalankan Aplikasi

### Cara A: Pakai Apache XAMPP (disarankan untuk mahasiswa)
1. Copy folder `web_dasar` ke `C:\xampp\htdocs\` (Windows) atau `/Applications/XAMPP/htdocs/` (Mac).
2. Jalankan Apache + MySQL di XAMPP.
3. Buka browser:
   - `http://localhost/web_dasar/public/daftar-akun.php`
   - atau `http://localhost/web_dasar/public/login.php`

### Cara B: PHP Built-in Server (tanpa Apache)
Dari folder proyek:
```bash
cd public
php -S localhost:8000
```
Lalu buka `http://localhost:8000`.

> Jika error "Address already in use", ganti port, mis. `php -S localhost:8001`.

---

## 6. Alur Penggunaan

1. Buka `daftar-akun.php`, buat akun latihan (username + password).
2. Buka `login.php`, masuk dengan akun tersebut.
3. Setelah login, redirect ke `form.php` (data mahasiswa).
4. Tambah/edit/hapus data mahasiswa.
5. Klik **Keluar** (POST bertoken) untuk logout.

Coba juga:
- Akses `form.php` tanpa login → harus redirect ke `login.php`.
- Login dengan password salah → pesan error.
- Refresh halaman setelah submit → tidak mengulang INSERT (karena HTTP 303).

---

## 7. Struktur Folder

| File | Tugas |
| --- | --- |
| `koneksi.php` | Koneksi PDO ke database `sia_praktikum` |
| `database.sql` | Membuat database dan tabel; aman dijalankan ulang |
| `public/login.php` | Masuk (`password_verify`, `session_regenerate_id`) |
| `public/daftar-akun.php` | Membuat akun latihan (`password_hash`) |
| `public/logout.php` | Keluar melalui POST bertoken |
| `public/wajib-login.php` | Penjaga halaman: alihkan ke login bila belum masuk |
| `public/nav.php` | Navigasi dan tombol Keluar |
| `public/form.php` | Daftar dan tambah mahasiswa |
| `public/tambah.php`, `edit.php`, `ubah.php`, `hapus.php` | CRUD mahasiswa |
| `public/cek-koneksi.php` | Tes koneksi database |
| `public/dashboard_materi.php` | Materi + kode + instruksi praktikum |
| `referensi/auth-dasar/` | Versi auth dasar (tanpa CRUD) |

---

## 8. Tutorial MySQL (Detail untuk Mahasiswa)

Lihat file: `docs/TUTORIAL_MYSQL.md`

Ringkasan:
- MySQL default port `3306`.
- Buat database `sia_praktikum`.
- Import `database.sql`.
- Pastikan user `root` bisa login (password kosong di XAMPP).
- Jika error "Access denied", set password root atau buat user baru.

---

## 9. Troubleshooting

| Masalah | Solusi |
| --- | --- |
| "Koneksi database gagal" | Cek MySQL running, port, username/password di `koneksi.php`. |
| "could not find driver" | Aktifkan `pdo_mysql` di `php.ini` (hapus `;` di `extension=pdo_mysql`). |
| Halaman blank | Cek error log Apache / jalankan `php -l file.php`. |
| CSS tidak muncul | Pastikan akses lewat `http://localhost/...`, bukan buka file langsung. |
| Port 3306 dipakai | Ubah port di `koneksi.php` atau ganti port MySQL. |
| Git pull conflict | `git stash`, lalu `git pull`, lalu `git stash pop`. |

---

## 10. Catatan Keamanan

- Gunakan data fiktif. Jangan memakai password yang Anda pakai di akun lain.
- `daftar-akun.php` hanya untuk latihan lokal. Pada sistem nyata akun dibuat oleh admin.
- Paket ini untuk laptop sendiri (localhost), belum siap dipasang di server publik.
- Untuk produksi: tambahkan HTTPS, rate limiting, validasi password kuat, dll.

---

## Referensi tambahan

- Versi auth dasar (tanpa CRUD): `referensi/auth-dasar/`
- Materi teori + latihan: `referensi/auth-dasar/docs/materi.md`
- Materi P09 + kode: `public/dashboard_materi.php`
