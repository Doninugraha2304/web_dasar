# Praktikum Web Dasar - Pertemuan 10 (Upload Foto)

Lanjutan P09: CRUD mahasiswa ditambah upload foto.

Fitur:
- login/session + CSRF
- upload foto JPG/PNG/GIF/WEBP (maks 1 MB)
- validasi MIME (media type atau content type) dari isi file (finfo)
- nama file acak
- hapus foto lama hanya setelah UPDATE berhasil
- placeholder inisial jika foto kosong

## Struktur

| File | Tugas |
| --- | --- |
| `koneksi.php` | Koneksi PDO ke database `sia_praktikum_p10` |
| `database.sql` | Database + tabel mahasiswa (kolom foto) + pengguna |
| `foto.php` | Helper `simpanFoto()`, `hapusFoto()`, `urlFoto()` |
| `public/form.php` | Daftar + form tambah (multipart) |
| `public/tambah.php` | Create + upload foto |
| `public/edit.php` | Form edit (multipart) |
| `public/ubah.php` | Update + ganti foto |
| `public/hapus.php` | Delete + hapus foto |
| `public/validasi.php` | Validasi input server |
| `public/uploads/` | Folder foto (latihan lokal) |
| `public/dashboard_materi.php` | Materi + kode + instruksi |

## Cara menjalankan

1. Import `database.sql`.
2. Sesuaikan port di `koneksi.php` (3306/3307).
3. Jalankan dari folder `public`:
   ```bash
   cd p10/public
   php -S localhost:8002
   ```
4. Buka `http://localhost:8002/daftar-akun.php`.

## Catatan keamanan

- `accept` di browser hanya petunjuk; server tetap cek MIME (media type atau content type) dan struktur gambar.
- Nama file asli tidak dipakai sebagai path.
- Folder `uploads` publik adalah kompromi latihan; `.htaccess` menolak skrip pada Apache.
- PHP built-in server tidak menerapkan `.htaccess`.
- Aplikasi ini untuk latihan lokal, bukan produksi.
