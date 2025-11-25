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
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card w-100">
        <div class="card-header d-flex align-items-center justify-content-between"
          style="background: linear-gradient(135deg, #2a6f97, #01497c, #a9d6e5); border: none;">
          <h5 class="text-light">Tambah Pengguna</h5>
          <a href="./index.php" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
          <form action="../../actions/pengguna/store.php" method="POST">

            <!-- Nama Lengkap -->
            <div class="mb-3">
              <label for="namaInput" class="form-label">Nama Lengkap</label>
              <input type="text" name="nama_lengkap" id="namaInput" class="form-control" placeholder="Masukkan nama lengkap" required>
            </div>

            <!-- Username -->
            <div class="mb-3">
              <label for="usernameInput" class="form-label">Username</label>
              <input type="text" name="username" id="usernameInput" class="form-control" placeholder="Masukkan username" required>
            </div>

            <!-- Password (dengan toggle eye) -->
            <div class="mb-3">
              <label for="passwordInput" class="form-label">Password</label>
              <div class="input-group">
                <input type="password" name="password" id="passwordInput" class="form-control" placeholder="Masukkan password" required aria-describedby="togglePassword">
                <button type="button" id="togglePassword" class="btn btn-outline-secondary" title="Tampilkan / Sembunyikan password" aria-label="Tampilkan atau sembunyikan password">
                  <span id="toggleIcon">👁️</span>
                </button>
              </div>
              <div class="form-text">Klik ikon mata untuk menampilkan / menyembunyikan password.</div>
            </div>

            <!-- Hak Akses -->
            <div class="mb-3">
              <label for="hakInput" class="form-label">Hak Akses</label>
              <select name="hak_akses" id="hakInput" class="form-control" required>
                <option value="">-- Pilih Hak Akses --</option>
                <option value="administrator">Administrator</option>
                <option value="petugas">Petugas</option>
              </select>
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

<!-- Script toggle password -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const pwdInput = document.getElementById('passwordInput');
    const toggleBtn = document.getElementById('togglePassword');
    const toggleIcon = document.getElementById('toggleIcon');

    toggleBtn.addEventListener('click', function() {
      const type = pwdInput.getAttribute('type') === 'password' ? 'text' : 'password';
      pwdInput.setAttribute('type', type);

      // ganti ikon
      if (type === 'text') {
        toggleIcon.textContent = '🙈'; // password terlihat
        toggleBtn.setAttribute('aria-pressed', 'true');
      } else {
        toggleIcon.textContent = '👁️'; // password tersembunyi
        toggleBtn.setAttribute('aria-pressed', 'false');
      }
      pwdInput.focus();
    });
  });
</script>