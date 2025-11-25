<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  echo "<script>
        alert('Silakan login terlebih dahulu!');
        window.location.href='../../pages/user/login.php';
    </script>";
  exit();
}
$page = 'laporan';
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// ambil filter tanggal
$mulai   = $_GET['mulai'] ?? '';
$sampai  = $_GET['sampai'] ?? '';

// query laporan ringkas
$qLaporan = "
    SELECT s.kode_sapi,
           s.jenis_sapi,
           p.harga_jual,
           rk.jenis_kegiatan,
           pk.nama_pakan
    FROM sapi s
    LEFT JOIN penjualan p ON s.id_sapi = p.id_sapi
    LEFT JOIN riwayat_kesehatan rk ON s.id_sapi = rk.id_sapi
    LEFT JOIN pemberian_pakan pp ON s.id_sapi = pp.id_sapi
    LEFT JOIN pakan pk ON pp.id_pakan = pk.id_pakan
    WHERE 1=1
";

if ($mulai && $sampai) {
  $qLaporan .= "
    AND (
      (p.tanggal_jual BETWEEN '$mulai' AND '$sampai')
      OR (rk.tanggal BETWEEN '$mulai' AND '$sampai')
      OR (pp.tanggal BETWEEN '$mulai' AND '$sampai')
    )
  ";
}

$qLaporan .= " ORDER BY s.kode_sapi ASC";

$result = mysqli_query($connect, $qLaporan) or die(mysqli_error($connect));
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card shadow-lg border-0">
        <div class="card-header text-white" 
             style="background: linear-gradient(135deg, #0077b6, #023e8a); border-radius: 8px 8px 0 0;">
          <h5 class="mb-0 text-light">Tabel Laporan</h5>
        </div>
        <div class="card-body">

          <!-- filter -->
          <form method="GET" class="row g-3 mb-4">
            <div class="col-md-4">
              <label class="form-label fw-semibold">Dari Tanggal</label>
              <input type="date" name="mulai" value="<?= $mulai ?>" class="form-control shadow-sm">
            </div>
            <div class="col-md-4">
              <label class="form-label fw-semibold">Sampai Tanggal</label>
              <input type="date" name="sampai" value="<?= $sampai ?>" class="form-control shadow-sm">
            </div>
            <div class="col-md-4 d-flex align-items-end">
              <button type="submit" class="btn btn-primary me-2 shadow-sm">
                <i class="bi bi-funnel"></i> Filter
              </button>
              <a href="index.php" class="btn btn-secondary shadow-sm">
                <i class="bi bi-arrow-repeat"></i> Reset
              </a>
            </div>
          </form>

          <!-- tabel laporan -->
          <div class="table-responsive">
            <table id="laporanTable" class="table table-bordered table-hover table-sm align-middle text-center">
              <thead class="table-primary text-dark">
                <tr>
                  <th>No</th>
                  <th>Kode Sapi</th>
                  <th>Jenis Sapi</th>
                  <th>Harga Jual</th>
                  <th>Jenis Kegiatan</th>
                  <th>Nama Pakan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $total = 0;
                while ($row = mysqli_fetch_assoc($result)): ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['kode_sapi'] ?></td>
                    <td><?= $row['jenis_sapi'] ?></td>
                    <td>
                      <?php if ($row['harga_jual']): ?>
                        Rp <?= number_format($row['harga_jual'], 0, ',', '.') ?>
                        <?php $total += $row['harga_jual']; ?>
                      <?php else: ?> - <?php endif; ?>
                    </td>
                    <td><?= $row['jenis_kegiatan'] ?? '-' ?></td>
                    <td><?= $row['nama_pakan'] ?? '-' ?></td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
              <tfoot>
                <tr class="fw-bold table-light">
                  <td colspan="3" class="text-end">Total Pendapatan</td>
                  <td colspan="3">Rp <?= number_format($total, 0, ',', '.') ?></td>
                </tr>
              </tfoot>
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

<!-- DataTables setup -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
  $('#laporanTable').DataTable({
    pageLength: 10,
    dom: '<"d-flex justify-content-between align-items-center mb-3"Bf>rtip',
    buttons: [
      { extend: 'copy', text: '<i class="bi bi-clipboard"></i> Copy', className: 'btn btn-secondary btn-sm shadow-sm', exportOptions: { columns: [0,1,2,3,4,5] }},
      { extend: 'excel', text: '<i class="bi bi-file-excel"></i> Excel', className: 'btn btn-success btn-sm shadow-sm', exportOptions: { columns: [0,1,2,3,4,5] }},
      { extend: 'csv', text: '<i class="bi bi-filetype-csv"></i> CSV', className: 'btn btn-info btn-sm text-white shadow-sm', exportOptions: { columns: [0,1,2,3,4,5] }},
      { extend: 'pdfHtml5',
        text: '<i class="bi bi-file-pdf"></i> PDF',
        className: 'btn btn-danger btn-sm shadow-sm',
        exportOptions: { columns: [0,1,2,3,4,5] },
        footer: true,
        orientation: 'portrait',
        pageSize: 'A4',
        title: 'Laporan Ringkas (Penjualan, Kesehatan, Pakan)',
        customize: function(doc) {
          doc.styles.tableHeader = {
            bold: true,
            fontSize: 11,
            color: 'white',
            fillColor: '#0077b6',
            alignment: 'center'
          };
          doc.defaultStyle.fontSize = 10;
          doc.defaultStyle.alignment = 'center';
          // Footer style
          doc.content[doc.content.length - 1].table.body[doc.content[doc.content.length - 1].table.body.length - 1].forEach(function(cell) {
            cell.fillColor = '#f1f1f1';
            cell.bold = true;
          });
        }
      },
      { extend: 'print',
        text: '<i class="bi bi-printer"></i> Print',
        className: 'btn btn-dark btn-sm shadow-sm',
        exportOptions: { columns: [0,1,2,3,4,5] },
        footer: true,
        title: '<h4 class="text-center mb-3">Laporan Ringkas (Penjualan, Kesehatan, Pakan)</h4>',
        customize: function (win) {
          $(win.document.body).css('font-size','10pt');
          $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
          $(win.document.body).find('tfoot tr').css({'font-weight':'bold','background':'#f1f1f1'});
        }
      }
    ],
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
    }
  });
});
</script>
