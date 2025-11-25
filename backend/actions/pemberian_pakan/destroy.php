<?php
include '../../../config/connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // pastikan ID integer

    // Ambil data lama sebelum hapus
    $qOld = mysqli_query($connect, "SELECT id_pakan, jumlah_kg FROM pemberian_pakan WHERE id_pemberian = $id");
    $old = mysqli_fetch_assoc($qOld);

    if ($old) {
        // Kembalikan stok pakan dulu
        mysqli_query($connect, "UPDATE pakan 
                                SET stok_kg = stok_kg + {$old['jumlah_kg']} 
                                WHERE id_pakan = {$old['id_pakan']}");
    }

    // Hapus data pemberian pakan
    $qDelete = "DELETE FROM pemberian_pakan WHERE id_pemberian = $id";
    $result = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

    if ($result) {
        echo "<script>
            alert('Data pemberian pakan berhasil dihapus');
            window.location.href='../../pages/pemberian_pakan/index.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Data pemberian pakan gagal dihapus');
            window.location.href='../../pages/pemberian_pakan/index.php';
        </script>";
        exit;
    }
} else {
    echo "<script>
        alert('ID tidak ditemukan!');
        window.location.href='../../pages/pemberian_pakan/index.php';
    </script>";
    exit;
}
