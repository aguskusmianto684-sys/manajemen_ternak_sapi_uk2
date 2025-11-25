<?php
session_start();
include '../../../config/connection.php';
include '../../../config/log_activities.php';

if (isset($_POST['tombol'])) {
    $nama_pakan = mysqli_real_escape_string($connect, $_POST['nama_pakan']);
    $stok_kg    = $_POST['stok_kg'] ? (float) $_POST['stok_kg'] : 0;
    $satuan     = mysqli_real_escape_string($connect, $_POST['satuan']);

    $qInsert = "INSERT INTO pakan (nama_pakan, stok_kg, satuan)
                VALUES ('$nama_pakan', $stok_kg, " . ($satuan ? "'$satuan'" : "NULL") . ")";

    if (mysqli_query($connect, $qInsert)) {
        // ambil id terakhir setelah insert
        $id = mysqli_insert_id($connect);

        // log aktivitas
        logActivity(
            $connect,
            $_SESSION['id_user'],
            "Insert",
            "Menambahkan pakan baru: {$nama_pakan}, stok {$stok_kg} {$satuan}",
            "pakan",
            $id
        );

        echo "<script>
                alert('Data pakan berhasil disimpan!');
                window.location.href='../../pages/pakan/index.php';
              </script>";
    } else {
        die("Error: " . mysqli_error($connect));
    }
} else {
    header("Location: ../../pages/pakan/index.php");
    exit;
}
