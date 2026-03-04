<?php
require_once "../config/database.php";
require_once "../core/functions.php";

checkLogin();
checkRole("customer");

$product_id = $_POST["product_id"];
$quantity = $_POST["quantity"];

$stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product || $product["stock"] < $quantity) {
    die("Stok tidak mencukupi!");
}

$_SESSION["cart"][$product_id] = [
    "name" => $product["name"],
    "price" => $product["price"],
    "quantity" => $quantity
];

redirect("cart.php");