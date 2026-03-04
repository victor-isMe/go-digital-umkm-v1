<?php
require_once "../config/database.php";
require_once "../core/functions.php";

checkLogin();
checkRole("umkm");

$user_id = $_SESSION["user"]["id"];

$stmt = $pdo->prepare("SELECT * FROM products WHERE user_id = ?");
$stmt->execute([$user_id]);
$products = $stmt->fetchAll();
?>

<h2>Produk Saya</h2>
<a href="add_product.php">Tambah Produk</a> |
<a href="dashboard.php">Dashboard</a> |
<a href="../auth/logout.php">Logout</a>

<hr>

<?php foreach ($products as $product): ?>
    <div>
        <strong><?= htmlspecialchars($product["name"]) ?></strong><br>
        Harga: Rp<?= $product["price"] ?><br>
        Stok: <?= $product["stock"] ?><br>
        <a href="edit_product.php?id=<?= $product["id"] ?>">Edit</a> |
        <a href="delete_product.php?id=<?= $product["id"] ?>" onclick="return confirm('Hapus produk?')">Hapus</a>
        <hr>
    </div>
<?php endforeach; ?>