<?php
session_start();
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
                <li><a href="../index.php">Home</a></li>
                <li><a href="../products/list.php">Products</a></li>
                <li><a href="">News</a></li>
                <li><a href="">Contact</a></li>
                <li>
                    <?php
                    if (!isset($_SESSION['role'])) {
                        echo '<a href="../auth/login.php">Dashboard</a>';
                    } elseif ($_SESSION['role'] == 'admin') {
                        echo '<a href="../admin/dashboard.php">Dashboard</a>';
                    } elseif ($_SESSION['role'] == 'umkm') {
                        echo '<a href="../umkm/dashboard.php">Dashboard</a>';
                    } elseif ($_SESSION['role'] == 'customer') {
                        echo '<a href="../customer/dashboard.php">Dashboard</a>';
                    }
                    ?>
                </li>
            </ul>
        </nav>
    </header>