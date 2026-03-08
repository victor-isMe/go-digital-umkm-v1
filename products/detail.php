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

$stmtReviews = $pdo->prepare("SELECT reviews.*, users.name 
                            FROM reviews
                            JOIN users ON reviews.user_id=users.id
                            WHERE product_id=?
                            ORDER BY created_at DESC    
                            ");
$stmtReviews->execute([$id]);
$reviews = $stmtReviews->fetchAll();

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
<hr>

<h3>Reviews Produk</h3>

<?php if (isset($_SESSION["user"]) && $_SESSION["user"]["role"] == "customer"): ?>
    <h3>Beri rating pada produk ini</h3>

    <form action="../reviews/add_review.php" method="POST">
        <input type="hidden" name="product_id" value="<?= $product["id"] ?>">

        Rating: 
        <select name="rating" required>
            <option value="5">5 - Sangat Bagus</option>
            <option value="4">4 - Bagus</option>
            <option value="3">3 - Cukup</option>
            <option value="2">2 - Kurang</option>
            <option value="1">1 - Buruk</option>
        </select><br><br>

        Komentar: 
        <textarea name="comment" required></textarea><br><br>

        <button type="submit">Kirim Rating</button>
    </form>
<?php endif; ?>

<?php if (empty($reviews)): ?>
    Belum ada review

<?php else: ?>

<?php foreach ($reviews as $review): ?>
    <div>
        <strong><?= $review["name"] ?></strong><br>
        Rating: ⭐<?= $review["rating"] ?>/5 <br>
        Komentar: <?= htmlspecialchars($review["comment"]) ?><br>
        <hr>
    </div>
<?php endforeach; ?>
<?php endif; ?>