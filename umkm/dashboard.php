<?php
require_once "../core/functions.php";
checkLogin();
checkRole("umkm");
include "../partials/header.php";
?>

<div class="min-vh-100">
    <h1>Dashboard UMKM</h1>
    <a href="../auth/logout.php">Logout</a>
</div>

<?php include "../partials/footer.php"; ?>