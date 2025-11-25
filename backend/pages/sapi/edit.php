<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  echo "<script>
        alert('Silakan login terlebih dahulu!');
        window.location.href='../../pages/user/login.php';
    </script>";
  exit();
}
$page = 'sapi';
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Ambil ID sapi dari URL
$id = $_GET['id'];
$qSapi = "SELECT * FROM sapi WHERE id_sapi='$id'";
$sapi = mysqli_query($connect, $qSapi) or die(mysqli_error($connect));
$data = mysqli_fetch_object($sapi);
?>

<!-- content -->
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card w-100">
        <div class="card-header d-flex align-items-center justify-content-between"
          style="background: linear-gradient(135deg, #023e8a, #0077b6, #90e0ef); border: none;">
          <h5 class="text-light">Ubah Data Sapi</h5>
          <a href="./index.php" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
          <form action="../../actions/sapi/update.php?id=<?= $data->id_sapi ?>" method="POST" enctype="multipart/form-data">

            <!-- Kode Sapi -->
            <div class="mb-3">
              <label for="kodeInput" class="form-label">Kode Sapi</label>
              <input type="text" name="kode_sapi" id="kodeInput"
                class="form-control"
                value="<?= $data->kode_sapi ?>"
                readonly>
            </div>


            <!-- Jenis Sapi -->
            <div class="mb-3">
              <label for="jenisInput" class="form-label">Jenis Sapi</label>
              <input type="text" name="jenis_sapi" id="jenisInput" class="form-control" value="<?= $data->jenis_sapi ?>" required>
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-3">
              <label for="kelaminInput" class="form-label">Jenis Kelamin</label>
              <select name="jenis_kelamin" id="kelaminInput" class="form-control" required>
                <option value="Jantan" <?= $data->jenis_kelamin == 'Jantan' ? 'selected' : '' ?>>Jantan</option>
                <option value="Betina" <?= $data->jenis_kelamin == 'Betina' ? 'selected' : '' ?>>Betina</option>
              </select>
            </div>

            <!-- Status Sapi -->
            <div class="mb-3">
              <label for="statusSapiInput" class="form-label">Status Sapi</label>
              <select name="status_sapi" id="statusSapiInput" class="form-control" required>
                <option value="Aktif" <?= $data->status_sapi == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="Dijual" <?= $data->status_sapi == 'Dijual' ? 'selected' : '' ?>>Dijual</option>
                <option value="Mati" <?= $data->status_sapi == 'Mati' ? 'selected' : '' ?>>Mati</option>
              </select>
            </div>


            <!-- Berat Badan -->
            <div class="mb-3">
              <label for="beratInput" class="form-label">Berat Badan (Kg)</label>
              <input type="number" step="0.01" name="berat_badan_kg" id="beratInput" class="form-control" value="<?= $data->berat_badan_kg ?>">
            </div>

            <!-- Status Kesehatan -->
            <div class="mb-3">
              <label for="statusInput" class="form-label">Status Kesehatan</label>
              <input type="text" name="status_kesehatan" id="statusInput" class="form-control" value="<?= $data->status_kesehatan ?>">
            </div>

            <!-- Lokasi Kandang -->
            <div class="mb-3">
              <label for="lokasiInput" class="form-label">Lokasi Kandang</label>
              <input type="text" name="lokasi_kandang" id="lokasiInput" class="form-control" value="<?= $data->lokasi_kandang ?>">
            </div>

            <!-- Tanggal Masuk -->
            <div class="mb-3">
              <label for="tanggalInput" class="form-label">Tanggal Masuk</label>
              <input type="date" name="tanggal_masuk" id="tanggalInput" class="form-control" value="<?= $data->tanggal_masuk ?>">
            </div>

            <!-- Gambar -->
            <div class="mb-3">
              <label for="gambarInput" class="form-label">Gambar Sapi</label><br>
              <?php if (!empty($data->gambar)): ?>
                <img src="../../../storages/sapi/<?= $data->gambar ?>" alt="Sapi" width="120" class="mb-2"><br>
              <?php endif; ?>
              <input type="file" name="gambar" id="gambarInput" class="form-control" accept="image/*">
              <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
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