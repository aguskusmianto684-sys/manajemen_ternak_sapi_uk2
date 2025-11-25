<?php
session_start();
include '../../../config/connection.php';
include '../../../config/log_activities.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("<script>alert('ID pengguna tidak ditemukan!'); window.location.href='../../pages/pengguna/index.php';</script>");
}

if (isset($_POST['tombol'])) {
    $nama_lengkap = mysqli_real_escape_string($connect, $_POST['nama_lengkap']);
    $username     = mysqli_real_escape_string($connect, $_POST['username']);
    $hak_akses    = mysqli_real_escape_string($connect, $_POST['hak_akses']);
    $password     = $_POST['password'];

    // kalau password kosong -> jangan update password
    if ($password !== '') {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $qUpdate = "
            UPDATE users SET
                nama_lengkap = '$nama_lengkap',
                username = '$username',
                password = '$hashedPassword',
                hak_akses = '$hak_akses'
            WHERE id_user = '$id'
        ";
    } else {
        $qUpdate = "
            UPDATE users SET
                nama_lengkap = '$nama_lengkap',
                username = '$username',
                hak_akses = '$hak_akses'
            WHERE id_user = '$id'
        ";
    }

    if (mysqli_query($connect, $qUpdate)) {
        // ✅ Catat log aktivitas
        logActivity(
            $connect,
            $_SESSION['id_user'],  // user yang sedang login
            "Update",              // aksi
            "Memperbarui pengguna ID $id: $nama_lengkap ($username)", // deskripsi
            "users",               // tabel
            $id                    // id data
        );

        echo "<script>
                alert('Data pengguna berhasil diperbarui!');
                window.location.href='../../pages/pengguna/index.php';
              </script>";
    } else {
        die('Error: ' . mysqli_error($connect));
    }
} else {
    header('Location: ../../pages/pengguna/index.php');
    exit;
}
