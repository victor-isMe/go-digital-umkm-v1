<?php
require_once "../config/database.php";
require_once "../core/functions.php";

checkLogin();
checkRole("umkm");

$user_id = $_SESSION["user"]["id"];

$stmt = $pdo->prepare("SELECT DISTINCT orders.* FROM orders
                        JOIN order_items ON orders.id = order_items.order_id
                        JOIN products ON order_items.product_id = products.id
                        WHERE products.user_id = ?
                        ORDER BY orders.created_at DESC    
                    ");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll();
?>

<h2>Pesanan Masuk</h2>

<?php foreach ($orders as $order): ?>
    <div>
        Order ID: <?= $order["id"] ?><br>
        Total: Rp<?= $order["total_price"] ?><br>
        Status: <?= $order["status"] ?><br>

        <a href="update_status.php?id=<?= $order["id"] ?>&status=diproses">Proses</a> |
        <a href="update_status.php?id=<?= $order["id"] ?>&status=selesai">Selesai</a>

        <hr>
    </div>
<?php endforeach; ?>