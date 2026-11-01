# Web Dasar Praktikum — Monorepo

Repositori ini berisi materi praktikum web dasar (PHP native + MySQL) dalam satu monorepo:

- `p09/` — Pertemuan 9: Login Session + CRUD Mahasiswa
- `p10/` — Pertemuan 10: Upload Foto (integrasi helper aman)
- `referensi/auth-dasar/` — Versi auth dasar tanpa CRUD
- `docs/` — Materi teori, tutorial MySQL, catatan dosen
- `site/` — Frontend statis untuk dokumentasi (deploy Vercel)

## Struktur

```text
web_dasar_prak/
├── p09/
├── p10/
├── referensi/auth-dasar/
├── docs/
├── site/
├── vercel.json
└── README.md
```

## Clone / Pull

```bash
git clone https://github.com/Doninugraha2304/web_dasar.git
cd web_dasar

# update
git pull origin main
```

## Menjalankan P09

```bash
cd p09/public
php -S localhost:8000
```
Buka `http://localhost:8000/daftar-akun.php`.

Database: `sia_praktikum` (import `p09/database.sql`).

## Menjalankan P10

```bash
cd p10/public
php -S localhost:8002
```
Buka `http://localhost:8002/daftar-akun.php`.

Database: `sia_praktikum_p10` (import `p10/database.sql`).

## Dokumentasi

- Frontend statis: folder `site/`
- Presentasi interaktif: `site/presentasi.html`
- Vercel deploy: import repo, Vercel membaca `vercel.json` (`outputDirectory: site`).
- Tutorial MySQL: `docs/TUTORIAL_MYSQL.md`
- Materi P09: `p09/public/dashboard_materi.php`
- Materi P10: `p10/public/dashboard_materi.php`

## Catatan

- Gunakan data fiktif.
- Port MySQL XAMPP standar `3306`; paket lab `3307`.
- Upload foto maksimal 1 MB (JPG/PNG/GIF/WEBP).
- Folder `uploads/` publik adalah kompromi latihan; bukan untuk produksi.
