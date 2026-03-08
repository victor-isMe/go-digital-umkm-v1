<?php
require_once "../config/database.php";
require_once "../core/functions.php";

checkLogin();
checkRole("customer");

$product_id = $_POST["product_id"];
$rating = $_POST["rating"];
$comment = $_POST["comment"];
$user_id = $_POST["user"]["id"];

$stmt = $pdo->prepare("INSERT INTO reviews (product_id,user_id,rating,comment) VALUES (?,?,?,?)");
$stmt->execute([$product_id, $user_id, $rating, $comment]);

echo "Review berhasil dikirim!";
echo "<br><a href='../products/detail.php?id=$product_id'>Kembali</a>";