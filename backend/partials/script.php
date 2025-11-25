  <script src="../../template_admin/src/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../template_admin/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../template_admin/src/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../../template_admin/src/assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../../template_admin/src/assets/js/sidebarmenu.js"></script>
  <script src="../../template_admin/src/assets/js/app.min.js"></script>
  <script src="../../template_admin/src/assets/js/dashboard.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


  <script>
    const hargaInput = document.getElementById("hargaInput");

    hargaInput.addEventListener("input", function(e) {
      let value = this.value.replace(/\D/g, ""); // hanya angka
      if (value) {
        this.value = new Intl.NumberFormat("id-ID").format(value);
      } else {
        this.value = "";
      }
    });

    // Saat submit form, hapus titik agar tersimpan angka murni
    document.querySelector("form").addEventListener("submit", function() {
      hargaInput.value = hargaInput.value.replace(/\./g, "");
    });
  </script>

  <!-- jQuery (wajib) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Select2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#sapiInput').select2({
        theme: "classic",
        placeholder: "-- Cari & Pilih Sapi --"
      });
    });
  </script>

  <script>
    const inputJumlah = document.getElementById('jumlah');

    inputJumlah.addEventListener('input', function(e) {
      let value = this.value;

      // Hapus semua selain angka dan koma/titik
      value = value.replace(/[^0-9.,]/g, '');

      // Ganti koma jadi titik untuk konsistensi
      value = value.replace(',', '.');

      // Pisahkan angka ribuan
      let parts = value.split('.');
      parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');

      this.value = parts.join('.');
    });
  </script>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

  <!-- DataTables Buttons -->
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>

  <!-- Export dependencies -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>


  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

  <!-- jQuery & DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

  <script>
    $(document).ready(function() {

      const tableConfig = {
        responsive: true,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        ordering: true,
        searching: true,
        language: {
          url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
        }
      };

      // Daftar ID tabel sesuai database
      const tables = [
        '#sapiTable',
        '#pakanTable',
        '#pemberianPakanTable',
        '#penjualanTable',
        '#riwayatKesehatanTable',
        '#usersTable',
        '#logActivitiesTable'
      ];

      tables.forEach(function(id) {
        if ($(id).length) { // cek apakah tabel ada di halaman
          $(id).DataTable(tableConfig);
        }
      });

    });
  </script>






  </body>

  </html>