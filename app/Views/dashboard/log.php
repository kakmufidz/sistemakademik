<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<div class="post d-flex flex-column-fluid">
  <!--begin::Container-->
  <div class="container-xxl">
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10">
      <div class="card-body pt-0">
        <div class="py-5">
          <div class="rounded border p-3">
            <!--begin::Table container-->
            <div class="table-responsive">
              <!--begin::Table-->
              <table id="tabelMaster" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder">
                <!--begin::Head-->
                <thead class="fs-7 text-gray-400 text-uppercase">
                  <tr>
                    <th class="min-w-10px text-center">No</th>
                    <th class="min-w-350px">Aktifitas</th>
                    <th class="min-w-100px">Waktu</th>
                  </tr>
                </thead>
                <!--end::Head-->
                <!--begin::Body-->
                <!--end::Body-->
              </table>
              <!--end::Table-->
            </div>
            <!--end::Table container-->
          </div>
        </div>
      </div>
      <!--end::Card body-->
    </div>
    <!--end::details View-->
  </div>
  <!--end::Container-->
</div>
<?= $this->endSection() ?>
<?= $this->section('modal') ?>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
  $(document).ready(function() {
    // Definisikan variabel kolom dengan kondisi
    let columnsConfig = [{
        data: 0,
        className: "text-center"
      },
      {
        data: 1
      },
      {
        data: 2
      },
    ];

    // Menambahkan kolom ke-8 hanya jika verif_tgl atau verif_user benar

    let table_master = new DataTable('#tabelMaster', {
      responsive: false,
      processing: true,
      serverSide: true,
      ajax: {
        url: "<?= base_url('log/get_data?act=datalog') ?>",
        type: "POST",
        error: function(xhr, error, thrown) {
          console.error("Error fetching data: ", error, thrown);
        }
      },
      columns: columnsConfig, // Gunakan konfigurasi kolom yang sudah ditentukan
    });

    $(".dt-length").addClass("d-flex align-items-center");
    $(".dt-length select").addClass("form-select form-select-solid form-select-sm");
    $(".dt-search").addClass("d-flex align-items-center my-1");
    $(".dt-search input").addClass("form-control form-control-solid form-select-sm w-300px");
    var html = '<span class="svg-icon svg-icon-3 position-absolute ms-20"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" /><path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" /></svg></span>';
    $(".dt-search input").before(html);


  });
</script>
<?= $this->endSection() ?>