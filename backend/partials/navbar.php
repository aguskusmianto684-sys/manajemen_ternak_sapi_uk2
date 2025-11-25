    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>

          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown d-flex align-items-center">

                <!-- Hak Akses -->
                <span class="me-0 fw-bold fs-6"> <!-- fs-5 = lebih besar -->
                  <?= ucfirst($_SESSION['hak_akses'] ?? 'User'); ?>
                </span>

                <!-- Ikon User -->
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <i class="ti ti-user-circle fs-10"></i> <!-- fs-2 = lebih besar dari fs-4 -->
                </a>


                <!-- Dropdown -->
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <div class="px-3 py-2">
                      <p class="mb-0 fw-bold"><?= $_SESSION['nama_lengkap'] ?? $_SESSION['username']; ?></p>
                      <small class="text-muted"><?= ucfirst($_SESSION['hak_akses'] ?? 'User'); ?></small>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="../../actions/auth/logout.php" class="btn btn-outline-danger mx-3 mt-2 d-block">
                      Logout
                    </a>
                  </div>
                </div>
              </li>
            </ul>
          </div>

        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">