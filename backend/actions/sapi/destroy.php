<?php
include '../../app.php';
include '../../../config/log_activities.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ambil data sapi untuk log
    $qGet = mysqli_query($connect, "SELECT * FROM sapi WHERE id_sapi = $id");
    $sapi = mysqli_fetch_assoc($qGet);

    if (!$sapi) {
        echo "<script>
            alert('Data sapi tidak ditemukan!');
            window.location.href='../../pages/sapi/index.php';
        </script>";
        exit;
    }

    // Matikan foreign key sementara agar tidak error constraint
    mysqli_query($connect, "SET FOREIGN_KEY_CHECKS = 0");

    // Hapus semua data relasi yang berhubungan dengan sapi ini
    mysqli_query($connect, "DELETE FROM penjualan WHERE id_sapi = $id");
    mysqli_query($connect, "DELETE FROM pemberian_pakan WHERE id_sapi = $id");
    mysqli_query($connect, "DELETE FROM riwayat_kesehatan WHERE id_sapi = $id");

    // Hapus sapi-nya
    $delete = mysqli_query($connect, "DELETE FROM sapi WHERE id_sapi = $id");

    // Aktifkan kembali FK
    mysqli_query($connect, "SET FOREIGN_KEY_CHECKS = 1");

    if ($delete) {
        // Catat log aktivitas
        $id_user = $_SESSION['id_user'] ?? null;
        logActivity(
            $connect,
            $id_user,
            "DELETE",
            "Menghapus sapi ID $id (Kode: {$sapi['kode_sapi']}, Jenis: {$sapi['jenis_sapi']}, Status: {$sapi['status_sapi']})",
            "sapi",
            $id
        );

        echo "<script>
            alert('Data sapi berhasil dihapus!');
            window.location.href='../../pages/sapi/index.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus data sapi!');
            window.location.href='../../pages/sapi/index.php';
        </script>";
    }
} else {
    echo "<script>
        alert('ID sapi tidak ditemukan!');
        window.location.href='../../pages/sapi/index.php';
    </script>";
}
