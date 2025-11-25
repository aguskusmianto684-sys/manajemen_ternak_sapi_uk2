<?php
session_start();
include '../../../config/connection.php';
include '../../../config/log_activities.php';

if (isset($_POST['tombol'])) {
    $id_sapi        = mysqli_real_escape_string($connect, $_POST['id_sapi']);
    $tanggal        = mysqli_real_escape_string($connect, $_POST['tanggal']);
    $jenis_kegiatan = mysqli_real_escape_string($connect, $_POST['jenis_kegiatan']);
    $keterangan     = mysqli_real_escape_string($connect, $_POST['keterangan']);

    $qInsert = "INSERT INTO riwayat_kesehatan (id_sapi, tanggal, jenis_kegiatan, keterangan)
                VALUES ('$id_sapi', '$tanggal', '$jenis_kegiatan', '$keterangan')";

    if (mysqli_query($connect, $qInsert)) {
        $id_riwayat = mysqli_insert_id($connect);

        //  Catat log aktivitas
        logActivity(
            $connect,
            $_SESSION['id_user'],  // user yang login
            "Insert",              // aksi
            "Menambahkan riwayat kesehatan sapi ID $id_sapi: $jenis_kegiatan pada $tanggal", // deskripsi
            "riwayat_kesehatan",   // tabel
            $id_riwayat            // id data
        );

        echo "<script>
                alert('Riwayat kesehatan berhasil ditambahkan!');
                window.location.href='../../pages/riwayat_kesehatan/index.php';
              </script>";
    } else {
        die("Error: " . mysqli_error($connect));
    }
} else {
    header("Location: ../../pages/riwayat_kesehatan/index.php");
    exit;
}
