<?php
// Halaman yang memanggil file ini hanya dapat dibuka setelah login.
// Urutan: periksa session dan token (keamanan.php), lalu periksa status login.
require __DIR__ . '/keamanan.php';
if (!isset($_SESSION['pengguna'])) {
    header('Location: login.php', true, 303);
    exit;
}
// $pengguna dipakai nav.php untuk menampilkan nama yang sedang login.
$pengguna = $_SESSION['pengguna'];
