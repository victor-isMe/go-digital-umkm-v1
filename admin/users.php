<?php
require_once "../config/database.php";
require_once "../core/functions.php";

checkLogin();
checkRole("admin");

$stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll();
?>

<h2>Daftar User</h2>

<a href="dashboard.php">Kembali</a>

<hr>

<?php foreach ($users as $user): ?>
    <div>
        Nama: <?= $user["name"] ?><br>
        Email: <?= $user["email"] ?><br>
        Role: <?= $user["role"] ?><br>
        <hr>
    </div>
<?php endforeach; ?>