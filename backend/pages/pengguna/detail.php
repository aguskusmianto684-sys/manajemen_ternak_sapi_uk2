<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  echo "<script>
        alert('Silakan login terlebih dahulu!');
        window.location.href='../../pages/user/login.php';
    </script>";
  exit();
}
$page = 'pengguna';
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Ambil ID sapi
$id = $_GET['id'];
$qSapi = "SELECT * FROM sapi WHERE id_sapi='$id'";
$result = mysqli_query($connect, $qSapi) or die(mysqli_error($connect));
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
              <strong>Jenis Kelamin:</strong> <?= $data->jenis_kelamin ?>
            </li>
            <li class="list-group-item">
              <strong>Berat Badan:</strong> <?= $data->berat_badan_kg ?> Kg
            </li>
            <li class="list-group-item">
              <strong>Status Kesehatan:</strong>
              <?php if (strtolower($data->status_kesehatan) == "sehat"): ?>
                <span class="badge bg-success"><?= $data->status_kesehatan ?></span>
              <?php elseif (strtolower($data->status_kesehatan) == "sakit ringan"): ?>
                <span class="badge bg-warning text-dark"><?= $data->status_kesehatan ?></span>
              <?php else: ?>
                <span class="badge bg-danger"><?= $data->status_kesehatan ?></span>
              <?php endif; ?>
            </li>
            <li class="list-group-item">
              <strong>Lokasi Kandang:</strong> <?= $data->lokasi_kandang ?>
            </li>
            <li class="list-group-item">
              <strong>Tanggal Masuk:</strong> <?= $data->tanggal_masuk ?>
            </li>
            <li class="list-group-item">
              <strong>Status Sapi:</strong>
              <?php if ($data->status_sapi == "Aktif"): ?>
                <span class="badge bg-primary">Aktif</span>
              <?php elseif ($data->status_sapi == "Dijual"): ?>
                <span class="badge bg-info text-dark">Dijual</span>
              <?php else: ?>
                <span class="badge bg-dark">Mati</span>
              <?php endif; ?>
            </li>
          </ul>
        </div>

        <!-- Tombol -->
        <div class="card-footer text-end bg-light">
          <a href="./index.php" class="btn btn-secondary">Kembali</a>
          <a href="./edit.php?id=<?= $data->id_sapi ?>" class="btn btn-warning">Edit</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>