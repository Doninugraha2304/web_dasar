# Tutorial MySQL untuk Mahasiswa (XAMPP)

Dokumen ini menjelaskan cara setup MySQL agar proyek SIA Praktikum P09 berjalan.

## 1. Pastikan MySQL Berjalan

### XAMPP (Windows/Mac)
1. Buka **XAMPP Control Panel**.
2. Klik **Start** pada **Apache** dan **MySQL**.
3. Pastikan status MySQL berwarna hijau (Running).

Jika MySQL tidak mau start:
- Port 3306 mungkin dipakai aplikasi lain.
- Buka `C:\xampp\mysql\bin\my.ini`, ubah port (mis. 3307), lalu restart.
- Sesuaikan port di `koneksi.php`.

---

## 2. Buat Database & Tabel

### Cara A: phpMyAdmin (disarankan)
1. Buka `http://localhost/phpmyadmin`
2. Klik tab **Import**.
3. Pilih file `database.sql` dari folder proyek.
4. Klik **Go**.

Hasil:
- Database `sia_praktikum` dibuat.
- Tabel `mahasiswa` dan `pengguna` dibuat.

### Cara B: Command Line
Buka CMD/Terminal:
```bash
mysql -u root -p
```
Masukkan password (kosong di XAMPP, tekan Enter), lalu:
```sql
SOURCE C:/xampp/htdocs/web_dasar/database.sql;
```
Sesuaikan path file.

---

## 3. Cek Database
Di phpMyAdmin:
- Klik database `sia_praktikum`.
- Pastikan ada tabel `mahasiswa` dan `pengguna`.

Atau via CLI:
```sql
USE sia_praktikum;
SHOW TABLES;
DESCRIBE pengguna;
```

---

## 4. Konfigurasi `koneksi.php`

```php
$host = '127.0.0.1';
$port = 3306;        // sesuaikan (3306 atau 3307)
$database = 'sia_praktikum';
$userDb = 'root';
$passwordDb = '';    // kosong di XAMPP default
```

---

## 5. Tes Koneksi

Buka di browser:
```
http://localhost/web_dasar/public/cek-koneksi.php
```
Harus muncul: "Koneksi database MySQL berhasil!"

Jika gagal:
- Cek MySQL running.
- Cek port.
- Cek username/password.
- Cek ekstensi `pdo_mysql` di `php.ini`.

---

## 6. User & Password MySQL (Jika Perlu)

### Ganti password root (opsional)
Di phpMyAdmin, tab **User accounts** → edit user `root` → ubah password.
Lalu update `koneksi.php` (`$passwordDb`).

### Buat user baru (opsional)
```sql
CREATE USER 'sia_user'@'localhost' IDENTIFIED BY 'password123';
GRANT ALL PRIVILEGES ON sia_praktikum.* TO 'sia_user'@'localhost';
FLUSH PRIVILEGES;
```
Lalu update `koneksi.php`:
```php
$userDb = 'sia_user';
$passwordDb = 'password123';
```

---

## 7. Port MySQL

- Default XAMPP: `3306`
- Paket lab: `3307`

Cara cek port yang dipakai MySQL:
```sql
SHOW VARIABLES LIKE 'port';
```

---

## 8. Backup & Reset Database

### Backup (dump)
```bash
mysqldump -u root -p sia_praktikum > backup_sia.sql
```

### Reset (hapus & import ulang)
```sql
DROP DATABASE IF EXISTS sia_praktikum;
```
Lalu import `database.sql` lagi.

---

## 9. Troubleshooting MySQL

| Masalah | Solusi |
| --- | --- |
| "Access denied for user 'root'" | Password salah; reset password root atau sesuaikan `koneksi.php`. |
| "Unknown database 'sia_praktikum'" | Import `database.sql` dulu. |
| "Table doesn't exist" | Import ulang `database.sql`. |
| "pdo_mysql not found" | Aktifkan `extension=pdo_mysql` di `php.ini`, restart Apache. |
| Port bentrok | Ubah port di `my.ini` dan `koneksi.php`. |

---

## 10. Tips untuk Mahasiswa

- Gunakan data fiktif saat latihan.
- Jangan memakai password pribadi.
- Simpan backup database sebelum eksperimen.
- Jika error, baca pesan error dengan teliti (biasanya menyebut baris/file).
