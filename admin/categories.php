<?php
require_once "../config/database.php";
require_once "../core/functions.php";

checkLogin();
checkRole("admin");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];

    $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->execute([$name]);
}

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

<h2>Kelola Kategori Produk</h2>

<a href="dashboard.php">Kembali</a>

<hr>

<h3>Tambah Kategori</h3>

<form method="POST">
    <input type="text" name="name" placeholder="Nama Kategori" required>
    <button type="submit">Tambah</button>
</form>

<hr>

<h3>Daftar Kategori</h3>

<?php foreach ($categories as $categori): ?>
    <div>
        <?= $categori["id"] ?> - <?= $categori["name"] ?>
        <hr>
    </div>
<?php endforeach; ?>