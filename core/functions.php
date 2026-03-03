<?php
session_start();

function redirect($url) {
    header("Location: $url");
    exit;
}

function isLoggedIn() {
    return isset($_SESSION['user']);
}

function checkLogin() {
    if (!isLoggedIn()) {
        redirect("../auth/login.php");
    }
}

function checkRole($role) {
    if ($_SESSION['user']['role'] !== $role) {
        die("Akses ditolak!");
    }
}
?>