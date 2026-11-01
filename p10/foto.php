<?php
// Helper upload foto untuk P10.
// simpanFoto() mengembalikan nama acak atau null jika tidak memilih file.
// hapusFoto() hanya menerima pola nama yang dibuat server.

function simpanFoto(array $file): ?string
{
    // Tidak memilih file: ini bukan error.
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        throw new RuntimeException('Upload gagal. Coba pilih file lagi.');
    }

    // Batas 1 MB sesuai jobsheet.
    if (($file['size'] ?? 0) > 1000000) {
        throw new RuntimeException('Ukuran foto maksimal 1 MB.');
    }

    // MIME dibaca dari isi file, bukan dari nama/accept browser.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    $ekstensi = match ($mime) {
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/webp' => 'webp',
        default => null,
    };

    if ($ekstensi === null) {
        throw new RuntimeException('Jenis file harus JPG, PNG, GIF, atau WEBP.');
    }

    // Struktur gambar diperiksa agar file bukan skrip yang disamarkan.
    if (getimagesize($file['tmp_name']) === false) {
        throw new RuntimeException('File bukan gambar yang valid.');
    }

    $nama = bin2hex(random_bytes(16)) . '.' . $ekstensi;
    $folder = __DIR__ . '/public/uploads';
    if (!is_dir($folder)) {
        mkdir($folder, 0775, true);
    }
    $tujuan = $folder . '/' . $nama;

    if (!move_uploaded_file($file['tmp_name'], $tujuan)) {
        throw new RuntimeException('Foto gagal dipindahkan ke folder upload.');
    }

    return $nama;
}

function hapusFoto(?string $nama): void
{
    if ($nama === null || $nama === '') {
        return;
    }

    // Hanya nama yang dibuat server: 32 hex + ekstensi yang diizinkan.
    if (!preg_match('/^[a-f0-9]{32}\.(jpg|png|gif|webp)$/i', $nama)) {
        return;
    }

    $path = __DIR__ . '/public/uploads/' . basename($nama);
    if (is_file($path)) {
        unlink($path);
    }
}

function urlFoto(?string $nama): string
{
    if ($nama === null || $nama === '' || !preg_match('/^[a-f0-9]{32}\.(jpg|png|gif|webp)$/i', $nama)) {
        return '';
    }
    return 'uploads/' . $nama;
}
