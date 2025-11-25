<?php
session_start();
include '../../../config/connection.php';
include '../../../config/log_activities.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ambil data user sebelum dihapus (buat log)
    $qSelect = mysqli_query($connect, "SELECT nama_lengkap, username FROM users WHERE id_user = $id");
    $userData = mysqli_fetch_assoc($qSelect);

    // Hapus data user
    $qDelete = "DELETE FROM users WHERE id_user = $id";
    $result = mysqli_query($connect, $qDelete);

    if ($result) {
        // ✅ Catat log aktivitas
        if ($userData) {
            logActivity(
                $connect,
                $_SESSION['id_user'], // user yang login
                "Delete",             // aksi
                "Menghapus pengguna: {$userData['nama_lengkap']} ({$userData['username']})", // deskripsi
                "users",              // tabel
                $id                   // id data
            );
        }

        echo "<script>
            alert('Data pengguna berhasil dihapus');
            window.location.href='../../pages/pengguna/index.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Data pengguna gagal dihapus');
            window.location.href='../../pages/pengguna/index.php';
        </script>";
        exit;
    }
} else {
    echo "<script>
        alert('ID tidak ditemukan!');
        window.location.href='../../pages/pengguna/index.php';
    </script>";
    exit;
}
