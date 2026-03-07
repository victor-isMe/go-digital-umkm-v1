<?php
require_once "../config/database.php";
require_once "../core/functions.php";

$id = $_GET["id"];

$stmt = $pdo->prepare("SELECT products.*, users.name AS umkm_name, categories.name AS category_name
                        FROM products
                        JOIN users ON products.user_id = users.id
                        LEFT JOIN categories ON products.category_id = categories.id
                        WHERE products.id=?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    die("Produk tidak ditemukan!");
}
?>

<h2><?= htmlspecialchars($product["name"]) ?></h2>

Kategori: <?= $product["category_name"] ?><br>
UMKM: <?= htmlspecialchars($product["umkm_name"]) ?><br>
Harga: Rp<?= $product["price"] ?><br>
Stok: <?= $product["stock"] ?><br>
Deskripsi: <?= htmlspecialchars($product["description"]) ?><br>

<?php if ($product["stock"] > 0): ?>
    <form action="../customer/add_to_cart.php" method="POST">
        <input type="hidden" name="product_id" value="<?= $product["id"] ?>">
        Quantity:
        <input type="number" name="quantity" min="1" max="<?= $product["stock"] ?>" required>
        <button type="submit">Tambahkan ke Keranjang</button>
    </form>
<?php else: ?>
    <strong>Stok habis.</strong>
<?php endif; ?>

<hr>
<a href="list.php">Kembali</a>