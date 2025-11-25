<?php
session_start();
include '../../../config/connection.php';
include '../../../config/log_activities.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ambil data riwayat sebelum dihapus (untuk log)
    $qSelect = mysqli_query($connect, "SELECT id_sapi, jenis_kegiatan, tanggal FROM riwayat_kesehatan WHERE id_riwayat = $id");
    $riwayat = mysqli_fetch_assoc($qSelect);

    // Hapus data riwayat kesehatan
    $qDelete = "DELETE FROM riwayat_kesehatan WHERE id_riwayat = $id";
    $result = mysqli_query($connect, $qDelete);

    if ($result) {
        //  Catat log aktivitas
        if ($riwayat) {
            logActivity(
                $connect,
                $_SESSION['id_user'],  // user yang login
                "Delete",              // aksi
                "Menghapus riwayat kesehatan ID $id: {$riwayat['jenis_kegiatan']} untuk sapi ID {$riwayat['id_sapi']} pada {$riwayat['tanggal']}", // deskripsi
                "riwayat_kesehatan",   // tabel
                $id                    // id data
            );
        }

        echo "<script>
            alert('Data riwayat kesehatan berhasil dihapus');
            window.location.href='../../pages/riwayat_kesehatan/index.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Data riwayat kesehatan gagal dihapus');
            window.location.href='../../pages/riwayat_kesehatan/index.php';
        </script>";
        exit;
    }
} else {
    echo "<script>
        alert('ID tidak ditemukan!');
        window.location.href='../../pages/riwayat_kesehatan/index.php';
    </script>";
    exit;
}
