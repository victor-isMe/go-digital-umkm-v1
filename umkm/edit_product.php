<?php
require_once "../config/database.php";
require_once "../core/functions.php";

checkLogin();
checkRole("umkm");

$user_id = $_SESSION["user"]["id"];
$id = $_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $user_id]);
$product = $stmt->fetch();

if (!$product) {
    die("Produk tidak ditemukan!");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $description = $_POST["description"];

    $stmt = $pdo->prepare("UPDATE products SET nama=?, price=?, stock=?, description=? WHERE id=? AND user_id=?");
    $stmt->execute([$name, $price, $stock, $description, $id, $user_id]);

    redirect("my_products.php");
}
?>

<h2>Edit Produk</h2>

<form method="POST">
    Nama: <br>
    <input type="text" name="name" value="<?= $product["name"] ?>"><br><br>
    Harga: <br>
    <input type="number" name="price" value="<?= $product["price"] ?>"><br><br>
    Stok: <br>
    <input type="number" name="stock" value="<?= $product["stock"] ?>"><br><br>
    Deskripsi: <br>
    <textarea name="description"><?= $product["description"] ?></textarea><br><br>

    <button type="submit">Update</button>
</form>