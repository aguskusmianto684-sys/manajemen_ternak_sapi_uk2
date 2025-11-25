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

// Ambil data user dari database
$qUser = "SELECT * FROM users ORDER BY id_user DESC";
$result = mysqli_query($connect, $qUser) or die(mysqli_error($connect));
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card w-100">
        <div class="card-header d-flex align-items-center justify-content-between"
          style="background: linear-gradient(135deg, #2a6f97, #01497c, #a9d6e5); border: none;">
          <h5 class="text-light">Tabel Data Pengguna</h5>
          <a href="./create.php" class="btn btn-primary">Tambah Pengguna</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="usersTable" class="table table-bordered w-100 text-center align-middle">
              <thead class="table-light">
                <tr>
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>Username</th>
                  <th>Hak Akses</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                while ($user = $result->fetch_object()):
                ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= htmlspecialchars($user->nama_lengkap) ?></td>
                    <td><?= htmlspecialchars($user->username) ?></td>
                    <td>
                      <?php if ($user->hak_akses == 'administrator'): ?>
                        <span class="badge bg-primary">Administrator</span>
                      <?php else: ?>
                        <span class="badge bg-success">Petugas</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="./edit.php?id=<?= $user->id_user ?>" class="btn btn-warning btn-sm">Edit</a>
                      <a href="../../actions/pengguna/destroy.php?id=<?= $user->id_user ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Apakah anda yakin ingin menghapus pengguna ini?')">
                        Hapus
                      </a>
                    </td>
                  </tr>
                <?php
                  $no++;
                endwhile;
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>