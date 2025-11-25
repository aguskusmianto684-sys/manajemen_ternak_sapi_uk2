<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "<script>
        alert('Anda harus login terlebih dahulu!');
        window.location.href='../../pages/user/login.php';
    </script>";
    exit();
}
