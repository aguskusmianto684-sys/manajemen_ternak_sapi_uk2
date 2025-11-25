<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "<script>
        alert('Silakan login terlebih dahulu!');
        window.location.href='../../pages/user/login.php';
    </script>";
    exit();
}

$page = 'aktivitas';
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Ambil data log aktivitas join dengan users
$qLog = "
    SELECT l.*, u.nama_lengkap, u.username
    FROM log_activities l
    LEFT JOIN users u ON l.id_user = u.id_user
    ORDER BY l.waktu DESC
";
$result = mysqli_query($connect, $qLog) or die(mysqli_error($connect));
?>

<!-- content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-header d-flex align-items-center justify-content-between"
                    style="background: linear-gradient(135deg, #2a6f97, #01497c, #a9d6e5); border: none;">
                    <h5 class="text-light">Tabel Log Aktivitas</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="logActivitiesTable" class="table table-bordered w-100 text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Aktivitas</th>
                                    <th>Tabel</th>
                                    <th>ID Data</th>
                                    <th>Detail</th>
                                    <th>IP Address</th>
                                    <th>User Agent</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if ($result && $result->num_rows > 0):
                                    while ($item = $result->fetch_object()):
                                ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= htmlspecialchars($item->nama_lengkap ?? $item->username ?? 'Guest') ?></td>
                                            <td><?= htmlspecialchars($item->aktivitas) ?></td>
                                            <td><?= htmlspecialchars($item->tabel ?: '-') ?></td>
                                            <td><?= $item->id_data ?: '-' ?></td>
                                            <td><?= htmlspecialchars($item->detail ?: '-') ?></td>
                                            <td><?= $item->ip_address ?></td>
                                            <td style="max-width:200px;"><?= htmlspecialchars($item->user_agent) ?></td>
                                            <td><?= $item->waktu ?></td>
                                        </tr>
                                    <?php
                                        $no++;
                                    endwhile;
                                else:
                                    ?>
                                    <tr>
                                        <td colspan="9" class="text-center">Belum ada aktivitas</td>
                                    </tr>
                                <?php endif; ?>
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