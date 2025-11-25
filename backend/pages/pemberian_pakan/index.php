<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "<script>
        alert('Silakan login terlebih dahulu!');
        window.location.href='../../pages/user/login.php';
    </script>";
    exit();
}
$page = 'pemberian_pakan';
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Ambil data pemberian pakan dari database
$qPemberian = "
    SELECT pp.id_pemberian, s.kode_sapi, s.jenis_sapi, p.nama_pakan, pp.jumlah_kg, pp.tanggal
    FROM pemberian_pakan pp
    JOIN sapi s ON pp.id_sapi = s.id_sapi
    JOIN pakan p ON pp.id_pakan = p.id_pakan
    ORDER BY pp.tanggal DESC
";
$result = mysqli_query($connect, $qPemberian) or die(mysqli_error($connect));
?>

<!-- content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-header d-flex align-items-center justify-content-between"
                    style="background: linear-gradient(135deg, #2a6f97, #01497c, #a9d6e5); border: none;">
                    <h5 class="text-light">Tabel Pemberian Pakan</h5>
                    <a href="./create.php" class="btn btn-primary">Tambah Pemberian Pakan</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="pemberianPakanTable" class="table table-bordered w-100 text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Sapi</th>
                                    <th>Jenis Sapi</th>
                                    <th>Nama Pakan</th>
                                    <th>Jumlah (Kg)</th>
                                    <th>Tanggal</th>
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
                                        <td><?= htmlspecialchars($item->kode_sapi) ?></td>
                                        <td><?= htmlspecialchars($item->jenis_sapi) ?></td>
                                        <td><?= htmlspecialchars($item->nama_pakan) ?></td>
                                        <td><?= number_format($item->jumlah_kg, 2) ?></td>
                                        <td><?= $item->tanggal ?></td>
                                        <td>
                                            <a href="./edit.php?id=<?= $item->id_pemberian ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="../../actions/pemberian_pakan/destroy.php?id=<?= $item->id_pemberian ?>"
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