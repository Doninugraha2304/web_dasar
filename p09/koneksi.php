<?php
// Pengaturan database XAMPP latihan di laptop ini.
// Port bawaan XAMPP biasanya 3306. Paket laboratorium memakai 3307; sesuaikan bila perlu.
$host = '127.0.0.1';
$port = 3306;
$database = 'sia_praktikum';
$userDb = 'root';
// Nama $passwordDb sengaja dibedakan dari $password milik form login.
// File ini dijalankan dengan require, sehingga variabelnya ikut masuk ke file pemanggil.
// Jika namanya sama, password yang diketik pengguna akan tertimpa string kosong.
$passwordDb = '';

// PDO menghubungkan PHP dengan database. ERRMODE_EXCEPTION membuat kesalahan SQL dapat ditangkap try/catch.
$pdo = new PDO("mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4", $userDb, $passwordDb, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

return $pdo;
