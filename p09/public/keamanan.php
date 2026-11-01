<?php
// 1. Session menyimpan token dan status login milik browser ini.
// httponly: cookie tidak dapat dibaca JavaScript. samesite Lax: cookie tidak ikut pada POST dari situs lain.
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
    session_start();
}
if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

// 2. Setiap POST harus membawa token yang sama dengan session.
// Ini mencegah pengiriman perubahan data dari halaman lain tanpa token.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf'] ?? '';
    if (!is_string($token) || !hash_equals($_SESSION['csrf'], $token)) {
        http_response_code(400);
        exit('Permintaan tidak valid. Buka kembali halaman sebelumnya.');
    }
}
