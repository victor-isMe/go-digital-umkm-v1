<?php
require_once "../core/functions.php";
checkLogin();
checkRole("umkm");
?>

<h1>Dashboard UMKM</h1>
<a href="../auth/logout.php">Logout</a>