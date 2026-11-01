<?php
// 1. Ambil input teks. trim menghapus spasi di awal dan akhir.
$nama = '';
$nim = '';
$email = '';
if (isset($_POST['nama']) && is_string($_POST['nama'])) {
    $nama = trim($_POST['nama']);
}
if (isset($_POST['nim']) && is_string($_POST['nim'])) {
    $nim = trim($_POST['nim']);
}
if (isset($_POST['email']) && is_string($_POST['email'])) {
    $email = trim($_POST['email']);
}

// 2. Server memeriksa ulang input meskipun HTML sudah memakai required.
if ($nama === '' || $nim === '' || $email === '') {
    exit('Semua isian wajib diisi. Gunakan tombol Kembali pada browser.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit('Email tidak valid. Gunakan tombol Kembali pada browser.');
}
if (mb_strlen($nama) > 100 || mb_strlen($nim) > 20 || mb_strlen($email) > 254) {
    exit('Isian terlalu panjang. Gunakan tombol Kembali pada browser.');
}
