-- Database untuk materi Web Dasar - Login/Auth
CREATE DATABASE IF NOT EXISTS webdasar_auth CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE webdasar_auth;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
