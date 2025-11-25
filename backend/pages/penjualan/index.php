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

// Ambil data penjualan join dengan sapi (kecuali sapi yang sudah mati)
$qPenjualan = "
    SELECT p.*, s.kode_sapi, s.gambar, s.status_sapi
    FROM penjualan p
    LEFT JOIN sapi s ON p.id_sapi = s.id_sapi
    WHERE s.status_sapi != 'Mati'
    ORDER BY p.id_penjualan DESC
";
$result = mysqli_query($connect, $qPenjualan) or die(mysqli_error($connect));
?>

<!-- content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-header d-flex align-items-center justify-content-between"
                    style="background: linear-gradient(135deg, #2a6f97, #01497c, #a9d6e5); border: none;">
                    <h5 class="text-light">Tabel Data Penjualan</h5>
                    <a href="./create.php" class="btn btn-primary">Tambah Penjualan</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="penjualanTable" class="table table-bordered w-100 text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Kode Sapi</th>
                                    <th>Tanggal Jual</th>
                                    <th>Harga Jual</th>
                                    <th>Pembeli</th>
                                    <th>Status Sapi</th>
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
                                                <img src="../../../storages/sapi/<?= htmlspecialchars($item->gambar) ?>"
                                                    alt="Sapi" width="70" height="70" class="rounded shadow-sm">
                                            <?php else: ?>
                                                <span class="text-muted">Tidak ada</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $item->kode_sapi ?: '-' ?></td>
                                        <td><?= $item->tanggal_jual ? date('d-m-Y', strtotime($item->tanggal_jual)) : '-' ?></td>
                                        <td>Rp <?= number_format($item->harga_jual, 0, ',', '.') ?></td>
                                        <td><?= htmlspecialchars($item->pembeli) ?></td>
                                        <td><?= $item->status_sapi ?></td>
                                        <td>
                                            <a href="./detail.php?id=<?= $item->id_penjualan ?>" class="btn btn-success btn-sm">Detail</a>
                                            <a href="./edit.php?id=<?= $item->id_penjualan ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="../../actions/penjualan/destroy.php?id=<?= $item->id_penjualan ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
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