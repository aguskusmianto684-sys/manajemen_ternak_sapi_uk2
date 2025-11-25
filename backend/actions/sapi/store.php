<?php
session_start();
include '../../app.php';
include '../../../config/log_activities.php'; // fungsi logActivity

if (isset($_POST['tombol'])) {
    // =============================
    // Generate kode sapi otomatis
    // =============================
    $qLast = "SELECT kode_sapi FROM sapi ORDER BY id_sapi DESC LIMIT 1";
    $rLast = mysqli_query($connect, $qLast);
    $kode_sapi = "SAPI001"; // default awal

    if ($rLast && mysqli_num_rows($rLast) > 0) {
        $row = mysqli_fetch_assoc($rLast);
        $lastKode = $row['kode_sapi'];

        // Ambil angka di belakang SAPI
        $num = (int) filter_var($lastKode, FILTER_SANITIZE_NUMBER_INT);
        $nextNum = $num + 1;

        // Format jadi SAPI001, SAPI002, dst.
        $kode_sapi = "SAPI" . str_pad($nextNum, 3, "0", STR_PAD_LEFT);
    }

    // =============================
    // Ambil data form
    // =============================
    $jenis_sapi       = escapeString($_POST['jenis_sapi']);
    $jenis_kelamin    = escapeString($_POST['jenis_kelamin']);
    $berat_badan_kg   = isset($_POST['berat_badan_kg']) ? (int) $_POST['berat_badan_kg'] : null;
    $status_kesehatan = escapeString($_POST['status_kesehatan']);
    $lokasi_kandang   = escapeString($_POST['lokasi_kandang']);
    $tanggal_masuk    = escapeString($_POST['tanggal_masuk']);
    $status_sapi      = $_POST['status_sapi'] ?? 'Aktif'; // default Aktif

    $gambarName = null;

    // =============================
    // Upload gambar
    // =============================
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $tmp  = $_FILES['gambar']['tmp_name'];
        $name = $_FILES['gambar']['name'];
        $ext  = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($ext, $allowed)) {
            echo "<script>alert('Format gambar tidak didukung!');window.location.href='../../pages/sapi/create.php';</script>";
            exit;
        }

        $gambarName = time() . '_' . uniqid() . '.' . $ext;
        $storage = "../../../storages/sapi/";

        if (!is_dir($storage)) {
            mkdir($storage, 0777, true);
        }

        if (!move_uploaded_file($tmp, $storage . $gambarName)) {
            echo "<script>alert('Gagal upload gambar!');window.location.href='../../pages/sapi/create.php';</script>";
            exit;
        }
    }

    // =============================
    // Query insert
    // =============================
    $qInsert = "INSERT INTO sapi 
        (kode_sapi, jenis_sapi, jenis_kelamin, berat_badan_kg, status_kesehatan, lokasi_kandang, tanggal_masuk, gambar, status_sapi) 
        VALUES (
            '$kode_sapi', 
            '$jenis_sapi', 
            '$jenis_kelamin', 
            " . ($berat_badan_kg !== null ? $berat_badan_kg : "NULL") . ", 
            " . ($status_kesehatan !== '' ? "'$status_kesehatan'" : "NULL") . ", 
            " . ($lokasi_kandang !== '' ? "'$lokasi_kandang'" : "NULL") . ", 
            " . ($tanggal_masuk !== '' ? "'$tanggal_masuk'" : "NULL") . ", 
            " . ($gambarName ? "'$gambarName'" : "NULL") . ",
            '$status_sapi'
        )";

    if (mysqli_query($connect, $qInsert)) {
        $id_sapi = mysqli_insert_id($connect);

        // Pastikan id_user ada
        $id_user = $_SESSION['id_user'] ?? 0;

        //  Catat log aktivitas
        $log = logActivity(
            $connect,
            $id_user,   // user yang login
            "Insert",   // aksi
            "Menambahkan data sapi baru dengan kode: $kode_sapi, jenis: $jenis_sapi, status: $status_sapi", // deskripsi
            "sapi",     // tabel
            $id_sapi    // id data
        );

        if (!$log) {
            // Debug kalau log gagal
            error_log("LogActivity gagal untuk sapi ID $id_sapi");
        }

        echo "<script>
            alert('Data sapi berhasil ditambahkan!');
            window.location.href='../../pages/sapi/index.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Gagal menambahkan data sapi!');
            window.location.href='../../pages/sapi/create.php';
        </script>";
        exit;
    }
}
