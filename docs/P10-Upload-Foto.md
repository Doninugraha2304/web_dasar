# Materi Teori · Pertemuan 10 — Upload Foto

Sumber: `docs/p10-upload foto/ruls.md`.

## Ringkasan

- Upload dasar: browser mengirim `multipart/form-data`; PHP menaruh file sementara di `$_FILES`.
- Database menyimpan nama file, bukan byte gambar.
- `simpanFoto()` mengembalikan nama acak atau `null` jika tidak memilih file.
- `foto.php` memeriksa error upload, batas 1 MB, MIME dari isi file dengan `finfo`, struktur gambar, dan memindahkan file dengan `move_uploaded_file`.
- `accept` di browser hanya petunjuk; server tetap memeriksa.
- Nama acak mencegah nama asli menjadi path.
- `hapusFoto()` hanya menerima pola nama yang dibuat server.
- Create boleh tanpa foto.
- Saat edit tanpa foto, kolom foto harus tetap.
- Foto lama dihapus hanya setelah UPDATE berhasil; foto baru dibersihkan bila SQL gagal.
- Folder uploads publik merupakan kompromi latihan. Apache `.htaccess` menolak skrip; PHP built-in server tidak menerapkan `.htaccess`.

## TODO

- P10-1: `form.php` dan `edit.php` → lengkapi `enctype="multipart/form-data"`, input foto, jangan hapus field csrf.
- P10-2: `tambah.php` → ganti nilai sementara `$foto` dengan `simpanFoto()` dari helper `foto.php`.
- P10-3: `ubah.php` → isi `$fotoBaru` dari `simpanFoto()`, pertahankan cabang null, UPDATE, hapus foto lama hanya setelah berhasil.

## Refleksi

1. Jelaskan aliran input sampai output pada satu TODO yang dikerjakan.
2. Sebutkan satu uji negatif dan mengapa validasi browser saja tidak cukup.

## Sumber

- PHP Manual, Handling file uploads.
- PHP Manual, finfo_file.
- PHP Manual, move_uploaded_file.
- OWASP Cheat Sheet Series, File Upload.
