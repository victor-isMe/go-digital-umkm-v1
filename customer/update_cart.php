<?php
require_once "../core/functions.php";

checkLogin();
checkRole("customer");

$product_id = $_POST["product_id"];
$action = $_POST["action"];

if (!isset($_SESSION["cart"][$product_id])) {
    redirect("cart.php");
}

if ($action === "increase") {
    $_SESSION["cart"][$product_id]["quantity"]++;
}

if ($action === "decrease") {
    $_SESSION["cart"][$product_id]["quantity"]--;
    if ($_SESSION["cart"][$product_id]["quantity"] <= 0) {
        unset($_SESSION["cart"][$product_id]);
    }
}

redirect("cart.php");