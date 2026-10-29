<?php
// Keluar hanya melalui POST bertoken, sehingga tautan dari situs lain tidak dapat memaksa logout.
require __DIR__ . '/keamanan.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form.php', true, 303);
    exit;
}

// 1. Kosongkan data session. 2. Hapus cookie session. 3. Hancurkan session di server.
$_SESSION = [];
$cookie = session_get_cookie_params();
setcookie(session_name(), '', time() - 3600, $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httponly']);
session_destroy();

header('Location: login.php?pesan=keluar', true, 303);
exit;
