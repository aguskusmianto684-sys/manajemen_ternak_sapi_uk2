<?php
session_start();
include '../../../config/connection.php';
include '../../../config/log_activities.php';

if (isset($_POST['tombol'])) {
    $id_sapi  = (int) $_POST['id_sapi'];
    $id_pakan = (int) $_POST['id_pakan'];

    // Ambil jumlah (anggap input type="number" atau pakai koma untuk desimal)
    $jumlah_kg = isset($_POST['jumlah']) ? (float) str_replace(',', '.', $_POST['jumlah']) : 0;

    $tanggal  = mysqli_real_escape_string($connect, $_POST['tanggal']);

    // Cek stok pakan
    $cekStok = mysqli_query($connect, "SELECT nama_pakan, stok_kg FROM pakan WHERE id_pakan=$id_pakan");
    $pakan = mysqli_fetch_assoc($cekStok);

    if (!$pakan || $pakan['stok_kg'] < $jumlah_kg) {
        echo "<script>
                alert('Stok pakan tidak cukup!');
                window.location.href='../../pages/pemberian_pakan/create.php';
              </script>";
        exit;
    }

    // Simpan pemberian pakan
    $qInsert = "INSERT INTO pemberian_pakan (id_sapi, id_pakan, tanggal, jumlah_kg)
                VALUES ('$id_sapi', '$id_pakan', '$tanggal', '$jumlah_kg')";
    if (mysqli_query($connect, $qInsert)) {
        // Update stok pakan dengan syarat stok cukup
        $qUpdate = "UPDATE pakan 
                    SET stok_kg = stok_kg - $jumlah_kg 
                    WHERE id_pakan=$id_pakan AND stok_kg >= $jumlah_kg";
        mysqli_query($connect, $qUpdate);

        // log aktivitas
        $id = mysqli_insert_id($connect);
        logActivity(
            $connect,
            $_SESSION['id_user'],
            "Insert",
            "Memberikan {$jumlah_kg} kg pakan ({$pakan['nama_pakan']}) ke sapi {$id_sapi} pada {$tanggal}",
            "pemberian_pakan",
            $id
        );

        echo "<script>
                alert('Data pemberian pakan berhasil disimpan!');
                window.location.href='../../pages/pemberian_pakan/index.php';
              </script>";
        exit;
    } else {
        die("Error: " . mysqli_error($connect));
    }
} else {
    header("Location: ../../pages/pemberian_pakan/index.php");
    exit;
}
