<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  echo "<script>
        alert('Silakan login terlebih dahulu!');
        window.location.href='../../pages/user/login.php';
    </script>";
  exit();
}
$page = 'riwayat_kesehatan';
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Ambil ID riwayat
$id = $_GET['id'] ?? null;
if (!$id) {
  die("<script>alert('ID riwayat tidak ditemukan!'); window.location.href='index.php';</script>");
}

// Ambil data riwayat + sapi
$q = "
  SELECT rk.*, s.kode_sapi, s.jenis_sapi, s.gambar 
  FROM riwayat_kesehatan rk
  JOIN sapi s ON rk.id_sapi = s.id_sapi
  WHERE rk.id_riwayat = '$id'
";
$result = mysqli_query($connect, $q) or die(mysqli_error($connect));
$data = mysqli_fetch_object($result);
?>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-lg border-0 rounded-3 overflow-hidden">

        <!-- Gambar header -->
        <div class="text-center bg-light p-4">
          <?php if (!empty($data->gambar)): ?>
            <img src="../../../storages/sapi/<?= $data->gambar ?>"
              alt="Foto Sapi" class="img-fluid rounded-3 shadow-sm" style="max-height: 280px;">
          <?php else: ?>
            <div class="border rounded p-5 text-muted">Tidak ada gambar</div>
          <?php endif; ?>
        </div>

        <!-- Info detail -->
        <div class="card-body p-4">
          <h4 class="mb-3 text-primary">🐄 <?= $data->kode_sapi ?> - <?= $data->jenis_sapi ?></h4>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <strong>Tanggal:</strong> <?= date('d-m-Y', strtotime($data->tanggal)) ?>
            </li>
            <li class="list-group-item">
              <strong>Jenis Kegiatan:</strong>
              <span class="badge bg-info text-dark"><?= htmlspecialchars($data->jenis_kegiatan) ?></span>
            </li>
            <li class="list-group-item">
              <strong>Keterangan:</strong>
              <?= $data->keterangan ? htmlspecialchars($data->keterangan) : '<em>Tidak ada keterangan</em>' ?>
            </li>
          </ul>
        </div>

        <!-- Tombol -->
        <div class="card-footer text-end bg-light">
          <a href="./index.php" class="btn btn-secondary">Kembali</a>
          <a href="./edit.php?id=<?= $data->id_riwayat ?>" class="btn btn-warning">Edit</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>