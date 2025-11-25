<?php
session_start();
include '../../app.php';
include '../../../config/log_activities.php'; // pastikan path benar

if (isset($_POST['tombol'])) {
    // Ambil id dari POST (prioritas) atau GET sebagai fallback
    $id = isset($_POST['id']) ? (int) $_POST['id'] : (isset($_GET['id']) ? (int) $_GET['id'] : 0);
    if (!$id) {
        echo "<script>alert('ID penjualan tidak ditemukan!'); window.location.href='../../pages/penjualan/index.php';</script>";
        exit;
    }

    $id_sapi_raw     = $_POST['id_sapi'] ?? '';
    $id_sapi         = escapeString($id_sapi_raw);
    $tanggal_jual    = escapeString($_POST['tanggal_jual'] ?? '');
    $harga_jual_raw  = $_POST['harga_jual'] ?? '0';
    $harga_jual      = (int) str_replace(['.', ','], '', $harga_jual_raw);
    $pembeli         = escapeString($_POST['pembeli'] ?? '');

    // Ambil data penjualan lama
    $qOld = "SELECT id_sapi, harga_jual, tanggal_jual, pembeli FROM penjualan WHERE id_penjualan='$id' LIMIT 1";
    $rOld = mysqli_query($connect, $qOld);
    if (!$rOld) {
        $err = mysqli_error($connect);
        error_log("DB Error (fetch old penjualan): $err");
        echo "<script>alert('DB Error: " . addslashes($err) . "'); window.location.href='../../pages/penjualan/edit.php?id={$id}';</script>";
        exit;
    }
    if (mysqli_num_rows($rOld) === 0) {
        echo "<script>alert('Data penjualan tidak ditemukan!'); window.location.href='../../pages/penjualan/index.php';</script>";
        exit;
    }

    $old = mysqli_fetch_assoc($rOld);
    $old_sapi = $old['id_sapi'];

    // Pastikan id_sapi baru ada (jika ada perubahan)
    $cekSapi = mysqli_query($connect, "SELECT id_sapi FROM sapi WHERE id_sapi='$id_sapi' LIMIT 1");
    if (!$cekSapi || mysqli_num_rows($cekSapi) === 0) {
        echo "<script>alert('Sapi pilihan tidak ditemukan!'); window.location.href='../../pages/penjualan/edit.php?id={$id}';</script>";
        exit;
    }

    // Update penjualan
    $qUpdate = "UPDATE penjualan SET 
                  id_sapi = '$id_sapi',
                  tanggal_jual = '$tanggal_jual',
                  harga_jual = '$harga_jual',
                  pembeli = '$pembeli'
                WHERE id_penjualan = '$id'";

    if (mysqli_query($connect, $qUpdate)) {
        // Kalau sapi berubah, sinkronkan status
        if ($old_sapi != $id_sapi) {
            mysqli_query($connect, "UPDATE sapi SET status_sapi='Aktif' WHERE id_sapi='$old_sapi'");
            mysqli_query($connect, "UPDATE sapi SET status_sapi='Dijual' WHERE id_sapi='$id_sapi'");
        }

        // Catat log aktivitas (sesuaikan signature logActivity jika beda)
        logActivity(
            $connect,
            $_SESSION['id_user'] ?? null, // user yang login, pastikan ada session
            "Update",
            "Memperbarui penjualan ID $id: sapi $old_sapi → $id_sapi, harga $harga_jual, pembeli $pembeli, tanggal $tanggal_jual",
            "penjualan",
            $id
        );

        echo "<script>
            alert('Data penjualan berhasil diubah');
            window.location.href='../../pages/penjualan/index.php';
        </script>";
        exit;
    } else {
        $err = mysqli_error($connect);
        error_log("DB Error (update penjualan): $err");
        echo "<script>
            alert('Data penjualan gagal diubah. Error: " . addslashes($err) . "');
            window.location.href='../../pages/penjualan/edit.php?id={$id}';
        </script>";
        exit;
    }
}
