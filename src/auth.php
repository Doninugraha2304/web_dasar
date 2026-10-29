<?php
// src/auth.php
// Fungsi-fungsi autentikasi dasar.
require_once __DIR__ . '/config.php';

/**
 * Cari user berdasarkan username.
 */
function find_user_by_username($username) {
    global $db;
    $stmt = $db->prepare('SELECT id, username, password FROM users WHERE username = :u LIMIT 1');
    $stmt->execute([':u' => $username]);
    return $stmt->fetch();
}

/**
 * Registrasi user baru.
 * Password di-hash dengan bcrypt (PASSWORD_DEFAULT).
 */
function register_user($username, $password) {
    global $db;

    // Cek duplikasi username
    if (find_user_by_username($username)) {
        return false;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare('INSERT INTO users (username, password) VALUES (:u, :p)');
    try {
        $stmt->execute([':u' => $username, ':p' => $hash]);
        return $db->lastInsertId();
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Login user.
 * Mengembalikan true jika username & password cocok.
 */
function login_user($username, $password) {
    $user = find_user_by_username($username);
    if (!$user) {
        return false;
    }

    // Verifikasi password terhadap hash yang tersimpan
    if (password_verify($password, $user['password'])) {
        // Regenerasi session ID untuk mencegah session fixation
        session_regenerate_id(true);

        // Simpan data user minimal ke session
        $_SESSION['user'] = [
            'id'       => $user['id'],
            'username' => $user['username'],
        ];
        return true;
    }

    return false;
}

/**
 * Logout: hapus data session dan cookie session.
 */
function logout_user() {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'],
            $params['secure'], $params['httponly']
        );
    }
    session_destroy();
}

/**
 * Ambil user yang sedang login (atau null).
 */
function current_user() {
    return $_SESSION['user'] ?? null;
}

/**
 * Wajib login: redirect ke login.php jika belum login.
 */
function require_login() {
    if (!current_user()) {
        flash_set('error', 'Anda harus login terlebih dahulu.');
        header('Location: /login.php');
        exit;
    }
}
