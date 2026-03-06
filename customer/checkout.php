<?php
require_once "../config/database.php";
require_once "../core/functions.php";

checkLogin();
checkRole("customer");

$cart = $_SESSION["cart"] ?? [];

if (empty($cart)) {
    die("Keranjang kosong.");
}

$pdo->beginTransaction();

try {
    $cust_id = $_SESSION["user"]["id"];
    $total = 0;

    foreach ($cart as $item) {
        $total += $item["price"] * $item["quantity"];
    }

    $stmt = $pdo->prepare("INSERT INTO orders (customer_id,total_price,status) VALUES (?,?,'pending')");
    $stmt->execute([$cust_id, $total]);

    $order_id = $pdo->lastInsertId();

    foreach ($cart as $product_id => $item) {
        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?,?,?,?)");
        $stmt->execute([$order_id, $product_id, $item["quantity"], $item["price"]]);

        $stmt = $pdo->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
        $stmt->execute([$item["quantity"], $product_id]);
    }

    $pdo->commit();

    unset($_SESSION["cart"]);

    echo "Checkout Berhasil";
    echo "<br><a href='my_orders.php'>Lihat Pesanan</a>";
} catch (Exception $e) {
    $pdo->rollBack();
    die("Checkout gagal: " . $e->getMessage());
}