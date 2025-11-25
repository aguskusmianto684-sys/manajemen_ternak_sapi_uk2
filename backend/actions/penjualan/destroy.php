<?php
include '../../app.php';
include '../../../config/log_activities.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ambil data penjualan untuk log
    $qGet = mysqli_query($connect, "SELECT * FROM penjualan WHERE id_penjualan = $id");
    $penjualan = mysqli_fetch_assoc($qGet);

    if (!$penjualan) {
        echo "<script>
            alert('Data penjualan tidak ditemukan!');
            window.location.href='../../pages/penjualan/index.php';
        </script>";
        exit;
    }

    $id_sapi = $penjualan['id_sapi'];

    // Matikan pengecekan FK sementara
    mysqli_query($connect, "SET FOREIGN_KEY_CHECKS = 0");

    // Hapus data penjualan
    $delete = mysqli_query($connect, "DELETE FROM penjualan WHERE id_penjualan = $id");

    // Aktifkan kembali FK
    mysqli_query($connect, "SET FOREIGN_KEY_CHECKS = 1");

    if ($delete) {
        // Kembalikan status sapi jadi 'Aktif' hanya jika sapi-nya masih ada
        $cekSapi = mysqli_query($connect, "SELECT id_sapi FROM sapi WHERE id_sapi = '$id_sapi'");
        if (mysqli_num_rows($cekSapi) > 0) {
            mysqli_query($connect, "UPDATE sapi SET status_sapi='Aktif' WHERE id_sapi='$id_sapi'");
        }

        // Catat log aktivitas
        $id_user = $_SESSION['id_user'] ?? null;
        logActivity(
            $connect,
            $id_user,
            "DELETE",
            "Menghapus penjualan ID $id (Sapi ID $id_sapi, Harga {$penjualan['harga_jual']}, Pembeli {$penjualan['pembeli']}, Tanggal {$penjualan['tanggal_jual']})",
            "penjualan",
            $id
        );

        echo "<script>
            alert('Data penjualan berhasil dihapus!');
            window.location.href='../../pages/penjualan/index.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus data penjualan!');
            window.location.href='../../pages/penjualan/index.php';
        </script>";
    }
} else {
    echo "<script>
        alert('ID penjualan tidak ditemukan!');
        window.location.href='../../pages/penjualan/index.php';
    </script>";
}
