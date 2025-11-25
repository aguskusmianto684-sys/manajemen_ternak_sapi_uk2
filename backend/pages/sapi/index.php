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

// Ambil data sapi dari database
$qSapi = "SELECT * FROM sapi ORDER BY id_sapi DESC";
$result = mysqli_query($connect, $qSapi) or die(mysqli_error($connect));
?>

<!-- content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-header d-flex align-items-center justify-content-between"
                    style="background: linear-gradient(135deg, #2a6f97, #01497c, #a9d6e5); border: none;">
                    <h5 class="text-light">Tabel Data Sapi</h5>
                    <a href="./create.php" class="btn btn-primary">Tambah Sapi</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="sapiTable" class="table table-bordered w-100 text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Kode</th>
                                    <th>Jenis</th>
                                    <th>Kelamin</th>
                                    <th>Berat</th>
                                    <th>Lokasi</th>
                                    <th>Status</th> <!-- ✅ Tambah kolom status -->
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
                                        <td>
                                            <?php if (!empty($item->gambar)): ?>
                                                <img src="../../../storages/sapi/<?= $item->gambar ?>" alt="Sapi" width="80" height="80" class="rounded">
                                            <?php else: ?>
                                                <span class="text-muted">Tidak ada</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $item->kode_sapi ?></td>
                                        <td><?= $item->jenis_sapi ?></td>
                                        <td><?= $item->jenis_kelamin ?></td>
                                        <td>
                                            <?= $item->berat_badan_kg ? $item->berat_badan_kg . ' Kg' : '-' ?>
                                        </td>
                                        <td><?= $item->lokasi_kandang ?></td>
                                        <td>
                                            <?php if ($item->status_sapi == 'Aktif'): ?>
                                                <span class="badge bg-success">Aktif</span>
                                            <?php elseif ($item->status_sapi == 'Dijual'): ?>
                                                <span class="badge bg-primary">Dijual</span>
                                            <?php elseif ($item->status_sapi == 'Mati'): ?>
                                                <span class="badge bg-danger">Mati</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="./detail.php?id=<?= $item->id_sapi ?>" class="btn btn-success btn-sm">Detail</a>
                                            <a href="./edit.php?id=<?= $item->id_sapi ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="../../actions/sapi/destroy.php?id=<?= $item->id_sapi ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus sapi ini?')">
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