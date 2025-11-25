<?php
session_start();
include '../../app.php';
include '../../../config/log_activities.php';

if (isset($_POST['tombol'])) {
    $id = (int) $_GET['id'];


    // Ambil data form

    $kode_sapi        = escapeString($_POST['kode_sapi']);
    $jenis_sapi       = escapeString($_POST['jenis_sapi']);
    $jenis_kelamin    = escapeString($_POST['jenis_kelamin']);
    $berat_badan_kg   = isset($_POST['berat_badan_kg']) && $_POST['berat_badan_kg'] !== '' ? (int) $_POST['berat_badan_kg'] : null;
    $status_kesehatan = escapeString($_POST['status_kesehatan']);
    $lokasi_kandang   = escapeString($_POST['lokasi_kandang']);
    $tanggal_masuk    = escapeString($_POST['tanggal_masuk']);
    $status_sapi      = $_POST['status_sapi'] ?? 'Aktif';


    // Ambil data lama (gambar)

    $qOld   = "SELECT gambar FROM sapi WHERE id_sapi='$id'";
    $resOld = mysqli_query($connect, $qOld) or die(mysqli_error($connect));
    $old    = mysqli_fetch_object($resOld);

    $gambarNew = $old->gambar;
    $storages  = "../../../storages/sapi/";


    // Upload gambar baru

    if (!empty($_FILES['gambar']['tmp_name']) && $_FILES['gambar']['error'] === 0) {
        $tmp  = $_FILES['gambar']['tmp_name'];
        $name = $_FILES['gambar']['name'];
        $ext  = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($ext, $allowed)) {
            $gambarNew = time() . '_' . uniqid() . '.' . $ext;

            // Hapus file lama jika ada
            if (!empty($old->gambar) && file_exists($storages . $old->gambar)) {
                unlink($storages . $old->gambar);
            }

            // Upload file baru
            if (!move_uploaded_file($tmp, $storages . $gambarNew)) {
                echo "<script>alert('Gagal upload gambar baru!');window.location.href='../../pages/sapi/edit.php?id=$id';</script>";
                exit;
            }
        }
    }


    // Query update

    $qUpdate = "UPDATE sapi SET 
                    kode_sapi='$kode_sapi', 
                    jenis_sapi='$jenis_sapi', 
                    jenis_kelamin='$jenis_kelamin', 
                    berat_badan_kg=" . ($berat_badan_kg !== null ? $berat_badan_kg : "NULL") . ", 
                    status_kesehatan=" . ($status_kesehatan !== '' ? "'$status_kesehatan'" : "NULL") . ", 
                    lokasi_kandang=" . ($lokasi_kandang !== '' ? "'$lokasi_kandang'" : "NULL") . ", 
                    tanggal_masuk=" . ($tanggal_masuk !== '' ? "'$tanggal_masuk'" : "NULL") . ", 
                    gambar=" . ($gambarNew ? "'$gambarNew'" : "NULL") . ",
                    status_sapi='$status_sapi'
                WHERE id_sapi='$id'";

    if (mysqli_query($connect, $qUpdate)) {
        // Catat log aktivitas
        $id_user = $_SESSION['id_user'] ?? 0;
        $log = logActivity(
            $connect,
            $id_user,
            "Update",
            "Mengubah data sapi ID $id (kode: $kode_sapi, jenis: $jenis_sapi, status: $status_sapi)",
            "sapi",
            $id
        );

        if (!$log) {
            error_log("LogActivity gagal untuk update sapi ID $id");
        }

        echo "<script>
            alert('Data sapi berhasil diubah!');
            window.location.href='../../pages/sapi/index.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Data sapi gagal diubah!');
            window.location.href='../../pages/sapi/edit.php?id=$id';
        </script>";
        exit;
    }
}
