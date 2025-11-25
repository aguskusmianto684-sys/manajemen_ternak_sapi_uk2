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

// Ambil semua data sapi
$qSapi = mysqli_query($connect, "SELECT id_sapi, kode_sapi, jenis_sapi FROM sapi ORDER BY id_sapi DESC");
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card w-100">
        <div class="card-header d-flex align-items-center justify-content-between"
          style="background: linear-gradient(135deg, #2a6f97, #01497c, #a9d6e5); border: none;">
          <h5 class="text-light">Tambah Riwayat Kesehatan</h5>
          <a href="./index.php" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
          <form action="../../actions/riwayat_kesehatan/store.php" method="POST">

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

            <!-- Tanggal -->
            <div class="mb-3">
              <label class="form-label">Tanggal</label>
              <input type="date" name="tanggal" class="form-control" required>
            </div>

            <!-- Jenis Kegiatan -->
            <div class="mb-3">
              <label class="form-label">Jenis Kegiatan</label>
              <input type="text" name="jenis_kegiatan" class="form-control" placeholder="Contoh: Vaksinasi, Pemeriksaan, dll." required>
            </div>

            <!-- Keterangan -->
            <div class="mb-3">
              <label class="form-label">Keterangan</label>
              <textarea name="keterangan" class="form-control" placeholder="Tambahkan keterangan jika perlu"></textarea>
            </div>

            <!-- Tombol -->
            <button type="submit" name="tombol" class="btn btn-success">Simpan</button>
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