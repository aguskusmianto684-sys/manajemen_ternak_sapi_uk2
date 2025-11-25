<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  echo "<script>
        alert('Silakan login terlebih dahulu!');
        window.location.href='../../pages/user/login.php';
    </script>";
  exit();
}
$page = 'penjualan';
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Ambil ID penjualan
$id = $_GET['id'];
$qPenjualan = "
    SELECT p.*, s.kode_sapi, s.jenis_sapi, s.jenis_kelamin, s.gambar
    FROM penjualan p
    LEFT JOIN sapi s ON p.id_sapi = s.id_sapi
    WHERE p.id_penjualan='$id'
";
$result = mysqli_query($connect, $qPenjualan) or die(mysqli_error($connect));
$data = mysqli_fetch_object($result);
?>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-lg border-0 rounded-3 overflow-hidden">

        <!-- Gambar sapi -->
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
          <h4 class="mb-3 text-primary">💰 Penjualan - <?= $data->kode_sapi ?> (<?= $data->jenis_sapi ?>)</h4>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <strong>Kode Sapi:</strong> <?= $data->kode_sapi ?>
            </li>
            <li class="list-group-item">
              <strong>Jenis Sapi:</strong> <?= $data->jenis_sapi ?>
            </li>
            <li class="list-group-item">
              <strong>Jenis Kelamin:</strong> <?= $data->jenis_kelamin ?>
            </li>
            <li class="list-group-item">
              <strong>Tanggal Jual:</strong> <?= $data->tanggal_jual ?>
            </li>
            <li class="list-group-item">
              <strong>Harga Jual:</strong> Rp <?= number_format($data->harga_jual, 0, ',', '.') ?>
            </li>
            <li class="list-group-item">
              <strong>Pembeli:</strong> <?= $data->pembeli ?>
            </li>
          </ul>
        </div>

        <!-- Tombol -->
        <div class="card-footer text-end bg-light">
          <a href="./index.php" class="btn btn-secondary">Kembali</a>
          <a href="./edit.php?id=<?= $data->id_penjualan ?>" class="btn btn-warning">Edit</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>