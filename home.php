<?php
session_start();
if (!isset($_SESSION['user']) && !isset($_COOKIE['user'])) {
    header("Location: index.php");
    exit;
}
echo "<h1>Welcome " . ($_SESSION['user'] ?? $_COOKIE['user']) . "</h1>";
echo "<a href='logout.php'>Đăng xuất</a>";
?>
