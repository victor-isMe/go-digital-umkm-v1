<?php
require_once "../core/functions.php";
checkLogin();
checkRole("customer");
?>

<h1>Dashboard User</h1>
<a href="../auth/logout.php">Logout</a>