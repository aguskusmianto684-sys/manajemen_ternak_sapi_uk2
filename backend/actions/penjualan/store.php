<?php
session_start();
include '../../app.php';
include '../../../config/log_activities.php'; // pastikan path benar

if (isset($_POST['tombol'])) {
    $id_sapi         = escapeString($_POST['id_sapi']);
    $tanggal_jual    = escapeString($_POST['tanggal_jual']);
    $harga_jual_raw  = $_POST['harga_jual'] ?? 0;
    $harga_jual      = (int) str_replace(['.', ','], '', $harga_jual_raw);
    $pembeli         = escapeString($_POST['pembeli']);

    // 🔎 Cek status sapi
    $cek = mysqli_query($connect, "SELECT status_sapi FROM sapi WHERE id_sapi='$id_sapi'");
    if (!$cek) {
        $err = mysqli_error($connect);
        echo "<script>alert('DB Error: " . addslashes($err) . "');window.location.href='../../pages/penjualan/create.php';</script>";
        exit;
    }
    $data = mysqli_fetch_assoc($cek);

    if (!$data) {
        echo "<script>alert('Data sapi tidak ditemukan!');window.location.href='../../pages/penjualan/create.php';</script>";
        exit;
    }

    //  Tidak boleh jual kalau status sapi bukan 'Aktif' atau 'Dijual'
    if (!in_array($data['status_sapi'], ['Aktif', 'Dijual'])) {
        echo "<script>alert('Sapi ini tidak bisa dijual (status: {$data['status_sapi']})');window.location.href='../../pages/penjualan/create.php';</script>";
        exit;
    }

    //  Insert penjualan
    $qInsert = "INSERT INTO penjualan (id_sapi, tanggal_jual, harga_jual, pembeli)
                VALUES ('$id_sapi', '$tanggal_jual', '$harga_jual', '$pembeli')";

    if (mysqli_query($connect, $qInsert)) {
        $id_penjualan = mysqli_insert_id($connect);

        //  Update status sapi → 'Terjual'
        mysqli_query($connect, "UPDATE sapi SET status_sapi='Terjual' WHERE id_sapi='$id_sapi'");

        //  Catat log aktivitas
        logActivity(
            $connect,
            $_SESSION['id_user'] ?? null, // user yang login
            "Insert",                     // aksi
            "Menambahkan penjualan sapi ID $id_sapi seharga $harga_jual untuk pembeli: $pembeli pada $tanggal_jual", // deskripsi
            "penjualan",                  // tabel
            $id_penjualan                 // id data
        );

        echo "<script>alert('Data penjualan berhasil ditambahkan!');window.location.href='../../pages/penjualan/index.php';</script>";
    } else {
        $err = mysqli_error($connect);
        echo "<script>alert('Gagal menambahkan penjualan! Error: " . addslashes($err) . "');window.location.href='../../pages/penjualan/create.php';</script>";
    }
}
