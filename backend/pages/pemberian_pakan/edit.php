<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  echo "<script>
        alert('Silakan login terlebih dahulu!');
        window.location.href='../../pages/user/login.php';
    </script>";
  exit();
}
$page = 'pakan';
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  die("<script>alert('ID pemberian tidak ditemukan!');window.location.href='index.php';</script>");
}

// Ambil data pemberian
$qPemberian = mysqli_query($connect, "SELECT * FROM pemberian_pakan WHERE id_pemberian = '$id'") or die(mysqli_error($connect));
$data = mysqli_fetch_object($qPemberian);

// Ambil daftar sapi aktif
$qSapi = mysqli_query($connect, "SELECT id_sapi, kode_sapi FROM sapi");

// Ambil daftar pakan
$qPakan = mysqli_query($connect, "SELECT id_pakan, nama_pakan FROM pakan");

$qSapi = mysqli_query($connect, "SELECT id_sapi, kode_sapi, jenis_sapi FROM sapi ORDER BY id_sapi DESC");
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card w-100">
        <div class="card-header d-flex align-items-center justify-content-between"
          style="background: linear-gradient(135deg, #2a6f97, #01497c, #a9d6e5); border: none;">
          <h5 class="text-light">Edit Pemberian Pakan</h5>
          <a href="./index.php" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
          <form action="../../actions/pemberian_pakan/update.php?id=<?= $data->id_pemberian ?>" method="POST">

            <!-- Pilih Sapi -->
            <div class="mb-3">
              <label class="form-label">Pilih Sapi</label>
              <select name="id_sapi" id="sapiSelect" class="form-control" required>
                <option value="">-- Cari & Pilih Sapi --</option>
                <?php while ($s = mysqli_fetch_assoc($qSapi)): ?>
                  <option value="<?= $s['id_sapi'] ?>" <?= $s['id_sapi'] == $data->id_sapi ? 'selected' : '' ?>>
                    <?= $s['kode_sapi'] ?> - <?= $s['jenis_sapi'] ?>
                  </option>
                <?php endwhile; ?>
              </select>
            </div>

            <!-- Pilih Pakan -->
            <div class="mb-3">
              <label class="form-label">Pakan</label>
              <select name="id_pakan" class="form-control" required>
                <option value="">-- Pilih Pakan --</option>
                <?php while ($pakan = mysqli_fetch_assoc($qPakan)): ?>
                  <option value="<?= $pakan['id_pakan'] ?>" <?= $pakan['id_pakan'] == $data->id_pakan ? 'selected' : '' ?>>
                    <?= $pakan['nama_pakan'] ?>
                  </option>
                <?php endwhile; ?>
              </select>
            </div>

            <!-- Jumlah -->
            <div class="mb-3">
              <label class="form-label">Jumlah Pakan</label>
              <div class="input-group">
                <input type="number" step="0.01" name="jumlah_kg" class="form-control"
                  value="<?= $data->jumlah_kg ?>" required>
                <span class="input-group-text">Kg</span>
              </div>
            </div>

            <!-- Tanggal -->
            <div class="mb-3">
              <label class="form-label">Tanggal</label>
              <input type="date" name="tanggal" class="form-control" value="<?= $data->tanggal ?>" required>
            </div>

            <!-- Tombol -->
            <button type="submit" name="tombol" class="btn btn-success">Update</button>
            <a href="./index.php" class="btn btn-secondary">Batal</a>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>
<!-- Tambahkan Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function() {
    $('#sapiSelect').select2({
      placeholder: "-- Cari & Pilih Sapi --"
    });
  });
</script>