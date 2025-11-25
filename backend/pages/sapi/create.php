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

/**
 * Generate kode sapi otomatis (SAPI001, SAPI002, ...)
 * Pastikan $connect dari connection.php tersedia.
 */
$lastCode = 'SAPI001'; // default jika tabel kosong / query gagal
$qLast = "SELECT kode_sapi FROM sapi ORDER BY id_sapi DESC LIMIT 1";
$rLast = mysqli_query($connect, $qLast);

if ($rLast && mysqli_num_rows($rLast) > 0) {
  $row = mysqli_fetch_assoc($rLast);
  $lastKode = $row['kode_sapi'] ?? '';

  // Ambil angka di belakang kode. Jika format berbeda, ini masih aman.
  if (preg_match('/(\d+)$/', $lastKode, $m)) {
    $num = (int) $m[1];
    $next = $num + 1;
    $lastCode = 'SAPI' . str_pad($next, 3, '0', STR_PAD_LEFT);
  } else {
    // kalau tidak menemukan angka, tetap pakai default
    $lastCode = 'SAPI001';
  }
}
?>

<!-- content -->
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card w-100">
        <div class="card-header d-flex align-items-center justify-content-between"
          style="background: linear-gradient(135deg, #023e8a, #0077b6, #90e0ef); border: none;">
          <h5 class="text-light">Tambah Data Sapi</h5>
          <a href="./index.php" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
          <form action="../../actions/sapi/store.php" method="POST" enctype="multipart/form-data">

            <!-- Kode Sapi (otomatis) -->
            <div class="mb-3">
              <label for="kodeInput" class="form-label">Kode Sapi</label>
              <input type="text" name="kode_sapi" id="kodeInput" class="form-control" value="<?= htmlspecialchars($lastCode) ?>" readonly>
            </div>

            <!-- Jenis Sapi -->
            <div class="mb-3">
              <label for="jenisInput" class="form-label">Jenis Sapi</label>
              <input type="text" name="jenis_sapi" id="jenisInput" class="form-control" placeholder="Contoh: Sapi Bali" required>
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-3">
              <label for="kelaminInput" class="form-label">Jenis Kelamin</label>
              <select name="jenis_kelamin" id="kelaminInput" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="Jantan">Jantan</option>
                <option value="Betina">Betina</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="statusInput" class="form-label">Status Sapi</label>
              <select name="status_sapi" id="statusInput" class="form-control">
                <option value="Aktif">Aktif</option>
                <option value="Dijual">Dijual</option>
                <option value="Mati">Mati</option>
              </select>
            </div>


            <div class="mb-3">
              <label for="beratInput" class="form-label">Berat Badan</label>
              <div class="input-group">
                <input type="number" step="0.01" name="berat_badan_kg" id="beratInput" class="form-control" placeholder="Masukkan berat sapi">
                <span class="input-group-text">Kg</span>
              </div>
            </div>

            <!-- Status Kesehatan -->
            <div class="mb-3">
              <label for="statusInput" class="form-label">Status Kesehatan</label>
              <input type="text" name="status_kesehatan" id="statusInput" class="form-control" placeholder="Sehat / Sakit Ringan / dll">
            </div>

            <!-- Lokasi Kandang -->
            <div class="mb-3">
              <label for="lokasiInput" class="form-label">Lokasi Kandang</label>
              <input type="text" name="lokasi_kandang" id="lokasiInput" class="form-control" placeholder="Kandang A / Kandang B">
            </div>

            <!-- Tanggal Masuk -->
            <div class="mb-3">
              <label for="tanggalInput" class="form-label">Tanggal Masuk</label>
              <input type="date" name="tanggal_masuk" id="tanggalInput" class="form-control">
            </div>

            <!-- Gambar -->
            <div class="mb-3">
              <label for="gambarInput" class="form-label">Gambar Sapi</label>
              <input type="file" name="gambar" id="gambarInput" class="form-control" accept="image/*">
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