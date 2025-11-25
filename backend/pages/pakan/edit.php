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

// Ambil id dari URL
$id = $_GET['id'] ?? null;
if (!$id) {
  die("<script>alert('ID pakan tidak ditemukan!'); window.location.href='index.php';</script>");
}

$q = "SELECT * FROM pakan WHERE id_pakan = '$id'";
$res = mysqli_query($connect, $q) or die(mysqli_error($connect));
$data = mysqli_fetch_object($res);
?>

<!-- content -->
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card w-100">
        <div class="card-header d-flex align-items-center justify-content-between"
          style="background: linear-gradient(135deg, #2a6f97, #01497c, #a9d6e5); border: none;">
          <h5 class="text-light">Edit Data Pakan</h5>
          <a href="./index.php" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
          <form action="../../actions/pakan/update.php?id=<?= $data->id_pakan ?>" method="POST">

            <!-- Nama Pakan -->
            <div class="mb-3">
              <label for="namaInput" class="form-label">Nama Pakan</label>
              <input type="text" name="nama_pakan" id="namaInput"
                class="form-control" value="<?= htmlspecialchars($data->nama_pakan) ?>" required>
            </div>

            <!-- Stok -->
            <div class="mb-3">
              <label for="stokInput" class="form-label">Stok (Kg)</label>
              <input type="number" step="0.01" name="stok_kg" id="stokInput"
                class="form-control" value="<?= $data->stok_kg ?>" required>
            </div>

            <!-- Satuan -->
            <div class="mb-3">
              <label for="satuanInput" class="form-label">Satuan</label>
              <input type="text" name="satuan" id="satuanInput"
                class="form-control" value="<?= htmlspecialchars($data->satuan) ?>">
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