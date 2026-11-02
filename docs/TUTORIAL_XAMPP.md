# Tutorial Lengkap Menjalankan Proyek di XAMPP (Monorepo)

Dokumen ini untuk mahasiswa yang memakai XAMPP di Windows/macOS/Linux. Karena direktori instalasi bisa berbeda, ikuti bagian yang sesuai.

## 1. Lokasi XAMPP yang Umum

- Windows: `C:\xampp`
- macOS: `/Applications/XAMPP`
- Linux: `/opt/lampp`

Folder web (document root):
- Windows: `C:\xampp\htdocs`
- macOS: `/Applications/XAMPP/htdocs`
- Linux: `/opt/lampp/htdocs`

## 2. Jalankan XAMPP

1. Buka XAMPP Control Panel.
2. Start **Apache**.
3. Start **MySQL**.
4. Pastikan status hijau.

Jika MySQL gagal start, lihat bagian Troubleshooting.

## 3. Ambil Kode

### Opsi A: Git Clone
Buka terminal/CMD:

Windows:
```bash
cd C:\xampp\htdocs
git clone https://github.com/Doninugraha2304/web_dasar.git
```

macOS/Linux:
```bash
cd /Applications/XAMPP/htdocs
git clone https://github.com/Doninugraha2304/web_dasar.git
```

### Opsi B: Download ZIP
1. Download ZIP dari GitHub.
2. Ekstrak.
3. Rename folder menjadi `web_dasar`.
4. Pindahkan ke `htdocs`.

## 4. Struktur yang Harus Ada

```text
htdocs/web_dasar/
├── p09/
├── p10/
├── docs/
├── site/
├── README.md
└── vercel.json
```

Jika folder terlalu dalam (mis. `htdocs/web_dasar/web_dasar`), pindahkan isi folder dalam ke `htdocs/web_dasar`.

## 5. Setup Database

### Buka phpMyAdmin
- `http://localhost/phpmyadmin`

### Import P09
1. Tab **Import**
2. Choose file:
   - Windows: `C:\xampp\htdocs\web_dasar\p09\database.sql`
   - macOS: `/Applications/XAMPP/htdocs/web_dasar/p09/database.sql`
3. Klik **Go**

### Import P10
1. Tab **Import**
2. Choose file:
   - Windows: `C:\xampp\htdocs\web_dasar\p10\database.sql`
   - macOS: `/Applications/XAMPP/htdocs/web_dasar/p10/database.sql`
3. Klik **Go**

Database:
- P09: `sia_praktikum` (diubah menjadi Praktikum Web Dasar pada tampilan)
- P10: `sia_praktikum_p10`

## 6. Konfigurasi Port MySQL

Buka file:
- `p09/koneksi.php`
- `p10/koneksi.php`

XAMPP standar:
```php
$port = 3306;
```

Paket lab:
```php
$port = 3307;
```

## 7. Jalankan Aplikasi

### P09
```text
http://localhost/web_dasar/p09/public/daftar-akun.php
```

### P10
```text
http://localhost/web_dasar/p10/public/daftar-akun.php
```

### Cek koneksi
```text
http://localhost/web_dasar/p09/public/cek-koneksi.php
http://localhost/web_dasar/p10/public/cek-koneksi.php
```

## 8. Alur Penggunaan

1. Buat akun di `daftar-akun.php`
2. Login di `login.php`
3. Kelola data di `form.php`
4. P10: upload foto (JPG/PNG/GIF/WEBP, maks 1 MB)
5. Logout via tombol Keluar

## 9. Jika Direktori Berbeda

### Port Apache bukan 80
Jika Apache memakai port 8080:
```text
http://localhost:8080/web_dasar/p09/public/daftar-akun.php
```

### Folder tidak di htdocs
Jika folder diletakkan di tempat lain, pindahkan ke `htdocs` atau ubah `DocumentRoot` di `httpd.conf`.

### Path Windows dengan spasi
Gunakan tanda kutip:
```bash
cd "C:\xampp\htdocs\web_dasar"
```

## 10. Troubleshooting

| Masalah | Solusi |
| --- | --- |
| Apache tidak start | Port 80 dipakai. Ubah port Apache atau matikan aplikasi lain. |
| MySQL tidak start | Port 3306 dipakai. Ubah port di `my.ini` dan `koneksi.php`. |
| Unknown database | Import `database.sql` dulu. |
| Access denied | Cek user/password di `koneksi.php`. |
| CSS/JS tidak muncul | Buka lewat `http://localhost/...`, jangan buka file langsung. |
| Upload gagal | Cek ukuran <=1MB dan jenis file. |
| File tidak ditemukan | Pastikan struktur folder `p09/public` dan `p10/public`. |

## 11. Update Kode

```bash
cd htdocs/web_dasar
git pull origin main
```

Jika ada konflik:
```bash
git stash
git pull origin main
git stash pop
```

## 12. Catatan Keamanan

- Gunakan data fiktif.
- PHP built-in server tidak menerapkan `.htaccess`.
- Folder `uploads/` publik adalah kompromi latihan, bukan produksi.
- Untuk produksi: gunakan storage di luar webroot, HTTPS, dan validasi ketat.