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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="../assets/icons/">
</head>
<body>
    <header class="navbar sticky-top shadow navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a href="./index.php">
                <img src="./assets/images/logo0.png" alt="Logo" style="width: 40px;">
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <nav class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav justify-content-center text-center ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>products/list.php">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="">News</a></li>
                <li class="nav-item"><a class="nav-link" href="">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $dashboard_link ?>">Dashboard</a></li>
            </ul>
        </nav>
    </header>