<?php
// public/logout.php - Handler logout
require_once __DIR__ . '/../src/auth.php';

logout_user();
header('Location: /index.php?loggedout=1');
exit;
?>
