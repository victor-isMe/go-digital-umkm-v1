<?php 
require_once "../config/database.php";
require_once "../core/functions.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user"] = $user;

        if ($user["role"] === "admin") {
            redirect("../admin/dashboard.php");
        } elseif ($user["role"] === "umkm") {
            redirect("../umkm/dashboard.php");
        } else {
            redirect("../customer/dashboard.php");
        }
    } else {
        echo "Email atau password salah!";
    }
}
?>

<h2>Login</h2>
<form method="POST">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>