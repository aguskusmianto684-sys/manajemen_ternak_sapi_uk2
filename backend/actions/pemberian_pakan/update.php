<?php
session_start();
include '../../../config/connection.php';
include '../../../config/log_activities.php';

if (isset($_POST['tombol']) && isset($_GET['id'])) {
    $id        = intval($_GET['id']);
    $id_sapi   = (int) $_POST['id_sapi'];
    $id_pakan  = (int) $_POST['id_pakan'];
    $jumlah_kg = isset($_POST['jumlah_kg']) ? (float) $_POST['jumlah_kg'] : 0;
    $tanggal   = mysqli_real_escape_string($connect, $_POST['tanggal']);

    if ($jumlah_kg <= 0) {
        echo "<script>alert('Jumlah pakan harus lebih dari 0!');window.location.href='../../pages/pemberian_pakan/edit.php?id=$id';</script>";
        exit;
    }

    // Ambil data lama untuk rollback stok
    $qOld = mysqli_query($connect, "SELECT id_pakan, jumlah_kg FROM pemberian_pakan WHERE id_pemberian=$id");
    $old  = mysqli_fetch_assoc($qOld);

    if (!$old) {
        echo "<script>alert('Data lama tidak ditemukan!');window.location.href='../../pages/pemberian_pakan/index.php';</script>";
        exit;
    }

    // Kembalikan stok pakan lama
    mysqli_query($connect, "UPDATE pakan SET stok_kg = stok_kg + {$old['jumlah_kg']} WHERE id_pakan={$old['id_pakan']}");

    // Cek stok pakan baru cukup
    $cekStok = mysqli_query($connect, "SELECT nama_pakan, stok_kg FROM pakan WHERE id_pakan=$id_pakan");
    $pakan   = mysqli_fetch_assoc($cekStok);

    if (!$pakan || $pakan['stok_kg'] < $jumlah_kg) {
        // balikin rollback (kurangi lagi stok lama)
        mysqli_query($connect, "UPDATE pakan SET stok_kg = stok_kg - {$old['jumlah_kg']} WHERE id_pakan={$old['id_pakan']}");

        echo "<script>alert('Stok pakan tidak cukup!');window.location.href='../../pages/pemberian_pakan/edit.php?id=$id';</script>";
        exit;
    }

    // Update data pemberian
    $qUpdate = "UPDATE pemberian_pakan SET 
                    id_sapi = '$id_sapi',
                    id_pakan = '$id_pakan',
                    jumlah_kg = '$jumlah_kg',
                    tanggal = '$tanggal'
                WHERE id_pemberian = '$id'";

    if (mysqli_query($connect, $qUpdate)) {
        // Kurangi stok pakan baru
        mysqli_query($connect, "UPDATE pakan SET stok_kg = stok_kg - $jumlah_kg WHERE id_pakan=$id_pakan");

        // log aktivitas
        logActivity(
            $connect,
            $_SESSION['id_user'],
            "Update",
            "Mengubah pemberian pakan #$id: {$jumlah_kg} kg ({$pakan['nama_pakan']}) untuk sapi {$id_sapi} pada {$tanggal}",
            "pemberian_pakan",
            $id
        );

        echo "<script>alert('Data pemberian pakan berhasil diperbarui!');window.location.href='../../pages/pemberian_pakan/index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');window.location.href='../../pages/pemberian_pakan/edit.php?id=$id';</script>";
    }
} else {
    header("Location: ../../pages/pemberian_pakan/index.php");
    exit;
}
