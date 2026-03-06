<?php
require_once "../config/database.php";
require_once "../core/functions.php";

checkLogin();
checkRole("customer");

$cust_id = $_SESSION["user"]["id"];

$stmt = $pdo->prepare("SELECT * FROM orders WHERE customer_id=? ORDER BY created_at DESC");
$stmt->execute([$cust_id]);
$orders = $stmt->fetchAll();
?>

<h2>Pesanan Saya</h2>

<?php foreach ($orders as $order): ?>
    <div>
        Order ID: <?= $order["id"] ?><br>
        Total: Rp<?= $order["total_price"] ?><br>
        Status: <?= $order["status"] ?><br>
        <hr>
    </div>
<?php endforeach; ?>