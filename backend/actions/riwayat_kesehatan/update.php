<?php
session_start();
include '../../../config/connection.php';
include '../../../config/log_activities.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("<script>alert('ID tidak ditemukan!'); window.location.href='../../pages/riwayat_kesehatan/index.php';</script>");
}

if (isset($_POST['tombol'])) {
    $id_sapi        = mysqli_real_escape_string($connect, $_POST['id_sapi']);
    $tanggal        = mysqli_real_escape_string($connect, $_POST['tanggal']);
    $jenis_kegiatan = mysqli_real_escape_string($connect, $_POST['jenis_kegiatan']);
    $keterangan     = mysqli_real_escape_string($connect, $_POST['keterangan']);

    $qUpdate = "UPDATE riwayat_kesehatan SET 
                    id_sapi = '$id_sapi',
                    tanggal = '$tanggal',
                    jenis_kegiatan = '$jenis_kegiatan',
                    keterangan = '$keterangan'
                WHERE id_riwayat = '$id'";

    if (mysqli_query($connect, $qUpdate)) {
        //  Catat log aktivitas
        logActivity(
            $connect,
            $_SESSION['id_user'], // user yang login
            "Update",             // aksi
            "Memperbarui riwayat kesehatan ID $id untuk sapi ID $id_sapi: $jenis_kegiatan ($tanggal)", // deskripsi
            "riwayat_kesehatan",  // tabel
            $id                   // id data
        );

        echo "<script>
                alert('Data riwayat kesehatan berhasil diperbarui!');
                window.location.href='../../pages/riwayat_kesehatan/index.php';
              </script>";
    } else {
        die('Error: ' . mysqli_error($connect));
    }
} else {
    header("Location: ../../pages/riwayat_kesehatan/index.php");
    exit;
}
