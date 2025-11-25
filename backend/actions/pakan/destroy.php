<?php
session_start();
include '../../../config/connection.php';
include '../../../config/log_activities.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ambil data pakan untuk log
    $qSelect = "SELECT nama_pakan FROM pakan WHERE id_pakan = $id";
    $rSelect = mysqli_query($connect, $qSelect);
    $row = mysqli_fetch_assoc($rSelect);
    $nama_pakan = $row ? $row['nama_pakan'] : '';

    // Cek apakah pakan dipakai di tabel pemberian_pakan
    $qCheck = "SELECT COUNT(*) AS total FROM pemberian_pakan WHERE id_pakan = $id";
    $rCheck = mysqli_query($connect, $qCheck);
    $check = mysqli_fetch_assoc($rCheck);

    if ($check['total'] > 0) {
        // Tidak bisa hapus karena masih dipakai
        echo "<script>
            alert('Data pakan tidak bisa dihapus karena masih digunakan di tabel pemberian pakan!');
            window.location.href='../../pages/pakan/index.php';
        </script>";
        exit;
    }

    // Jika aman, baru hapus
    $qDelete = "DELETE FROM pakan WHERE id_pakan = $id";
    $result = mysqli_query($connect, $qDelete);

    if ($result) {
        logActivity(
            $connect,
            $_SESSION['id_user'],
            "Delete",
            "Menghapus pakan: {$nama_pakan}",
            "pakan",
            $id
        );

        echo "<script>
            alert('Data pakan berhasil dihapus');
            window.location.href='../../pages/pakan/index.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Data pakan gagal dihapus!');
            window.location.href='../../pages/pakan/index.php';
        </script>";
        exit;
    }
} else {
    echo "<script>
        alert('ID tidak ditemukan!');
        window.location.href='../../pages/pakan/index.php';
    </script>";
    exit;
}
