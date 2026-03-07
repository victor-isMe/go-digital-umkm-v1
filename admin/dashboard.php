<?php
require_once "../config/database.php";
require_once "../core/functions.php";

checkLogin();
checkRole("admin");

$total_users = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$total_umkm = $pdo->query("SELECT COUNT(*) FROM users WHERE role='umkm'")->fetchColumn();
$total_products = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$total_orders = $pdo->query("SELECT COUNT (*) FROM orders")->fetchColumn();
$total_pendapatan = $pdo->query("SELECT SUM(total_price) FROM orders WHERE status='selesai'")->fetchColumn();
?>

<h1>Dashboard Admin</h1>

<a href="users.php">Kelola User</a> |
<a href="products.php">Lihat Produk UMKM</a> |
<a href="categories.php">Kelola Kategori Produk</a> |
<a href="orders.php">Lihat Transaksi</a> |
<a href="../auth/logout.php">Logout</a>

<hr>

<h3>Statistik Platform</h3>

Total User: <?= $total_users ?><br>
Total UMKM: <?= $total_umkm ?><br>
Total Produk: <?= $total_products ?><br>
Total Order: <?= $total_orders ?><br>
Total Pendapatan: Rp<?= $total_pendapatan ?><br>