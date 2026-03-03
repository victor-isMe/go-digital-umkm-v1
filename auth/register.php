<?php 
require_once "../config/database.php";
require_once "../core/functions.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = $_POST["role"];

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?,?,?,?)");
    $stmt->execute([$name, $email, $password, $role]);

    redirect("login.php");
}
?>

<h2>Register</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Nama" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>

    <select name="role" required>
        <option value="customer">Customer</option>
        <option value="umkm">UMKM</option>
    </select><br><br>

    <button type="submit">Daftar</button>
</form>