<?php
require_once "../core/functions.php";
checkLogin();
checkRole("admin");
?>

<h1>Dashboard Admin</h1>
<a href="../auth/logout.php">Logout</a>