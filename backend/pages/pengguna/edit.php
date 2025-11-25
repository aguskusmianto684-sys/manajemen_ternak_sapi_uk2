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

// Ambil id dari URL
$id = $_GET['id'] ?? null;
if (!$id) {
  die("<script>alert('ID pengguna tidak ditemukan!'); window.location.href='index.php';</script>");
}

$q = "SELECT * FROM users WHERE id_user = '$id'";
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
          <h5 class="text-light">Edit Pengguna</h5>
          <a href="./index.php" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
          <form action="../../actions/pengguna/update.php?id=<?= $data->id_user ?>" method="POST">

            <!-- Nama Lengkap -->
            <div class="mb-3">
              <label for="namaInput" class="form-label">Nama Lengkap</label>
              <input type="text" name="nama_lengkap" id="namaInput"
                class="form-control" value="<?= htmlspecialchars($data->nama_lengkap) ?>" required>
            </div>

            <!-- Username -->
            <div class="mb-3">
              <label for="usernameInput" class="form-label">Username</label>
              <input type="text" name="username" id="usernameInput"
                class="form-control" value="<?= htmlspecialchars($data->username) ?>" required>
            </div>

            <!-- Password (bisa dibuka/tutup) -->
            <div class="mb-3">
              <label for="passwordInput" class="form-label">Password</label>
              <div class="input-group">
                <input type="password" name="password" id="passwordInput"
                  class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                <button type="button" id="togglePassword" class="btn btn-outline-secondary">
                  <span id="toggleIcon">👁️</span>
                </button>
              </div>
              <div class="form-text">Biarkan kosong jika tidak ingin mengubah password.</div>
            </div>

            <!-- Hak Akses -->
            <div class="mb-3">
              <label for="hakInput" class="form-label">Hak Akses</label>
              <select name="hak_akses" id="hakInput" class="form-control" required>
                <option value="administrator" <?= $data->hak_akses == 'administrator' ? 'selected' : '' ?>>Administrator</option>
                <option value="petugas" <?= $data->hak_akses == 'petugas' ? 'selected' : '' ?>>Petugas</option>
              </select>
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

<!-- Script toggle password -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const pwdInput = document.getElementById('passwordInput');
    const toggleBtn = document.getElementById('togglePassword');
    const toggleIcon = document.getElementById('toggleIcon');

    toggleBtn.addEventListener('click', function() {
      const type = pwdInput.getAttribute('type') === 'password' ? 'text' : 'password';
      pwdInput.setAttribute('type', type);

      if (type === 'text') {
        toggleIcon.textContent = '🙈';
      } else {
        toggleIcon.textContent = '👁️';
      }
      pwdInput.focus();
    });
  });
</script>