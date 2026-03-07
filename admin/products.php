<?php
require_once "../config/database.php";
require_once "../core/functions.php";

checkLogin();
checkRole("admin");

$stmt = $pdo->query("SELECT products.*, users.name AS umkm_name
                    FROM products 
                    JOIN users ON products.user_id = users.id
                    ORDER BY products.created_at DESC
                    ");

$products = $stmt->fetchAll();
?>

<h2>Semua Produk UMKM</h2>

<a href="dashboard.php">Kembali</a>

<hr>

<?php foreach ($products as $product): ?>
    <div>
        Produk: <?= $product["name"] ?><br>
        UMKM: <?= $product["umkm_name"] ?><br>
        Harga: Rp<?= $product["price"] ?><br>
        Stok: <?= $product["stock"] ?><br>
        <hr>
    </div>
<?php endforeach; ?>