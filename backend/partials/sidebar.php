<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<style>
  .logo-img img {
    max-width: 130px;
    /* atur lebar maksimal logo */
    height: auto;
    /* tinggi otomatis mengikuti rasio */
    display: block;
    margin: 0 auto;
    /* biar posisinya center */
  }
</style>
<!-- Sidebar Start -->
<aside class="left-sidebar">
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-center mt-4">
      <i href="./index.html" class="text-nowrap logo-img">
        <img src="../../template_admin/src/assets/images/logos/sapi.png" alt="" />
      </i>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">

        <li class="sidebar-item mt-3">
          <a class="sidebar-link <?= ($page == 'dashboard') ? 'active' : '' ?>" href="../dashboard/index.php" aria-expanded="false">
            <span><i class="bi bi-house fs-6"></i></span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>

        <?php if (!empty($_SESSION['hak_akses']) && $_SESSION['hak_akses'] === 'administrator'): ?>
          <li class="sidebar-item">
            <a class="sidebar-link <?= ($page == 'sapi') ? 'active' : '' ?>" href="../sapi/index.php">
              <span><iconify-icon icon="mdi:cow" class="fs-6"></iconify-icon></span>
              <span class="hide-menu">Sapi</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?= ($page == 'pakan') ? 'active' : '' ?>" href="../pakan/index.php">
              <span><i class="bi bi-basket2-fill fs-6"></i></span>
              <span class="hide-menu">Pakan</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?= ($page == 'pemberian_pakan') ? 'active' : '' ?>" href="../pemberian_pakan/index.php">
              <span><i class="bi bi-egg-fried fs-6"></i></span>
              <span class="hide-menu">Pemberian Pakan</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?= ($page == 'riwayat_kesehatan') ? 'active' : '' ?>" href="../riwayat_kesehatan/index.php">
              <span><i class="bi bi-heart-pulse fs-6"></i></span>
              <span class="hide-menu">Riwayat Kesehatan</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?= ($page == 'penjualan') ? 'active' : '' ?>" href="../penjualan/index.php">
              <span><i class="bi bi-cart4 fs-6"></i></span>
              <span class="hide-menu">Penjualan</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?= ($page == 'pengguna') ? 'active' : '' ?>" href="../pengguna/index.php">
              <span><i class="bi bi-people-fill fs-6"></i></span>
              <span class="hide-menu">Pengguna</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?= ($page == 'aktivitas') ? 'active' : '' ?>" href="../aktivitas/index.php">
              <span><i class="bi bi-graph-up-arrow fs-6"></i></span>
              <span class="hide-menu">Aktivitas</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?= ($page == 'laporan') ? 'active' : '' ?>" href="../laporan/index.php">
              <span><i class="bi bi-book fs-6"></i></span>
              <span class="hide-menu">Laporan</span>
            </a>
          </li>
        <?php endif; ?>

        <?php if (!empty($_SESSION['hak_akses']) && $_SESSION['hak_akses'] === 'petugas'): ?>
          <li class="sidebar-item">
            <a class="sidebar-link <?= ($page == 'sapi') ? 'active' : '' ?>" href="../sapi/index.php">
              <span><iconify-icon icon="mdi:cow" class="fs-6"></iconify-icon></span>
              <span class="hide-menu">Sapi</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?= ($page == 'pakan') ? 'active' : '' ?>" href="../pakan/index.php">
              <span><i class="bi bi-basket2-fill fs-6"></i></span>
              <span class="hide-menu">Pakan</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?= ($page == 'pemberian_pakan') ? 'active' : '' ?>" href="../pemberian_pakan/index.php">
              <span><i class="bi bi-egg-fried fs-6"></i></span>
              <span class="hide-menu">Pemberian Pakan</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?= ($page == 'riwayat_kesehatan') ? 'active' : '' ?>" href="../riwayat_kesehatan/index.php">
              <span><i class="bi bi-heart-pulse fs-6"></i></span>
              <span class="hide-menu">Riwayat Kesehatan</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?= ($page == 'penjualan') ? 'active' : '' ?>" href="../penjualan/index.php">
              <span><i class="bi bi-cart4 fs-6"></i></span>
              <span class="hide-menu">Penjualan</span>
            </a>
          </li>
        <?php endif; ?>

      </ul>
    </nav>
  </div>
</aside>
<!--  Sidebar End -->