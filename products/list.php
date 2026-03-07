<?php
require_once "../config/database.php";

$stmt = $pdo->prepare("SELECT products.*, users.name AS umkm_name, categories.name AS category_name 
                        FROM products 
                        JOIN users ON products.user_id = users.id 
                        LEFT JOIN categories ON products.category_id = categories.id
                        ORDER BY products.created_at DESC");

$product = $stmt->fetchAll();
?>

<h2>Daftar Produk UMKM</h2>
<a href="../auth/login.php">Login</a>

<hr>

<?php foreach ($products as $product): ?>
    <div>
        <strong><?= htmlspecialchars($product["name"]) ?></strong><br>
        Kategori: <?= $product["category_name"] ?><br>
        UMKM: <?= htmlspecialchars($product['umkm_name']) ?><br>
        Harga: Rp<?= $product["price"] ?><br>
        Stok: <?= $product["stock"] ?><br>

        <a href="detail.php?id=<?= $product["id"] ?>">Detail Produk</a>
        <hr>
    </div>
<?php endforeach; ?>