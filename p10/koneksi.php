<?php
// Pengaturan database XAMPP latihan di laptop ini.
$host = '127.0.0.1';
$port = 3306;
$database = 'sia_praktikum_p10';
$userDb = 'root';
$passwordDb = '';

$pdo = new PDO("mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4", $userDb, $passwordDb, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

return $pdo;
