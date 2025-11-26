<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<!--begin::Post-->
<div class="post d-flex flex-column-fluid">
  <!--begin::Container-->
  <div class="container-xxl">
    <?= $this->include('hrd/karyawan/detail/head_detail') ?>
    <!--begin::Row-->
    <div class="row g-5 g-xxl-8">
      <!--begin::Col-->
      <div class="col-xl-12">
        <!--begin::details View-->
        <div class="card mb-5 mb-xl-10">
          <!--begin::Card header-->
          <div class="card-header cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
              <h3 class="fw-bolder m-0">Ubah Password</h3>
            </div>
            <!--end::Card title-->
          </div>
          <!--begin::Card header-->
          <div class="card-body p-9">
            <form class="form" id="form_data">
              <input type="hidden" name="usernuk" value="<?= $karyawan["usernuk"] ?>" />
              <div class="card-body">
                <!--begin::Input group-->
                <div class="row mb-7 fv-row" data-kt-password-meter="false">
                  <div class="col-xl-3">
                    <div class="fs-6 fw-bold mt-2 mb-3 required">Password Lama</div>
                  </div>
                  <div class="col-xl-9">
                    <div class="position-relative mb-3">
                      <input class="form-control form-control-solid" type="password" placeholder="Password lama" name="oldpassword" autocomplete="off" />
                      <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                        <i class="bi bi-eye-slash fs-2"></i>
                        <i class="bi bi-eye fs-2 d-none"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <!--end::Input group=-->
                <!--begin::Input group-->
                <div class="row mb-7 fv-row" data-kt-password-meter="false">
                  <div class="col-xl-3">
                    <div class="fs-6 fw-bold mt-2 mb-3 required">Password Baru</div>
                  </div>
                  <div class="col-xl-9">
                    <div class="position-relative mb-3">
                      <input class="form-control form-control-solid" type="password" placeholder="Password baru" name="newpassword" autocomplete="off" />
                      <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                        <i class="bi bi-eye-slash fs-2"></i>
                        <i class="bi bi-eye fs-2 d-none"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <!--end::Input group=-->
                <!--begin::Input group-->
                <div class="row mb-7 fv-row" data-kt-password-meter="false">
                  <div class="col-xl-3">
                    <div class="fs-6 fw-bold mt-2 mb-3 required">Ulangi Password Baru</div>
                  </div>
                  <div class="col-xl-9">
                    <div class="position-relative mb-3">
                      <input class="form-control form-control-solid" type="password" placeholder="Ulangi password baru" name="repassword" autocomplete="off" />
                      <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                        <i class="bi bi-eye-slash fs-2"></i>
                        <i class="bi bi-eye fs-2 d-none"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <!--end::Input group=-->
                <!--begin::Input group-->
                <div class="fv-plugins-message-container invalid-feedback" id="validation-error"></div>
                <!--end::Input group=-->
              </div>
              <div class="card-footer d-flex justify-content-end py-6">
                <button type="submit" class="btn btn-primary">Ubah password</button>
              </div>
            </form>
          </div>
          <!--end::Card body-->
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
  $(document).ready(function() {
    var kantor = "<?= $kantor ?>";

    $("#form_data").on('submit', function(event) {
      event.preventDefault();
      var formdata = new FormData(this);
      formdata.append("kantor", kantor);
      Swal.fire({
        html: `Ubah password?`,
        icon: "warning",
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonText: "Simpan",
        cancelButtonText: 'Batal',
        customClass: {
          confirmButton: "btn btn-primary m-1",
          cancelButton: 'btn btn-secondary m-1'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '<?= base_url() ?>karyawan/proses?act=ubah_password',
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false,
            dataType: 'JSON',
            success: function(result) {
              if (result.errors) {
                $("#validation-error").html(result.errors);
              } else {
                if (result.proses == true) {
                  sessionStorage.setItem("alert", "show");
                  sessionStorage.setItem("alert_title", "Berhasil membuat password baru");
                  location.reload();
                }
              }
            },
          });
        }
      });
    });
  });
</script>
<?= $this->endSection() ?>