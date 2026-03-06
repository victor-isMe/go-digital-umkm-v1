<?php
require_once "../config/database.php";
require_once "../core/functions.php";

checkLogin();
checkRole("umkm");

$id = $_GET["id"];
$status = $_GET["status"];

$stmt = $pdo->prepare("UPDATE orders SET status=? WHERE id=?");
$stmt->execute([$status, $id]);

redirect("orders.php");