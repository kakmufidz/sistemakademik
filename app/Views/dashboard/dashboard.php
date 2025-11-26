<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<div class="post d-flex flex-column-fluid" id="kt_post">
  <!--begin::Container-->
  <div id="kt_content_container" class="container-xxl">
    <!--begin::Row-->
    <div class="row">
      <div class="col-xl-4">
        <!--begin::Statistics Widget 5-->
        <a href="#" class="card bg-secondary hoverable card-xl-stretch mb-5 mb-xl-8">
          <!--begin::Body-->
          <div class="card-body">
            <!--begin::Svg Icon | path: icons/duotune/general/gen008.svg-->
            <span class="svg-icon svg-icon-dark svg-icon-3x ms-n1">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M3 2H10C10.6 2 11 2.4 11 3V10C11 10.6 10.6 11 10 11H3C2.4 11 2 10.6 2 10V3C2 2.4 2.4 2 3 2Z" fill="black" />
                <path opacity="0.3" d="M14 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H14C13.4 11 13 10.6 13 10V3C13 2.4 13.4 2 14 2Z" fill="black" />
                <path opacity="0.3" d="M3 13H10C10.6 13 11 13.4 11 14V21C11 21.6 10.6 22 10 22H3C2.4 22 2 21.6 2 21V14C2 13.4 2.4 13 3 13Z" fill="black" />
                <path opacity="0.3" d="M14 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H14C13.4 22 13 21.6 13 21V14C13 13.4 13.4 13 14 13Z" fill="black" />
              </svg>
            </span>
            <!--end::Svg Icon-->
            <div class="text-dark fw-bolder fs-2 mb-2 mt-5"><?= $karyawan["workshop"]["aktif"] + $karyawan["onsite"]["aktif"] ?></div>
            <div class="fw-bold text-dark">Karyawan Aktif</div>
          </div>
          <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
      </div>
      <div class="col-xl-4">
        <!--begin::Statistics Widget 5-->
        <a href="#" class="card bg-primary hoverable card-xl-stretch mb-5 mb-xl-8">
          <!--begin::Body-->
          <div class="card-body">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr070.svg-->
            <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
                <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
                <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
                <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
              </svg>
            </span>
            <!--end::Svg Icon-->
            <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5"><?= $karyawan["workshop"]["tetap"] + $karyawan["onsite"]["tetap"] ?></div>
            <div class="fw-bold text-gray-100">Karyawan Tetap</div>
          </div>
          <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
      </div>
      <div class="col-xl-4">
        <!--begin::Statistics Widget 5-->
        <a href="#" class="card bg-dark hoverable card-xl-stretch mb-5 mb-xl-8">
          <!--begin::Body-->
          <div class="card-body">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr070.svg-->
            <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
                <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
                <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
                <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
              </svg>
            </span>
            <!--end::Svg Icon-->
            <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5"><?= $karyawan["workshop"]["kontrak"] + $karyawan["onsite"]["kontrak"] ?></div>
            <div class="fw-bold text-gray-100">Karyawan Kontrak</div>
          </div>
          <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
      </div>
      <div class="col-xl-4">
        <!--begin::Statistics Widget 5-->
        <a href="#" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
          <!--begin::Body-->
          <div class="card-body">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr070.svg-->
            <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
                <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
                <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
                <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
              </svg>
            </span>
            <!--end::Svg Icon-->
            <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5"><?= $karyawan["workshop"]["training"] + $karyawan["onsite"]["training"] ?></div>
            <div class="fw-bold text-gray-100">Karyawan Training</div>
          </div>
          <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
      </div>
      <div class="col-xl-4">
        <!--begin::Statistics Widget 5-->
        <a href="#" class="card bg-danger hoverable card-xl-stretch mb-5 mb-xl-8">
          <!--begin::Body-->
          <div class="card-body">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr070.svg-->
            <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
                <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
                <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
                <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
              </svg>
            </span>
            <!--end::Svg Icon-->
            <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5"><?= $karyawan["workshop"]["resign"] + $karyawan["onsite"]["resign"] ?></div>
            <div class="fw-bold text-gray-100">Karyawan Resign</div>
          </div>
          <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
      </div>
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row">
      <!--begin::Col-->
      <?php
      $office = ["workshop", "onsite"];
      foreach ($office as $place): ?>
        <div class="col-lg-6">
          <!--begin::Summary-->
          <div class="card card-flush h-lg-100 mb-5">
            <!--begin::Card header-->
            <div class="card-header mt-6">
              <!--begin::Card title-->
              <div class="card-title flex-column">
                <h3 class="fw-bolder mb-1">Karyawan <?= ucfirst($place) ?></h3>
                <div class="fs-6 fw-bold text-gray-400">Harapan Jaya</div>
              </div>
              <!--end::Card title-->
              <!--begin::Card toolbar-->
              <div class="card-toolbar">
                <a href="<?= base_url() ?>karyawan/<?= $place ?>" class="btn btn-light btn-sm">Lihat Data</a>
              </div>
              <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body p-9 pt-5">
              <!--begin::Wrapper-->
              <div class="d-flex flex-wrap">
                <!--begin::Chart-->
                <div class="position-relative d-flex flex-center h-175px w-175px me-15 mb-7">
                  <div class="position-absolute translate-middle start-50 top-50 d-flex flex-column flex-center text-center">
                    <span class="fs-2qx fw-bolder"><?= $karyawan[$place]["aktif"] ?></span>
                    <span class="fs-6 fw-bold text-gray-400">Karyawan Aktif</span>
                  </div>
                  <canvas id="cart_karyawan_<?= $place ?>"></canvas>
                </div>
                <!--end::Chart-->
                <!--begin::Labels-->
                <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                  <!--begin::Label-->
                  <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                    <div class="bullet bg-secondary me-3"></div>
                    <div class="text-gray-400">Aktif</div>
                    <div class="ms-auto fw-bolder text-gray-700"><?= $karyawan[$place]["aktif"] ?></div>
                  </div>
                  <!--end::Label-->
                  <!--begin::Label-->
                  <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                    <div class="bullet bg-primary me-3"></div>
                    <div class="text-gray-400">Tetap</div>
                    <div class="ms-auto fw-bolder text-gray-700"><?= $karyawan[$place]["tetap"] ?></div>
                  </div>
                  <!--end::Label-->
                  <!--begin::Label-->
                  <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                    <div class="bullet bg-dark me-3"></div>
                    <div class="text-gray-400">Kontrak</div>
                    <div class="ms-auto fw-bolder text-gray-700"><?= $karyawan[$place]["kontrak"] ?></div>
                  </div>
                  <!--end::Label-->
                  <!--begin::Label-->
                  <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                    <div class="bullet bg-info me-3"></div>
                    <div class="text-gray-400">Training</div>
                    <div class="ms-auto fw-bolder text-gray-700"><?= $karyawan[$place]["training"] ?></div>
                  </div>
                  <!--end::Label-->
                  <!--begin::Label-->
                  <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                    <div class="bullet bg-danger me-3"></div>
                    <div class="text-gray-400">Resign</div>
                    <div class="ms-auto fw-bolder text-gray-700"><?= $karyawan[$place]["resign"] ?></div>
                  </div>
                  <!--end::Label-->
                  <!--begin::Label-->
                  <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                    <div class="bullet bg-gray me-3"></div>
                    <div class="text-gray-400">Total</div>
                    <div class="ms-auto fw-bolder text-gray-700"><?= $karyawan[$place]["all"] ?></div>
                  </div>
                  <!--end::Label-->
                </div>
                <!--end::Labels-->
              </div>
              <!--end::Wrapper-->
            </div>
            <!--end::Card body-->
          </div>
          <!--end::Summary-->
        </div>
      <?php endforeach; ?>
      <!--end::Col-->
    </div>
    <!--end::Row-->
  </div>
  <!--end::Container-->
</div>
<?= $this->endSection() ?>
<?= $this->section('modal') ?>
<!--begin::Modal - Create App-->
<div class="modal fade" id="modalnotification" tabindex="-1" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog modal-dialog-centered mw-900px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header">
        <!--begin::Modal title-->
        <h2>Notifikasi Sistem</h2>
        <!--end::Modal title-->
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
      <!--end::Modal header-->
      <form id="form_notif" action="#">
        <!--begin::Modal body-->
        <div class="modal-body">
          <div class="card card-xl-stretch">
            <!--begin::Body-->
            <div class="card-body">
              <!--begin::Item-->
              <div class="d-flex align-items-center bg-light-warning rounded p-5">
                <!--begin::Title-->
                <div class="flex-grow-1 me-2">
                  <div class="message"></div>
                </div>
                <!--end::Title-->
              </div>
              <!--end::Item-->
            </div>
            <!--end::Body-->
          </div>
        </div>
        <!--end::Modal body-->
        <div class="modal-footer">
          <div id="notif-error" class="fv-plugins-message-container invalid-feedback"></div>
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Tandai Sudah Baca</button>
        </div>
      </form>
    </div>
    <!--end::Modal content-->
  </div>
  <!--end::Modal dialog-->
</div>
<!--end::Modal - Create App-->
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
  let chartInstance; // Simpan instance Chart di luar fungsi

  function chart_karyawan() {
    // Jika ada chart sebelumnya, destroy dulu sebelum membuat yang baru
    if (chartInstance) {
      chartInstance.destroy();
    }

    const chart_karyawan = ["workshop", "onsite"];

    chart_karyawan.forEach(element => {
      let tetap, kontrak, resign;

      if (element === "workshop") {
        tetap = <?= $karyawan['workshop']["tetap"] ?>;
        kontrak = <?= $karyawan['workshop']["kontrak"] ?>;
        training = <?= $karyawan['workshop']["training"] ?>;
        resign = <?= $karyawan['workshop']["resign"] ?>;
      } else {
        tetap = <?= $karyawan['onsite']["tetap"] ?>;
        kontrak = <?= $karyawan['onsite']["kontrak"] ?>;
        training = <?= $karyawan['onsite']["training"] ?>;
        resign = <?= $karyawan['onsite']["resign"] ?>;
      }

      const ctx = document.getElementById('cart_karyawan_' + element);

      // Buat chart baru dan simpan instance-nya
      chartInstance = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['Tetap', 'Kontrak', 'Trainng', 'Resign'],
          datasets: [{
            data: [tetap, kontrak, training, resign],
            backgroundColor: [
              '#009EF7', // tetap
              '#131628', // kontrak
              '#7239EA', // resign
              '#F1416C', // resign
            ],
            borderWidth: 0
          }]
        },
        options: {
          plugins: {
            legend: {
              display: false
            }
          },
          cutout: '80%',
        }
      });
    });
  }

  function get_notif() {
    $.ajax({
      url: '<?= base_url('dashboard/get_data?act=getnotif') ?>',
      type: 'POST',
      data: {
        kategori: 'notif_kontrak'
      },
      success: function(result) {
        if (result && result.data && result.data.message) {
          var html = '<input type="hidden" name="idnotif" id="idnotif" value="' + result.id + '" required>';
          html += result.data.message;
          $("#modalnotification .message").html(html);
          $("#modalnotification").modal("show");
        }
      }
    });
  }

  $(document).ready(function() {
    get_notif();
    chart_karyawan();

    $('#form_notif').on('submit', function(evt) {
      evt.preventDefault();
      var formdata = new FormData($(this)[0]);
      $.ajax({
        url: '<?= base_url() ?>dashboard/proses?act=update_notif',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        success: function(result) {
          if (result.update == true) {
            $("#modalnotification").modal("hide");
          } else {
            $("#modalnotification #notif-error").html("Gagal menandai.");
          }
        },
        error: function(result) {
          // alert(result);
        }
      });
    });

    $('#modalnotification').on('hide.bs.modal', function(e) {
      // Code to execute when the modal is about to close
      $("#modalnotification .message").html("");
      $("#modalnotification #notif-error").html("");
      // e.g., clear form fields, save data, etc.
    });
  });
</script>
<?= $this->endSection() ?>