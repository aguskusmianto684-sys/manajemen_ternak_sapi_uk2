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

// Ambil data pakan dari database
$qPakan = "SELECT * FROM pakan ORDER BY id_pakan DESC";
$result = mysqli_query($connect, $qPakan) or die(mysqli_error($connect));
?>

<!-- content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-header d-flex align-items-center justify-content-between"
                    style="background: linear-gradient(135deg, #2a6f97, #01497c, #a9d6e5); border: none;">
                    <h5 class="text-light">Tabel Data Pakan</h5>
                    <a href="./create.php" class="btn btn-primary">Tambah Pakan</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="pakanTable" class="table table-bordered w-100 text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pakan</th>
                                    <th>Stok (Kg)</th>
                                    <th>Satuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($item = $result->fetch_object()):
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= htmlspecialchars($item->nama_pakan) ?></td>
                                        <td><?= number_format($item->stok_kg, 2) ?></td>
                                        <td><?= $item->satuan ?: '-' ?></td>
                                        <td>
                                            <a href="./edit.php?id=<?= $item->id_pakan ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="../../actions/pakan/destroy.php?id=<?= $item->id_pakan ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus pakan ini?')">
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