<?php
require_once "../config/database.php";
require_once "../core/functions.php";

checkLogin();
checkRole("customer");

$order_id = $_GET["id"];
$cust_id = $_SESSION["user"]["id"];

$stmt = $pdo->prepare("SELECT * FROM orders WHERE id=? AND cust_id=?");
$stmt->execute([$order_id, $cust_id]);
$order = $stmt->fetch();

if (!$order) {
    die("Order tidak ditemukan.");
}

$stmt = $pdo->prepare("SELECT 
                        order_items.*,
                        products.name
                        FROM order_items
                        JOIN products ON order_items.product_id=products.id
                        WHERE order_items.order_id=?
                    ");
$stmt->execute([$order_id]);
$items = $stmt->fetchAll();
?>

<h2>Detail Pesanan</h2>

Order ID: <?= $order["id"] ?><br>
Tanggal: <?= $order["created_at"] ?><br>
Status: <?= $order["status"] ?><br>
Metode Bayar: <?= $order["payment_method"] ?><br>

<hr>

<h3>Detail Produk</h3>

<?php
$total = 0;
foreach ($items as $item):
    $subtotal = $item["price"] * $item["quantity"];
    $total += $subtotal;
?>

    <div>
        <strong><?= $item["name"] ?></strong><br>
        Quantity: <?= $item["quantity"] ?><br>
        Harga: <?= $item["price"] ?><br>
        Subtotal: <?= $item[$subtotal] ?>

        <hr>
    </div>
<?php endforeach; ?>

<h3>Total: Rp<?= $total ?></h3><br>

<a href="my_orders.php">Kembali</a>