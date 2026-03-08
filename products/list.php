<?php
require_once "../config/database.php";

$category = $_GET["category"] ?? "";
$search = $_GET["search"] ?? "";

$sql = "SELECT products.*, users.name AS umkm_name, categories.name AS category_name
        FROM products
        JOIN users ON products.user_id=users.id
        LEFT JOIN categories ON products.category_id=categories.id
        WHERE 1
        ";
$params = [];

if (!empty($search)) {
    $sql .= " AND products.name LIKE ? OR products.description LIKE ?";
    $params[] = "%$search%";
} 

if (!empty($category)) {
    $sql .= " AND products.category_id = ?";
    $params[] = $category;
}

$sql .= " ORDER BY products.created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$products = $stmt->fetchAll();
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

<h2>Daftar Produk UMKM</h2>
<a href="../auth/login.php">Login</a>

<hr>

<form method="GET">
    <input type="text" name="search" placeholder="Cari produk..." value="<?= htmlspecialchars(($search)) ?>">

    <select name="category">
        <option value="">Semua Kategori</option>

        <?php foreach ($categories as $categori): ?>
            <option value="<?= $categori["id"] ?>">
                <?= $categori["name"] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Search</button>
</form>

<hr>

<?php if (empty($products)): ?>

    Produk tidak ditemukan

<?php endif; ?>

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