<?php
require_once "../config/database.php";
require_once "../core/functions.php";

checkLogin();
checkRole("admin");

$totalRevenue = $pdo->query("SELECT SUM(total_price) 
                            FROM orders 
                            WHERE status='selesai'")->fetchColumn();

$totalOrders = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();

$stmt = $pdo->query("SELECT products.name,
                    SUM(order_items.quantity) AS total_jual
                    FROM order_items
                    JOIN products ON order_items.product_id=products.id
                    GROUP BY products.id
                    ORDER BY total_jual DESC");

$productSales = $stmt->fetchAll();

$stmt = $pdo->query("SELECT users.name, 
                    SUM(order_items.quantity) AS total_jual
                    FROM order_items
                    JOIN products ON order_items.product_id=products.id
                    JOIN users ON products.user_id=users.id
                    GROUP BY users.id
                    ORDER BY total_jual DESC");

$umkmSales = $stmt->fetchAll();
?>

<h1>Laporan Marketplace</h1>

<a href="dashboard.php">Kembali</a>

<hr>

<h3>Ringkasan</h3>

Total Pendapatan: Rp<?= $totalRevenue ?><br>
Total Transaksi: <?= $totalOrders ?><br>

<hr>

<h3>Produk Terlaris</h3>

<?php foreach ($productSales as $product): ?>
    <div>
        <?= $product["name"] ?> - Terjual <?= $product["total_jual"] ?> produk.
    </div>
<?php endforeach; ?>

<hr>

<h3>UMKM Terlaris</h3>

<?php foreach ($umkmSales as $umkm): ?>
    <div>
        <?= $umkm["name"] ?> - Terjual <?= $umkm["total_jual"] ?> produk.
    </div>
<?php endforeach; ?>