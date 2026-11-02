# Tutorial Menjalankan Proyek di XAMPP

Dokumen ini khusus untuk mahasiswa yang memakai XAMPP (Windows/Mac).

## 1. Install & Jalankan XAMPP

1. Download XAMPP dari https://www.apachefriends.org
2. Install (Windows: `C:\xampp`, Mac: `/Applications/XAMPP`)
3. Buka **XAMPP Control Panel**
4. Klik **Start** pada **Apache** dan **MySQL**
5. Pastikan status hijau (Running)

## 2. Ambil Kode

### Clone
```bash
cd C:\xampp\htdocs
git clone https://github.com/Doninugraha2304/web_dasar.git
```

### Pull (update)
```bash
cd C:\xampp\htdocs\web_dasar
git pull origin main
```

## 3. Setup Database

### Buka phpMyAdmin
`http://localhost/phpmyadmin`

### Import P09
1. Tab **Import**
2. Pilih file: `C:\xampp\htdocs\web_dasar\p09\database.sql`
3. Klik **Go**

### Import P10
1. Tab **Import**
2. Pilih file: `C:\xampp\htdocs\web_dasar\p10\database.sql`
3. Klik **Go**

Database yang dibuat:
- P09: `sia_praktikum`
- P10: `sia_praktikum_p10`

## 4. Konfigurasi Port MySQL

Buka:
- `p09/koneksi.php`
- `p10/koneksi.php`

Sesuaikan:
```php
$port = 3306; // XAMPP standar
// paket lab biasanya 3307
```

## 5. Menjalankan Aplikasi

### P09
Buka browser:
```
http://localhost/web_dasar/p09/public/daftar-akun.php
```

### P10
Buka browser:
```
http://localhost/web_dasar/p10/public/daftar-akun.php
```

### Cek koneksi
```
http://localhost/web_dasar/p09/public/cek-koneksi.php
http://localhost/web_dasar/p10/public/cek-koneksi.php
```

## 6. Alur Penggunaan

1. Buat akun di `daftar-akun.php`
2. Login di `login.php`
3. Kelola data di `form.php`
4. Untuk P10: upload foto (JPG/PNG/GIF/WEBP, maks 1 MB)
5. Logout via tombol Keluar

## 7. Troubleshooting XAMPP

| Masalah | Solusi |
| --- | --- |
| Apache tidak start | Port 80 dipakai; ubah port Apache atau matikan aplikasi lain. |
| MySQL tidak start | Port 3306 dipakai; ubah port di `my.ini` dan `koneksi.php`. |
| "Unknown database" | Import `database.sql` dulu. |
| "Access denied" | Cek username/password di `koneksi.php`. |
| CSS tidak muncul | Buka lewat `http://localhost/...`, jangan buka file langsung. |
| Upload gagal | Cek ukuran (<=1MB) dan jenis file; lihat pesan error. |

## 8. Catatan

- Gunakan data fiktif.
- PHP built-in server tidak menerapkan `.htaccess`.
- Folder `uploads/` publik adalah kompromi latihan, bukan produksi.
