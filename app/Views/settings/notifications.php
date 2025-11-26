<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<?php

use App\Models\Department;
use App\Models\Settings;

$mdepartment = new Department();
$msettings = new Settings();
$department = $mdepartment->select("*")->get()->getResultArray();
$setting = $msettings->getNotif("notif_kontrak");
$datasetting = null;
if (!empty($setting) && !empty($setting["datasetting"])) {
  $datasetting = json_decode($setting["datasetting"], true);
}
?>
<!--begin::Post-->
<div class="post d-flex flex-column-fluid">
  <!--begin::Container-->
  <div class="container-xxl">
    <!--begin::Navbar-->
    <div class="card mb-5 mb-xxl-8">
      <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap">
          <!--begin::Info-->
          <div class="flex-grow-1">
            <!--begin::Title-->
            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
              <!--begin::User-->
              <div class="d-flex flex-column">
                <!--begin::Name-->
                <div class="d-flex align-items-center mb-2">
                  <a href="javascript:;" class="text-gray-900 fs-3 fw-bolder me-1">Notifikasi</a>
                  <a href="javascript:;">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                    <span class="svg-icon svg-icon-1 svg-icon-primary">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                        <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF" />
                        <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white" />
                      </svg>
                    </span>
                    <!--end::Svg Icon-->
                  </a>
                </div>
                <!--end::Name-->
              </div>
              <!--end::User-->
            </div>
            <!--end::Title-->
          </div>
          <!--end::Info-->
        </div>
        <!--end::Details-->
        <!--begin::Navs-->
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
          <!--begin::Nav item-->
          <li class="nav-item mt-2">
            <a class="nav-link active text-active-primary fs-2 ms-0 me-10 py-5" href="javascript:;">Kontrak Berakhir</a>
          </li>
          <!-- <table -->
        </ul>
        <!--begin::Navs-->
      </div>
    </div>
    <!--end::Navbar-->
    <!--begin::Row-->
    <div class="row g-5 g-xxl-8">
      <!--begin::Col-->
      <div class="col-xl-12">
        <!--begin::details View-->
        <div class="card mb-5 mb-xl-10">
          <form id="formsetting" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
            <!--begin::Card body-->
            <div class="card-body p-9">
              <!--begin::Row-->
              <div class="row mb-0">
                <!--begin::Label-->
                <label class="col-lg-3 col-form-label fw-bold fs-5">Notifikasi WhatsApp</label>
                <!--begin::Label-->
                <!--begin::Label-->
                <div class="col-lg-9 d-flex align-items-center">
                  <div class="form-check form-check-solid form-switch fv-row">
                    <input class="form-check-input w-45px h-30px" type="checkbox" name="notif_status"
                      <?= !empty($setting["status"]) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="allowmarketing"></label>
                  </div>
                </div>
                <!--begin::Label-->
              </div>
              <!--end::Row-->
              <!--begin::Row-->
              <div class="row mb-0">
                <!--begin::Label-->
                <label class="col-lg-3 col-form-label fw-bold text-muted fs-6">Penerima Notifikasi</label>
                <!--begin::Label-->
                <!--begin::Label-->
                <div class="col-lg-9">
                  <div id="listNomor">

                    <?php if (isset($datasetting["penerima"])):
                      $no = 1;
                      $i = 0;
                      foreach ($datasetting["penerima"] as $penerima):
                    ?>
                        <div class="row" nomor-ke="<?= $no ?>">
                          <div class="col-lg-3 fv-row fv-plugins-icon-container">
                            <input type="text" name="nama[]" class="form-control form-control-lg form-control-solid" placeholder="Nama" value="<?= $penerima["nama"] ?>">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                          </div>
                          <div class="col-lg-3 fv-row fv-plugins-icon-container">
                            <input type="number" name="phone[]" class="form-control form-control-lg form-control-solid" placeholder="Phone number" value="<?= $penerima["phone"] ?>" required>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                          </div>
                          <div class="col-lg-4 fv-row fv-plugins-icon-container">
                            <select name="basenotif[]" class="form-select form-select-solid form-select-lg fw-bold" required>
                              <option value=""></option>
                              <option value="Semua" <?= ($penerima["basenotif"] == "Semua") ? "selected" : ""; ?>>Semua</option>
                              <?php foreach ($department as $dept):
                                $select = ($penerima["basenotif"] == $dept["id"]) ? "selected" : "";
                              ?>
                                <option value="<?= $dept["id"] ?>" <?= $select ?>><?= $dept["keterangan"] ?></option>
                              <?php endforeach; ?>
                            </select>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                          </div>
                          <div class="col-lg-2 d-flex align-items-center">
                            <a href="javascript:;" class="me-3 delnomor" data-ke="<?= $no ?>" database="true">
                              <span class="svg-icon svg-icon-danger svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                  <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                  <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                  <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                </svg></span>
                            </a>
                            <div class="form-check form-check-solid form-switch fv-row">
                              <input type="hidden" name="status_nomor[<?= $i ?>]" value="off">
                              <input class="form-check-input w-45px h-30px" type="checkbox" name="status_nomor[<?= $i ?>]" value="on" <?= ($penerima["status"] == "on") ? "checked" : "" ?>>
                            </div>
                          </div>
                        </div>
                    <?php $no++;
                        $i++;
                      endforeach;
                    endif; ?>
                    <div id="endlistnomor"></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-9">
                      <a href="#" class="btn btn-icon-primary btn-text-primary" id="addnomor">
                        <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr013.svg-->
                        <span class="svg-icon svg-icon-muted svg-icon-2hx">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M11 13H7C6.4 13 6 12.6 6 12C6 11.4 6.4 11 7 11H11V13ZM17 11H13V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="black" />
                            <path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM17 11H13V7C13 6.4 12.6 6 12 6C11.4 6 11 6.4 11 7V11H7C6.4 11 6 11.4 6 12C6 12.6 6.4 13 7 13H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="black" />
                          </svg>
                        </span>
                        <!--end::Svg Icon-->
                        Tambah</a>
                    </div>
                  </div>
                </div>
                <!--begin::Label-->
              </div>
              <!--end::Row-->
            </div>
            <!--end::Card body-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
              <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2">Batal</button>
              <button type="submit" class="btn btn-sm btn-primary" id="kt_account_profile_details_submit">Simpan</button>
            </div>
          </form>
        </div>
        <!--end::details View-->
      </div>
      <!--end::Col-->
    </div>
    <!--end::Row-->
  </div>
  <!--end::Container-->
</div>
<!--end::Post-->
<?= $this->endSection() ?>
<?= $this->section('modal') ?>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
  function select2form() {
    $('.form-select').each(function() {
      var placeholder;
      var allowClear;
      var multiple;
      var name = $(this).attr("name");
      if (name == "basenotif[]") {
        placeholder = "Pilih data notifikasi";
      }
      const formId = $(this).closest('form').attr('id');
      $(this).select2({
        placeholder: placeholder || "Pilih data...",
        allowClear: allowClear || false,
        multiple: multiple || false,
        dropdownParent: $('#' + formId)
      });
    });
  }

  $(document).ready(function() {
    select2form();

    let formAwal = $("#formsetting").serialize();
    let isSubmitting = false;

    $(window).on("beforeunload", function() {
      let formSekarang = $("#formsetting").serialize();

      if (!isSubmitting && formAwal !== formSekarang) {
        return "Ada perubahan data yang belum disimpan. Yakin mau keluar?";
      }
    });

    $("button[type=reset]").on("click", function(e) {
      isSubmitting = true;
      let formSekarang = $("#formsetting").serialize();
      if (formAwal !== formSekarang) {
        e.preventDefault(); // cegah reset langsung
        if (confirm("Ada perubahan data yang belum disimpan. Yakin batal?")) {
          // kalau ya → reset form manual
          location.reload();
        }
      }
    });

    $('#addnomor').on('click', function() {
      $('#validation-failed').html('');
      var lastnomor = Number($('[nomor-ke]').last().attr('nomor-ke'));
      if (lastnomor) {
        var next_nomor = lastnomor + 1;
      } else {
        var next_nomor = 1;
      }
      var html = '';
      html += `<div class="row" nomor-ke="${next_nomor}">
                <div class="col-lg-3 fv-row fv-plugins-icon-container">
                  <input type="text" name="nama[]" class="form-control form-control-lg form-control-solid" placeholder="Nama">
                  <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <div class="col-lg-3 fv-row fv-plugins-icon-container">
                  <input type="number" name="phone[]" class="form-control form-control-lg form-control-solid" placeholder="Phone number">
                  <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <div class="col-lg-4 fv-row fv-plugins-icon-container">
                  <select name="basenotif[]" class="form-select form-select-solid form-select-lg fw-bold" required>
                    <option value=""></option>
                    <option value="Semua">Semua</option>
                    <?php foreach ($department as $dept): ?>
                      <option value="<?= $dept["id"] ?>"><?= $dept["keterangan"] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <div class="col-lg-2 d-flex align-items-center">
                  <a href="javascript:;" class="me-3 delnomor" data-ke="${next_nomor}" database="false">
                    <span class="svg-icon svg-icon-danger svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                      </svg></span>
                  </a>
                  <div class="form-check form-check-solid form-switch fv-row">
                    <input type="hidden" name="status_nomor[${next_nomor - 1}]" value="off">
                    <input class="form-check-input w-45px h-30px" type="checkbox" name="status_nomor[${next_nomor - 1}]" checked>
                  </div>
                </div>
              </div>`;
      $('#endlistnomor').before(html);
      select2form();
    });

    $('#listNomor').on('click', '.delnomor', function() {
      var nomor_ke = $(this).attr("data-ke");
      $('[nomor-ke="' + nomor_ke + '"]').remove();
      var lastnomor = $('[nomor-ke]').last().attr('nomor-ke');
      if (!lastnomor) {
        $('#listNomor').html('<div id="endlistnomor"></div>');
      }
    });

    $("#formsetting").on('submit', function(event) {
      event.preventDefault();
      isSubmitting = true;
      var formdata = new FormData(this);
      var $form = $(this).closest('form');
      $.ajax({
        url: '<?= base_url() ?>settings/proses?act=update_notif_kontrak',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        success: function(result) {
          if (result.proses == true) {
            sessionStorage.setItem("alert", "show");
            sessionStorage.setItem("alert_title", "Berhasil menyimpan notifikasi kontrak berakhir");
            location.reload();
          }
        },
      });
    });
  });
</script>
<?= $this->endSection() ?>