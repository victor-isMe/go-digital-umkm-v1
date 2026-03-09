<?php
require_once "../config/database.php";
require_once "../core/functions.php";

checkLogin();
checkRole("customer");

$product_id = $_POST["product_id"];
$action = $_POST["action"];

if (!isset($_SESSION["cart"][$product_id])) {
    redirect("cart.php");
}

$stmt = $pdo->prepare("SELECT stock FROM products WHERE id=?");
$stmt->execute([$product_id]);

$product = $stmt->fetch();
$stock = $product["stock"];

$current_qty = $_SESSION["cart"][$product_id]["quantity"];

if ($action === "increase") {
    if ($current_qty < $stock) {
        $_SESSION["cart"][$product_id]["quantity"]++;
    } else {
        $_SESSION["error"] = "Jumlah melebihi stok yang tersedia.";
    }
}

if ($action === "decrease") {
    $_SESSION["cart"][$product_id]["quantity"]--;
    if ($_SESSION["cart"][$product_id]["quantity"] <= 0) {
        unset($_SESSION["cart"][$product_id]);
    }
}

redirect("cart.php");