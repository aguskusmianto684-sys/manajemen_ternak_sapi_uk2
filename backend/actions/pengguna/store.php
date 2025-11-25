<?php
session_start();
include '../../../config/connection.php';
include '../../../config/log_activities.php';

if (isset($_POST['tombol'])) {
    $nama_lengkap = mysqli_real_escape_string($connect, trim($_POST['nama_lengkap']));
    $username     = mysqli_real_escape_string($connect, trim($_POST['username']));
    $password_raw = $_POST['password'];
    $hak_akses    = mysqli_real_escape_string($connect, $_POST['hak_akses']);

    // Validasi input kosong
    if (empty($nama_lengkap) || empty($username) || empty($password_raw) || empty($hak_akses)) {
        echo "<script>
                alert('Semua field wajib diisi!');
                window.location.href='../../pages/pengguna/create.php';
              </script>";
        exit;
    }

    // Cek apakah username sudah ada
    $cek = mysqli_query($connect, "SELECT id FROM users WHERE username='$username' LIMIT 1");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
                alert('Username sudah digunakan!');
                window.location.href='../../pages/pengguna/create.php';
              </script>";
        exit;
    }

    // Hash password
    $password = password_hash($password_raw, PASSWORD_DEFAULT);

    // Simpan data pengguna baru
    $qInsert = "INSERT INTO users (username, password, nama_lengkap, hak_akses)
                VALUES ('$username', '$password', '$nama_lengkap', '$hak_akses')";

    if (mysqli_query($connect, $qInsert)) {
        $id_user_baru = mysqli_insert_id($connect);

        // ✅ Catat log aktivitas
        logActivity(
            $connect,
            $_SESSION['id_user'],                     // id user yang login
            "Insert",                                // aksi
            "Menambahkan pengguna baru: $nama_lengkap ($username)", // deskripsi
            "users",                                 // tabel
            $id_user_baru                            // id data yang baru dimasukkan
        );

        echo "<script>
                alert('Pengguna berhasil ditambahkan!');
                window.location.href='../../pages/pengguna/index.php';
              </script>";
    } else {
        die('Error: ' . mysqli_error($connect));
    }
} else {
    header("Location: ../../pages/pengguna/index.php");
    exit;
}
