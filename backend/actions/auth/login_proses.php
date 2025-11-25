<?php
session_start();
include __DIR__ . '/../../../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // 🔒 pakai prepared statement
    $stmt = $connect->prepare("
        SELECT id_user, username, password, nama_lengkap, hak_akses
        FROM users
        WHERE username = ?
        LIMIT 1
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows > 0) {
        $user = $res->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // set session
            $_SESSION['logged_in']    = true;
            $_SESSION['id_user']      = $user['id_user'];
            $_SESSION['username']     = $user['username'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            $_SESSION['hak_akses']    = $user['hak_akses']; // administrator / petugas

            // 🚀 langsung catat log aktivitas ke tabel log_activities
            $ip        = $_SERVER['REMOTE_ADDR'] ?? '';
            $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
            $log = $connect->prepare("
                INSERT INTO log_activities (id_user, aktivitas, detail, ip_address, user_agent, waktu)
                VALUES (?, 'Login', 'User berhasil login ke sistem', ?, ?, NOW())
            ");
            $log->bind_param("iss", $user['id_user'], $ip, $userAgent);
            $log->execute();
            $log->close();

            echo "<script>
                alert('Login berhasil! Selamat datang {$user['nama_lengkap']}');
                window.location.href='../../pages/dashboard/index.php';
            </script>";
            exit();
        } else {
            echo "<script>
                alert('Password salah!');
                window.location.href='../../pages/user/login.php';
            </script>";
            exit();
        }
    } else {
        echo "<script>
            alert('Username tidak ditemukan!');
            window.location.href='../../pages/user/login.php';
        </script>";
        exit();
    }
}
