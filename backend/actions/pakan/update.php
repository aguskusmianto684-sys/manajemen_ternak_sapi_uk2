<?php
session_start();
include '../../../config/connection.php';
include '../../../config/log_activities.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("<script>alert('ID pakan tidak ditemukan!'); window.location.href='../../pages/pakan/index.php';</script>");
}

if (isset($_POST['tombol'])) {
    $nama_pakan = mysqli_real_escape_string($connect, $_POST['nama_pakan']);
    $stok_kg    = $_POST['stok_kg'] !== '' ? (float) $_POST['stok_kg'] : 0;
    $satuan     = mysqli_real_escape_string($connect, $_POST['satuan']);

    $qUpdate = "UPDATE pakan SET 
                    nama_pakan = '$nama_pakan',
                    stok_kg = $stok_kg,
                    satuan = " . ($satuan ? "'$satuan'" : "NULL") . "
                WHERE id_pakan = '$id'";
    logActivity(
        $connect,
        $_SESSION['id_user'],
        "Update",
        "Mengubah pakan {$id} menjadi: {$nama_pakan}, stok {$stok_kg} {$satuan}",
        "pakan",
        $id
    );


    if (mysqli_query($connect, $qUpdate)) {
        echo "<script>
                alert('Data pakan berhasil diperbarui!');
                window.location.href='../../pages/pakan/index.php';
              </script>";
    } else {
        die("Error: " . mysqli_error($connect));
    }
} else {
    header("Location: ../../pages/pakan/index.php");
    exit;
}
