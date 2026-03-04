<?php
require_once "../config/database.php";
require_once "../core/functions.php";

checkLogin()
checkRole("umkm");

$user_id = $_SESSION["user"]["id"];
$id = $_GET["id"];

$stmt = $pdo->prepare("DELETE FROM products WHERE id=? AND user_id=?");
$stmt->execute([$id, $user_id]);

redirect("my_products.php");