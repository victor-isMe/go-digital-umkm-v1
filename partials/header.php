<?php
session_start();
include __DIR__ . '/../config/config.php';

$dashboard_link = $base_url . 'auth/login.php';

if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['role'] == 'admin') {
        $dashboard_link = $base_url . 'admin/dashboard.php';
    } elseif ($_SESSION['user']['role'] == 'umkm') {
        $dashboard_link = $base_url . 'umkm/dashboard.php';
    } elseif ($_SESSION['user']['role'] == 'customer') {
        $dashboard_link = $base_url . 'customer/dashboard.php';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Digital UMKM</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/icons/">
</head>
<body>
    <header>
        <a href="../index.php">
            <img src="../assets/images/" alt="Logo">
        </a>

        <nav>
            <ul>
                <li><a href="<?= $base_url ?>index.php">Home</a></li>
                <li><a href="<?= $base_url ?>products/list.php">Products</a></li>
                <li><a href="">News</a></li>
                <li><a href="">Contact</a></li>
                <li><a href="<?= $dashboard_link ?>">Dashboard</a></li>
            </ul>
        </nav>
    </header>