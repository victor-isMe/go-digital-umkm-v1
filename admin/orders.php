<?php
require_once "../config/database.php";
require_once "../core/functions.php";

checkLogin();
checkRole("admin");

$stmt = $pdo->query("SELECT orders.*, users.name AS cust_name
                    FROM orders
                    JOIN users ON orders.customer_id = users_id
                    ORDER BY orders.created_at DESC
                    ");
        
$orders = $stmt->fetchAll();
?>

<h2>Semua Transaksi</h2>

<a href="dashboard.php">Kembali</a>

<hr>

<?php foreach ($orders as $order): ?>
    <div>
        Order ID: <?= $order["id"] ?><br>
        Customer: <?= $order["cust_name"] ?><br>
        Total: Rp<?= $order["total_price"] ?><br>
        Metode Bayar: <?= $order["payment_method"] ?><br>
        Status: <?= $order["status"] ?><br>
        Tanggal: <?= $order["created_at"] ?><br>
        <hr>
    </div>
<?php endforeach; ?>