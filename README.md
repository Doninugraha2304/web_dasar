# SIA Praktikum - Pertemuan 9 (Login Session)

Kode awal praktikum Pemrograman Web. Lanjutan dari CRUD Mahasiswa (Praktikum 5-7).

Fitur pada tahap ini:
- login dan logout dengan session
- password disimpan sebagai hash (password_hash)
- semua halaman data hanya terbuka setelah login

## Cara menjalankan

1. Pastikan Apache (atau PHP built-in server) dan MySQL berjalan.
2. Import `database.sql` melalui phpMyAdmin (tab Import). File ini membuat database `sia_praktikum` dan aman diimpor ulang.
3. Sesuaikan port pada `koneksi.php`: paket laboratorium `3307`, XAMPP standar `3306`.
4. Jalankan server dari folder `public`:
   ```bash
   cd public
   php -S localhost:8000
   ```
5. Buka `http://localhost:8000/daftar-akun.php`, buat akun latihan, lalu masuk melalui `login.php`.

Jalankan melalui web server (http://localhost/...), jangan buka file langsung.

## Struktur folder

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

## Catatan keamanan

- Gunakan data fiktif. Jangan memakai password yang Anda pakai di akun lain.
- `daftar-akun.php` hanya untuk latihan lokal. Pada sistem nyata akun dibuat oleh admin.
- Paket ini untuk laptop sendiri (localhost), belum siap dipasang di server publik.

## Referensi tambahan

Versi auth dasar (tanpa CRUD) tersedia di folder `referensi/auth-dasar/`.
Materi teori + latihan: `referensi/auth-dasar/docs/materi.md`.
