<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  echo "<script>
        alert('Silakan login terlebih dahulu!');
        window.location.href='../../pages/user/login.php';
    </script>";
  exit();
}

$page = 'dashboard';
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

//  Statistik 
$q = [
  "sapi"      => "SELECT COUNT(*) AS total FROM sapi",
  "penjualan" => "SELECT COUNT(*) AS total FROM penjualan",
  "pakan"     => "SELECT COUNT(*) AS total FROM pemberian_pakan",
  "riwayat"   => "SELECT COUNT(*) AS total FROM riwayat_kesehatan",
];

$result = [];
foreach ($q as $key => $sql) {
  $row = mysqli_fetch_assoc(mysqli_query($connect, $sql));
  $result[$key] = $row['total'] ?? 0;
}

$totalSapi      = $result['sapi'];
$totalPenjualan = $result['penjualan'];
$totalPakan     = $result['pakan'];
$totalRiwayat   = $result['riwayat'];

//  Data Chart 
// Pie chart: jenis kelamin sapi
$qJk = mysqli_query($connect, "SELECT jenis_kelamin, COUNT(*) as total FROM sapi GROUP BY jenis_kelamin");
$labelsJk = [];
$dataJk   = [];
while ($row = mysqli_fetch_assoc($qJk)) {
  $labelsJk[] = ucfirst($row['jenis_kelamin']);
  $dataJk[]   = $row['total'];
}

// Bar chart: pendapatan 6 bulan terakhir
$qPendapatan = mysqli_query($connect, "
    SELECT DATE_FORMAT(MIN(p.tanggal_jual), '%M %Y') AS bulan, 
           s.jenis_sapi,
           SUM(p.harga_jual) AS total,
           YEAR(p.tanggal_jual) as thn,
           MONTH(p.tanggal_jual) as bln
    FROM penjualan p
    JOIN sapi s ON p.id_sapi = s.id_sapi
    GROUP BY YEAR(p.tanggal_jual), MONTH(p.tanggal_jual), s.jenis_sapi
    ORDER BY YEAR(p.tanggal_jual) DESC, MONTH(p.tanggal_jual) DESC
    LIMIT 60
") or die(mysqli_error($connect));

$rawData = [];
while ($row = mysqli_fetch_assoc($qPendapatan)) {
  $key = $row['thn'] . '-' . $row['bln'];
  $rawData[$key]['label'] = $row['bulan'];
  $rawData[$key]['data'][$row['jenis_sapi']] = $row['total'];
}

// Ambil hanya 6 bulan terakhir, urutkan ascending
$last6 = array_slice(array_reverse($rawData, true), -6, 6, true);

$labelsPendapatan = [];
$datasetsPendapatan = [];
foreach ($last6 as $bulanKey => $bulanData) {
  $labelsPendapatan[] = $bulanData['label'];
  foreach ($bulanData['data'] as $jenis => $val) {
    $datasetsPendapatan[$jenis][$bulanData['label']] = $val;
  }
}

// Susun dataset untuk Chart.js
$chartDatasets = [];
$colors = ['#1d3557', '#e63946', '#2a9d8f', '#f4a261', '#6a4c93', '#118ab2'];
$i = 0;
foreach ($datasetsPendapatan as $jenis => $dataBulan) {
  $data = [];
  foreach ($labelsPendapatan as $bulan) {
    $data[] = $dataBulan[$bulan] ?? 0;
  }
  $chartDatasets[] = [
    "label" => $jenis,
    "data" => $data,
    "backgroundColor" => $colors[$i % count($colors)]
  ];
  $i++;
}

// Hitung total pendapatan
$qTotal = mysqli_query($connect, "SELECT SUM(harga_jual) as total FROM penjualan");
$totalPendapatan = 0;
if ($row = mysqli_fetch_assoc($qTotal)) {
  $totalPendapatan = $row['total'] ?? 0;
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
  /* Welcome Section */
  .welcome-card h1,
  .welcome-card h3 {
    color: #fff !important;
    letter-spacing: 1px;
  }

  /* Statistik Card */
  .card-stats {
    border-radius: 12px;
    padding: 20px;
    height: 160px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    transition: 0.3s;
  }

  .card-stats:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
  }

  .card-stats .card-category {
    font-size: 14px;
    font-weight: 600;
    color: #6c757d;
    margin-bottom: 4px;
  }

  .card-stats .card-title {
    font-size: 26px;
    font-weight: bold;
    margin: 0;
    color: #212529;
  }

  .card-stats a {
    font-size: 13px;
    font-weight: 500;
  }

  .icon-big {
    font-size: 42px;
  }

  /* Chart Section */
  .chart-card {
    border-radius: 12px;
    padding: 20px;
    height: 400px;
    /* samain tinggi chart */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .chart-card canvas {
    max-height: 280px !important;
    /* samain ukuran canvas */
  }

  .chart-legend {
    font-size: 14px;
    margin-top: 12px;
    text-align: center;
  }

  .chart-legend ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .chart-legend li {
    display: inline-block;
    margin: 0 12px;
  }

  /* Responsive tweaks */
  @media (max-width: 768px) {
    .card-stats {
      height: auto;
      padding: 15px;
    }

    .chart-card {
      height: auto;
    }
  }
</style>

<div class="container-fluid">
  <!-- Welcome -->
  <div class="row">
    <div class="col-md-12 mb-4">
      <div class="card welcome-card" style="background: linear-gradient(135deg, #1d3557, #457b9d, #1d3557); border: none;">
        <div class="card-body text-center py-4">
          <h1 class="fw-bold">SELAMAT DATANG</h1>
          <h3 class="mb-0 text-uppercase">Di Manajemen Ternak Sapi</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Statistik -->
  <div class="row">
    <div class="col-sm-6 col-md-3 mb-3">
      <div class="card card-stats shadow-sm">
        <div>
          <p class="card-category">Total Sapi</p>
          <h4 class="card-title"><?= $totalSapi ?></h4>
          <a href="../sapi/index.php" class="text-decoration-none text-success">Detail</a>
        </div>
        <div class="text-success">
          <i class="mdi mdi-cow icon-big"></i>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-3 mb-3">
      <div class="card card-stats shadow-sm">
        <div>
          <p class="card-category">Penjualan</p>
          <h4 class="card-title"><?= $totalPenjualan ?></h4>
          <a href="../penjualan/index.php" class="text-decoration-none text-primary">Detail</a>
        </div>
        <div class="text-primary">
          <i class="mdi mdi-cash-multiple icon-big"></i>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-3 mb-3">
      <div class="card card-stats shadow-sm">
        <div>
          <p class="card-category">Pemberian Pakan</p>
          <h4 class="card-title"><?= $totalPakan ?></h4>
          <a href="../pemberian_pakan/index.php" class="text-decoration-none text-warning">Detail</a>
        </div>
        <div class="text-warning">
          <i class="mdi mdi-seed-outline icon-big"></i>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-3 mb-3">
      <div class="card card-stats shadow-sm">
        <div>
          <p class="card-category">Riwayat Kesehatan</p>
          <h4 class="card-title"><?= $totalRiwayat ?></h4>
          <a href="../riwayat_kesehatan/index.php" class="text-decoration-none text-danger">Detail</a>
        </div>
        <div class="text-danger">
          <i class="mdi mdi-hospital-box-outline icon-big"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Grafik -->
  <div class="row mt-4">
    <div class="col-lg-6 mb-4">
      <div class="card shadow-sm chart-card">
        <h5 class="card-title text-center mb-3">Distribusi Jenis Kelamin Sapi</h5>
        <canvas id="chartJenisKelamin"></canvas>
        <div id="descJenisKelamin" class="chart-legend"></div>
      </div>
    </div>

    <div class="col-lg-6 mb-4">
      <div class="card shadow-sm chart-card">
        <h5 class="card-title text-center mb-3">Pendapatan 6 Bulan Terakhir</h5>
        <canvas id="chartPendapatan"></canvas>
        <div id="descPendapatan" class="chart-legend"></div>
        <p class="mt-2 fw-bold text-center">Total Pendapatan: Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></p>
      </div>
    </div>
  </div>
</div>
<!-- Tabel Penjualan -->
<div class="row mb-4">
  <div class="col-12">
    <div class="card shadow-sm" style="border-radius: 12px; overflow: hidden;">
      <div class="card-header d-flex align-items-center justify-content-between"
        style="background: linear-gradient(135deg, #2a6f97, #01497c, #a9d6e5); border: none;">
        <h5 class="mb-0 fw-bold text-white">Data Penjualan Terbaru</h5>
        <a href="../penjualan/index.php" class="btn btn-sm fw-semibold"
          style="background-color:#007bff; color:#fff; border-radius:6px;">
          Lihat Selengkapnya
        </a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr class="text-center">
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tanggal Jual</th>
                <th style="width: 15%;">Kode Sapi</th>
                <th style="width: 20%;">Jenis Sapi</th>
                <th style="width: 25%;">Pembeli</th>
                <th style="width: 20%;">Harga Jual</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $qTable = mysqli_query($connect, "
                SELECT p.tanggal_jual, s.kode_sapi, s.jenis_sapi, p.pembeli, p.harga_jual
                FROM penjualan p
                JOIN sapi s ON p.id_sapi = s.id_sapi
                ORDER BY p.tanggal_jual DESC
                LIMIT 5
              ");
              $no = 1;
              if (mysqli_num_rows($qTable) > 0) {
                while ($row = mysqli_fetch_assoc($qTable)) {
                  echo "<tr class='text-center'>
                          <td>{$no}</td>
                          <td>" . date('d-m-Y', strtotime($row['tanggal_jual'])) . "</td>
                          <td>{$row['kode_sapi']}</td>
                          <td>{$row['jenis_sapi']}</td>
                          <td>{$row['pembeli']}</td>
                          <td class='fw-semibold text-success'>Rp " . number_format($row['harga_jual'], 0, ',', '.') . "</td>
                        </tr>";
                  $no++;
                }
              } else {
                echo "<tr><td colspan='6' class='text-center text-muted'>Belum ada data penjualan</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>





<script>
  // Pie Chart
  const dataJenisKelamin = {
    labels: <?= json_encode($labelsJk) ?>,
    datasets: [{
      data: <?= json_encode($dataJk) ?>,
      backgroundColor: ['#2a9d8f', '#e76f51']
    }]
  };
  new Chart(document.getElementById('chartJenisKelamin'), {
    type: 'pie',
    data: dataJenisKelamin,
    options: {
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });
  let desc = "<ul>";
  const total = dataJenisKelamin.datasets[0].data.reduce((a, b) => a + b, 0);
  dataJenisKelamin.labels.forEach((label, i) => {
    const val = dataJenisKelamin.datasets[0].data[i];
    const persen = ((val / total) * 100).toFixed(1);
    desc += `<li><span style="color:${dataJenisKelamin.datasets[0].backgroundColor[i]}">■</span> ${label}: ${val} ekor (${persen}%)</li>`;
  });
  desc += "</ul>";
  document.getElementById('descJenisKelamin').innerHTML = desc;

  // Bar Chart
  const dataPendapatan = {
    labels: <?= json_encode($labelsPendapatan) ?>,
    datasets: <?= json_encode($chartDatasets) ?>
  };
  new Chart(document.getElementById('chartPendapatan'), {
    type: 'bar',
    data: dataPendapatan,
    options: {
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return 'Rp ' + value.toLocaleString();
            }
          }
        }
      }
    }
  });
  let descP = "<ul>";
  dataPendapatan.datasets.forEach((ds) => {
    descP += `<li><span style="color:${ds.backgroundColor}">■</span> ${ds.label}</li>`;
  });
  descP += "</ul>";
  document.getElementById('descPendapatan').innerHTML = descP;
</script>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>