<?php
require_once "../config/database.php";
require_once "../core/functions.php";

checkLogin();
checkRole("umkm");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION["user"]["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $category_id = $_POST["category_id"];
    $description = $_POST["description"];

    $imageName = null;

    if (!empty($_FILES["image"]["name"])) {
        $imageName = time() . "_" . $_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/products/" . $imageName);
    }

    $stmt = $pdo->prepare("INSERT INTO products (user_id, category_id, name, price, stock, description, image) VALUES (?,?,?,?,?,?,?)");
    $stmt->execute([$user_id, $category_id, $name, $price, $stock, $description, $imageName]);

    $categories = $pdo->query("SELECT * FROM categories")->fetchAll();

    redirect("my_products.php");
}
?>

<h2>Tambah Produk</h2>

<form method="POST" enctype="multipart/form-data">
    Nama Produk:<br>
    <input type="text" name="name" required><br><br>

    Harga: <br>
    <input type="number" name="price" required><br><br>

    Stok: <br>
    <input type="number" name="stock" required><br><br>

    Kategori: <br>
    <select name="category_id" required>
        <?php foreach ($categories as $categori): ?>
            <option value="<?= $categori["id"] ?>">
                <?= $categori["name"] ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    Deskripsi: <br>
    <textarea name="description"></textarea><br><br>

    Gambar: <br>
    <input type="file" name="image"><br><br>

    <button type="submit">Save</button>
</form>