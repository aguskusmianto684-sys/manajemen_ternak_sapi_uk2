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

// Ambil data sapi untuk dropdown
$qSapi = "SELECT id_sapi, kode_sapi, jenis_sapi FROM sapi ORDER BY id_sapi DESC";
$rSapi = mysqli_query($connect, $qSapi) or die(mysqli_error($connect));
// Ambil semua data sapi
$qSapi = mysqli_query($connect, "SELECT id_sapi, kode_sapi, jenis_sapi FROM sapi ORDER BY id_sapi DESC");
?>

<!-- content -->
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card w-100">
        <div class="card-header d-flex align-items-center justify-content-between"
          style="background: linear-gradient(135deg, #2a6f97, #01497c, #a9d6e5); border: none;">
          <h5 class="text-light">Tambah Data Penjualan</h5>
          <a href="./index.php" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
          <form action="../../actions/penjualan/store.php" method="POST">

            <!-- Pilih Sapi -->
            <div class="mb-3">
              <label class="form-label">Pilih Sapi</label>
              <select name="id_sapi" id="sapiSelect" class="form-control" required>
                <option value="">-- Cari & Pilih Sapi --</option>
                <?php while ($s = mysqli_fetch_assoc($qSapi)): ?>
                  <option value="<?= $s['id_sapi'] ?>">
                    <?= $s['kode_sapi'] ?> - <?= $s['jenis_sapi'] ?>
                  </option>
                <?php endwhile; ?>
              </select>
            </div>

            <!-- Tanggal Jual -->
            <div class="mb-3">
              <label for="tanggalInput" class="form-label">Tanggal Jual</label>
              <input type="date" name="tanggal_jual" id="tanggalInput" class="form-control" required>
            </div>

            <!-- Harga Jual -->
            <div class="mb-3">
              <label for="hargaInput" class="form-label">Harga Jual</label>
              <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="text" name="harga_jual" id="hargaInput" class="form-control" placeholder="Masukkan harga" required>
              </div>
            </div>


            <!-- Pembeli -->
            <div class="mb-3">
              <label for="pembeliInput" class="form-label">Nama Pembeli</label>
              <input type="text" name="pembeli" id="pembeliInput" class="form-control" placeholder="Masukkan nama pembeli" required>
            </div>

            <!-- Tombol -->
            <button type="submit" name="tombol" class="btn btn-success">Simpan</button>
            <a href="./index.php" class="btn btn-primary">Batal</a>

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