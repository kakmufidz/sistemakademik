<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
  <base href="">
  <title><?= $page_title ?></title>
  <meta charset="utf-8" />
  <meta name="description" content="SISKA adalah platform manajemen sekolah terpadu yang dirancang untuk mempermudah pengelolaan akademik, administrasi, dan komunikasi di lingkungan sekolah. Dengan tampilan antarmuka yang ramah pengguna dan teknologi berbasis web, SISKA membantu sekolah meningkatkan efisiensi kerja, transparansi informasi, dan kualitas layanan pendidikan." />
  <meta name="keywords" content="Sistem Informasi Akademik Sekolah, Aplikasi Manajemen Sekolah, Software Administrasi Sekolah, Platform Sekolah Digital, SISKA Akademik (Branding), Aplikasi Sekolah Terpadu" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="article" />
  <meta property="og:title" content="<?= $page_title ?>" />
  <meta property="og:url" content="https://digitalinsource.web.id/" />
  <meta property="og:site_name" content="SISKA | Sistem Informasi Akademik Sekolah" />
  <link rel="canonical" href="https://digitalinsource.web.id/" />
  <link rel="shortcut icon" href="<?= base_url() ?>assets/media/logos/android-chrome-512x512.png" />
  <!--begin::Fonts-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
  <!--end::Fonts-->
  <!--begin::Global Stylesheets Bundle(used by all pages)-->
  <link href="<?= base_url() ?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/css/mystyle.css" rel="stylesheet" type="text/css" />
  <!--end::Global Stylesheets Bundle-->
  <!--begin::Custom Stylesheets Bundle-->
  <link href="<?= base_url() ?>assets/plugins/custom/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/plugins/custom/magnific-popup/dist/magnific-popup.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/plugins/custom/leaflet/leaflet.css" rel="stylesheet" type="text/css" />
  <script src="<?= base_url() ?>assets/plugins/custom/leaflet/leaflet.js"></script>
  <!--bend::Custom Stylesheets Bundle-->
  <!--begin::Page Custom Javascript(used by this page)-->
  <script src="<?= base_url() ?>assets/plugins/custom/datatables/datatables.min.js"></script>
  <!--end::Page Custom Javascript-->
  <!--begin::Global Javascript Bundle(used by all pages)-->
  <script src="<?= base_url() ?>assets/plugins/global/plugins.bundle.js"></script>
  <script src="<?= base_url() ?>assets/js/scripts.bundle.js"></script>
  <!--end::Global Javascript Bundle-->
  <style>
    @media (max-width: 768px) {

      /* Untuk layar dengan lebar maksimum 768px (umumnya mobile) */
      .timeline-line,
      .timeline-svg,
      .timeline-icon {
        display: none !important;
      }
    }
  </style>


  <style>
    /* iframe fullscreen style */
    .mfp-iframe-scaler {
      width: 95vw;
      /* hampir penuh, ada jarak */
      height: 90vh;
      max-width: 100%;
      max-height: 100%;
    }

    .mfp-iframe-scaler iframe {
      width: 100%;
      height: 100%;
    }

    .mfp-close {
      top: -10px;
      /* tombol close tetap ada di atas */
      right: -10px;
    }
  </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="header-tablet-and-mobile-fixed aside-enabled">
  <!--begin::Main-->
  <!--begin::Root-->
  <div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
      <!--begin::Aside-->
      <?= $this->include('layouts/sidebar') ?>
      <!--end::Aside-->
      <!--begin::Wrapper-->
      <div class="wrapper d-flex flex-column flex-row-fluid">
        <!--begin::Header-->
        <?= $this->include('layouts/header') ?>
        <!--end::Header-->
        <!--begin::Content-->
        <div class="content d-flex flex-column flex-column-fluid">
          <!--begin::Post-->
          <?= $this->renderSection('content') ?>
          <!--end::Post-->
        </div>
        <!--end::Content-->
        <!--begin::Footer-->
        <?= $this->include('layouts/footer') ?>
        <!--end::Footer-->
      </div>
      <!--end::Wrapper-->
    </div>
    <!--end::Page-->
  </div>
  <!--end::Root-->
  <!--begin::Modals-->
  <div class="modal fade" id="modalLogout" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
      <!--begin::Modal content-->
      <div class="modal-content">
        <!--begin::Modal header-->
        <div class="modal-header pb-0 border-0 justify-content-end">
          <!--begin::Close-->
          <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
            <span class="svg-icon svg-icon-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
              </svg>
            </span>
            <!--end::Svg Icon-->
          </div>
          <!--end::Close-->
        </div>
        <!--begin::Modal header-->
        <!--begin::Modal body-->
        <div class="modal-body mx-5 mx-xl-18 pt-0 pb-15">
          <!--begin::Heading-->
          <div class="text-center mb-13">
            <!--begin::Title-->
            <h1 class="mb-3">Keluar</h1>
            <!--end::Title-->
            <!--begin::Description-->
            <div class="text-muted fw-bold fs-5 mb-5">Apakah yakin mau keluar?</div>
            <!--end::Description-->
            <div class="align-center">
              <a href="<?= base_url() ?>auth/logout" class="btn btn-danger">Ya, Keluar</a>
              <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            </div>
          </div>
          <!--end::Heading-->
        </div>
        <!--end::Modal body-->
      </div>
      <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
  </div>
  <?= $this->renderSection('modal') ?>
  <!--end::Modals-->
  <!--begin::Scrolltop-->
  <div class="scrolltop" data-kt-scrolltop="true">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
    <span class="svg-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
      </svg>
    </span>
    <!--end::Svg Icon-->
  </div>
  <!--end::Scrolltop-->
  <!--end::Main-->
  <script>
    var hostUrl = "<?= base_url() ?>assets/";
  </script>
  <!--begin::Javascript-->
  <!--begin::Global Javascript Bundle(used by all pages)-->
  <script src="<?= base_url() ?>assets/plugins/global/plugins.bundle.js"></script>
  <script src="<?= base_url() ?>assets/js/myjs.js"></script>
  <!--end::Global Javascript Bundle-->
  <!--begin::Page Custom Javascript(used by this page)-->
  <script src="<?= base_url() ?>assets/js/custom/widgets.js"></script>
  <script src="<?= base_url() ?>assets/js/custom/apps/chat/chat.js"></script>
  <script src="<?= base_url() ?>assets/js/custom/modals/create-app.js"></script>
  <script src="<?= base_url() ?>assets/js/custom/modals/upgrade-plan.js"></script>
  <script src="<?= base_url() ?>assets/plugins/custom/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
  <!--end::Page Custom Javascript-->
  <script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', function() {
        navigator.serviceWorker.register('/service-worker.js')
          .then(function(registration) {
            console.log('Service Worker registered with scope:', registration.scope);
          }, function(err) {
            console.log('Service Worker registration failed:', err);
          });
      });
    }

    // Delegasi: akan bekerja meskipun input ditambahkan setelah load
    document.addEventListener('wheel', function(e) {
      const el = e.target;
      if (el.matches('input[type="number"]') && el === document.activeElement) {
        e.preventDefault();
      }
    }, {
      passive: false
    });

    $(document).ready(function() {
      if (sessionStorage.getItem("alert") == "show") {
        Swal.fire({
          position: 'center',
          icon: sessionStorage.getItem("alert_icon") ?? 'success',
          title: sessionStorage.getItem("alert_title") ?? 'Berhasil',
          showConfirmButton: false,
          timer: 2000
        });
        sessionStorage.removeItem("alert");
        sessionStorage.removeItem("alert_icon");
        sessionStorage.removeItem("alert_title");
      }

      // Fungsi untuk memperbarui waktu
      function updateTimer() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();

        // Format waktu
        var timeString = addZero(hours) + ":" + addZero(minutes) + ":" + addZero(seconds);

        // Memperbarui elemen HTML dengan waktu terbaru
        $(".count_time").html(timeString);
      }

      // Fungsi untuk menambahkan angka nol di depan bilangan satu digit
      function addZero(num) {
        return (num >= 0 && num < 10) ? "0" + num : num;
      }

      // Memanggil fungsi updateTimer() setiap 1 detik
      setInterval(updateTimer, 1000);
    });
  </script>
  <!--end::Javascript-->
  <?= $this->renderSection('script') ?>
</body>
<!--end::Body-->

</html>