<?php
session_start();
include __DIR__ . '/../../../config/connection.php';
include __DIR__ . '/../../../config/log_activities.php';

if (isset($_SESSION['id_user'])) {
    $user_id = $_SESSION['id_user'];
    logActivity($connect, $user_id, "Logout", "User berhasil logout dari sistem");
}

// hapus semua session
$_SESSION = [];
session_unset();
session_destroy();

echo "<script>
    alert('Anda berhasil logout!');
    window.location.href='../../pages/user/login.php';
</script>";
exit();
