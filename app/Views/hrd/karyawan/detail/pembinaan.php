<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<!--begin::Post-->
<div class="post d-flex flex-column-fluid">
  <!--begin::Container-->
  <div class="container-xxl">
    <?= $this->include('hrd/karyawan/detail/head_detail') ?>
    <!--begin::Row-->
    <div class="row g-5 g-xxl-8">
      <!--begin::Kontrak-->
      <div class="col-xl-12" id="tabKontrak">
        <!--begin::List Widget 4-->
        <div class="card card-xl-stretch mb-5 mb-xl-8">
          <!--begin::Header-->
          <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
              <span class="card-label fw-bolder text-dark">Pembinaan Karyawan</span>
            </h3>
            <div class="card-toolbar">
              <a href="javascript:;" class="btn btn-primary align-self-center" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-bs-toggle="modal" data-bs-target="#modalTambahPembinaan">Input Pembinaan</a>
            </div>
          </div>
          <!--end::Header-->
          <!--begin::Body-->
          <div class="card-body pt-5">
            <?php if (empty($datapembinaan)): ?>
              <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed min-w-lg-600px flex-shrink-0 p-6">
                <!--begin::Icon-->
                <!--begin::Svg Icon | path: icons/duotune/coding/cod004.svg-->
                <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M19.0687 17.9688H11.0687C10.4687 17.9688 10.0687 18.3687 10.0687 18.9688V19.9688C10.0687 20.5687 10.4687 20.9688 11.0687 20.9688H19.0687C19.6687 20.9688 20.0687 20.5687 20.0687 19.9688V18.9688C20.0687 18.3687 19.6687 17.9688 19.0687 17.9688Z" fill="black"></path>
                    <path d="M4.06875 17.9688C3.86875 17.9688 3.66874 17.8688 3.46874 17.7688C2.96874 17.4688 2.86875 16.8688 3.16875 16.3688L6.76874 10.9688L3.16875 5.56876C2.86875 5.06876 2.96874 4.46873 3.46874 4.16873C3.96874 3.86873 4.56875 3.96878 4.86875 4.46878L8.86875 10.4688C9.06875 10.7688 9.06875 11.2688 8.86875 11.5688L4.86875 17.5688C4.66875 17.7688 4.36875 17.9688 4.06875 17.9688Z" fill="black"></path>
                  </svg>
                </span>
                <!--end::Svg Icon-->
                <!--end::Icon-->
                <!--begin::Wrapper-->
                <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                  <!--begin::Content-->
                  <div class="mb-3 mb-md-0 fw-bold">
                    <h4 class="text-gray-900 fw-bolder">Data tidak ditemukan!</h4>
                    <div class="fs-6 text-gray-700 pe-7">Harap masukan informasi data pembinaan karyawan.</div>
                  </div>
                  <!--end::Content-->
                </div>
                <!--end::Wrapper-->
              </div>
            <?php else: ?>
              <!--begin::Table container-->
              <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" id="tabel_pembinaan">
                  <!--begin::Table head-->
                  <thead>
                    <tr class="fw-bolder text-muted">
                      <th class="w-30px">No</th>
                      <th class="w-250px">Tanggal</th>
                      <th class="min-w-140px">Jenis</th>
                      <th class="min-w-140px">Tindak Lanjut</th>
                      <th class="min-w-140px">Catatan</th>
                      <th class="min-w-100px text-end">Actions</th>
                    </tr>
                  </thead>
                  <!--end::Table head-->
                  <!--begin::Table body-->
                  <tbody>
                    <?php $no = 1;
                    foreach ($datapembinaan as $pembinaan):
                    ?>
                      <tr>
                        <td>
                          <div class="symbol symbol-30px me-5">
                            <span class="symbol-label">
                              <span class="align-self-center text-primary fw-bolder" alt="<?= $no ?>"><?= $no ?></span>
                            </span>
                          </div>
                        </td>
                        <td>
                          <span class="text-gray-800 text-hover-primary fs-6 fw-bolder"><?= tgl_indo($pembinaan["tanggal"]) ?></span>
                        </td>
                        <td><span class="text-gray-900 text-hover-primary fw-bolder"><?= $pembinaan["jenis"] ?></span></td>
                        <td><span class="text-gray-900 text-hover-primary fw-bolder"><?= $pembinaan["tindak_lanjut"] ?></span></td>
                        <td><a href="javascript:;" class="text-gray-900 text-hover-primary fw-bolder btnEdit" data-id="<?= $pembinaan["id"] ?>"><?= excerpt($pembinaan["catatan"], 2); ?> <span class="text-warning text-hover-primary">(Lihat)</span></a></td>
                        <td>
                          <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btnEdit" data-id="<?= $pembinaan["id"] ?>">
                              <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                              <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                  <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                  <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                </svg>
                              </span>
                              <!--end::Svg Icon-->
                            </a>
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm btnHapus" data-id="<?= $pembinaan["id"] ?>">
                              <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                              <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                  <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                  <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                  <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                </svg>
                              </span>
                              <!--end::Svg Icon-->
                            </a>
                          </div>
                        </td>
                      </tr>
                    <?php $no++;
                    endforeach; ?>
                  </tbody>
                  <!--end::Table body-->
                </table>
                <!--end::Table-->
              </div>
              <!--end::Table container-->
            <?php endif; ?>
          </div>
          <!--end::Body-->
        </div>
        <!--end::List Widget 4-->
      </div>
      <!--end::Kontrak-->
    </div>
    <!--end::Row-->
  </div>
  <!--end::Container-->
</div>
<!--end::Post-->
<?= $this->endSection() ?>
<?= $this->section('modal') ?>
<div class="modal fade" id="modalTambahPembinaan" tabindex="-1" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog mw-850px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header">
        <!--begin::Modal title-->
        <h2>Form Input Pembinaan Karyawan</h2>
        <!--end::Modal title-->
        <!--begin::Close-->
        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
          <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
          <span class="svg-icon svg-icon-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
              <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
              <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
            </svg>
          </span>
          <!--end::Svg Icon-->
        </div>
        <!--end::Close-->
      </div>
      <!--begin::Modal header-->
      <!--begin::Modal body-->
      <div class="modal-body mx-5 mx-xl-18 p5">
        <form id="formTambahPembinaan" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
          <!--begin::Row-->
          <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-3 fw-bolder text-muted">NUK</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <span class="fw-bolder fs-6 text-gray-800"><?= $karyawan['usernuk'] ?></span>
              <input type="hidden" name="usernuk" value="<?= $karyawan['usernuk'] ?>" required>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Row-->
          <!--begin::Row-->
          <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-3 fw-bolder text-muted">Nama</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <span class="fw-bolder fs-6 text-gray-800 " id="text-nama"><?= $karyawan['user_nama_depan'] . " " . $karyawan['user_nama_belakang'] ?></span>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Row-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Tanggal</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <input class="form-control form-control-solid" type="text" placeholder="Tanggal" name="tanggal" id="tanggal" required />
              <div id="validation-tanggal" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Jenis Pelanggaran</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="jenis" id="jenis" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="RINGAN">RINGAN</option>
                <option value="SEDANG">SEDANG</option>
                <option value="BERAT">BERAT</option>
              </select>
              <div id="showjenis"></div>
              <div id="validation-jenis" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Tindak Lanjut</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="tindaklanjut" id="tindaklanjut" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="MUTASI">MUTASI</option>
                <option value="MEMBERHENTIKAN">MEMBERHENTIKAN</option>
              </select>
              <div id="validation-tindaklanjut" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Catatan</label>
            <!--end::Label-->
          </div>
          <div class="row mb-3">
            <!--begin::Label-->
            <div class="col-lg-12 mt-3">
              <textarea name="catatan" id="catatan"></textarea>
            </div>
            <!--end::Label-->
          </div>
          <!--end::Input group-->
          <div class="text-center mt-7">
            <a class="btn btn-light me-3" data-bs-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-primary" id="btnTambahPembinaan">
              <span class="indicator-label">Simpan</span>
              <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
          </div>
        </form>
      </div>
      <!--end::Modal body-->
    </div>
    <!--end::Modal content-->
  </div>
  <!--end::Modal dialog-->
</div>
<div class="modal fade" id="modalEditPembinaan" tabindex="-1" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog mw-850px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header">
        <!--begin::Modal title-->
        <h2>Form Edit Pembinaan Karyawan</h2>
        <!--end::Modal title-->
        <!--begin::Close-->
        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
          <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
          <span class="svg-icon svg-icon-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
              <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
              <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
            </svg>
          </span>
          <!--end::Svg Icon-->
        </div>
        <!--end::Close-->
      </div>
      <!--begin::Modal header-->
      <!--begin::Modal body-->
      <div class="modal-body mx-5 mx-xl-18 p5">
        <form id="formEditPembinaan" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
          <!--begin::Row-->
          <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-3 fw-bolder text-muted">NUK</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <span class="fw-bolder fs-6 text-gray-800"><?= $karyawan['usernuk'] ?></span>
              <input type="hidden" name="id_data" required>
              <input type="hidden" name="usernuk" value="<?= $karyawan['usernuk'] ?>" required>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Row-->
          <!--begin::Row-->
          <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-3 fw-bolder text-muted">Nama</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <span class="fw-bolder fs-6 text-gray-800 " id="text-nama"><?= $karyawan['user_nama_depan'] . " " . $karyawan['user_nama_belakang'] ?></span>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Row-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Tanggal</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <input class="form-control form-control-solid" type="text" placeholder="Tanggal" name="edit_tanggal" id="edit_tanggal" required />
              <div id="validation-edit_tanggal" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Jenis Pelanggaran</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="edit_jenis" id="edit_jenis" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="RINGAN">RINGAN</option>
                <option value="SEDANG">SEDANG</option>
                <option value="BERAT">BERAT</option>
              </select>
              <div id="showjenis"></div>
              <div id="validation-edit_jenis" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Tindak Lanjut</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="edit_tindaklanjut" id="edit_tindaklanjut" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="MUTASI">MUTASI</option>
                <option value="MEMBERHENTIKAN">MEMBERHENTIKAN</option>
              </select>
              <div id="validation-edit_tindaklanjut" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Catatan</label>
            <!--end::Label-->
          </div>
          <div class="row mb-3">
            <!--begin::Label-->
            <div class="col-lg-12 mt-3">
              <textarea name="edit_catatan" id="edit_catatan"></textarea>
            </div>
            <!--end::Label-->
          </div>
          <!--end::Input group-->
          <div class="text-center mt-7">
            <a class="btn btn-light me-3" data-bs-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-primary" id="btnEditPembinaan">
              <span class="indicator-label">Simpan</span>
              <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
          </div>
        </form>
      </div>
      <!--end::Modal body-->
    </div>
    <!--end::Modal content-->
  </div>
  <!--end::Modal dialog-->
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?= base_url('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') ?>"></script>
<script>
  function select2form() {
    $('.form-select').each(function() {
      var placeholder;
      var allowClear;
      var multiple;
      var name = $(this).attr("name");
      if (name == "jenis") {
        placeholder = "Jenis Pelanggaran";
      } else if (name == "tindaklanjut") {
        placeholder = "Tindak Lanjut"
      } else if (name == "edit_jenis") {
        placeholder = "Jenis Pelanggaran";
      } else if (name == "edit_tindaklanjut") {
        placeholder = "Tindak Lanjut"
      }
      const formId = $(this).closest('form').attr('id');
      console.log(name);
      console.log(placeholder);

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
    $('#formTambahPembinaan input[name="tanggal"]').daterangepicker({
      locale: {
        format: 'DD MMM YYYY'
      },
      singleDatePicker: true,
      placeholder: {
        text: "Pilih tanggal"
      },
      showDropdowns: true,
      minYear: 1950,
    });

    $('#formEditPembinaan input[name="edit_tanggal"]').daterangepicker({
      locale: {
        format: 'DD MMM YYYY'
      },
      singleDatePicker: true,
      placeholder: {
        text: "Pilih tanggal"
      },
      showDropdowns: true,
      minYear: 1950,
    });

    ClassicEditor
      .create(document.querySelector('#formTambahPembinaan textarea[name="catatan"]'))
      .then(editor => {
        // console.log(editor);
      })
      .catch(error => {
        // console.error(error);
      });

    $('#formTambahPembinaan').on('submit', function(evt) {
      evt.preventDefault();
      $('#btnTambahPembinaan .indicator-label').hide();
      $('#btnTambahPembinaan .indicator-progress').show();
      var formdata = new FormData($(this)[0]);
      $.ajax({
        url: '<?= base_url() ?>karyawan/proses?act=tambah_pembinaan',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        success: function(result) {
          if (result.errors) {
            var name = Object.keys(result.errors);
            var notempty = result.notempty;
            var html = '';
            for (i = 0; i < notempty.length; i++) {
              $("#formTambahPembinaan #validation-" + notempty[i]).html('');
            }
            for (i = 0; i < name.length; i++) {
              $("#formTambahPembinaan #validation-" + name[i]).attr("class", "invalid-feedback");
              $("#formTambahPembinaan #validation-" + name[i]).html(result.errors[name[i]]);
              $("#formTambahPembinaan #validation-" + name[i]).attr("style", "display:block");
            }
            $('#btnTambahPembinaan .indicator-label').text("Cek Data Kembali");
            $('#btnTambahPembinaan .indicator-label').show();
            $('#btnTambahPembinaan .indicator-progress').hide();
            $('#btnTambahPembinaan').removeClass("btn-primary");
            $('#btnTambahPembinaan').addClass("btn-danger");
            setTimeout(function() {
              $('#btnTambahPembinaan .indicator-label').text("Simpan");
              $('#btnTambahPembinaan').removeClass("btn-danger");
              $('#btnTambahPembinaan').addClass("btn-primary");
            }, 3500);
          } else {
            if (result.insert == true) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil menambahkan data pembinaan");
              $('#btnTambahPembinaan .indicator-label').text("Berhasil");
              $('#btnTambahPembinaan .indicator-label').show();
              $('#btnTambahPembinaan .indicator-progress').hide();
              $('#btnTambahPembinaan').removeClass("btn-primary");
              $('#btnTambahPembinaan').addClass("btn-success");
              location.reload();
            }
          }
        },
        error: function(result) {
          // alert(result);
        }
      });
    });

    let pembinaanEditor; // Global var untuk menyimpan instance CKEditor
    // Event klik edit
    $("#tabel_pembinaan").on('click', ".btnEdit", function() {
      var id = $(this).attr("data-id");
      $.ajax({
        url: '<?= base_url('karyawan/get_data?act=pembinaan') ?>',
        type: 'POST',
        data: {
          id: id,
        },
        dataType: 'json',
        success: function(result) {
          if (result) {
            $('#formEditPembinaan input[name="id_data"]').val(result.id);
            const tanggal = moment(result.tanggal, 'YYYY-MM-DD').format('DD MMM YYYY');
            $('#formEditPembinaan input[name="edit_tanggal"]').data('daterangepicker').setStartDate(tanggal);
            $('#formEditPembinaan select[name="edit_jenis"]').val(result.jenis.toUpperCase()).trigger('change');
            $('#formEditPembinaan select[name="edit_tindaklanjut"]').val(result.tindak_lanjut.toUpperCase()).trigger('change');
            $('#formEditPembinaan textarea[name="edit_catatan"]').val(result.catatan);
            // Destroy editor jika sudah ada
            if (pembinaanEditor) {
              pembinaanEditor.destroy()
                .then(() => {
                  pembinaanEditor = null;
                  initEditor();
                });
            } else {
              initEditor();
            }

            function initEditor() {
              ClassicEditor
                .create(document.querySelector('#formEditPembinaan textarea[name="edit_catatan"]'))
                .then(editor => {
                  pembinaanEditor = editor;
                  console.log("CKEditor berhasil diinisialisasi");
                })
                .catch(error => {
                  // console.error(error);
                });
            }
            $("#modalEditPembinaan").modal("show");
          }
        }
      });
    });

    $('#formEditPembinaan').on('submit', function(evt) {
      evt.preventDefault();
      $('#btnEditPembinaan .indicator-label').hide();
      $('#btnEditPembinaan .indicator-progress').show();
      if (pembinaanEditor) {
        $('#formEditPembinaan textarea[name="edit_catatan"]').val(pembinaanEditor.getData());
      }
      var formdata = new FormData($(this)[0]);
      $.ajax({
        url: '<?= base_url() ?>karyawan/proses?act=update_pembinaan',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        success: function(result) {
          if (result.errors) {
            var name = Object.keys(result.errors);
            var notempty = result.notempty;
            var html = '';
            for (i = 0; i < notempty.length; i++) {
              $("#formEditPembinaan #validation-" + notempty[i]).html('');
            }
            for (i = 0; i < name.length; i++) {
              $("#formEditPembinaan #validation-" + name[i]).attr("class", "invalid-feedback");
              $("#formEditPembinaan #validation-" + name[i]).html(result.errors[name[i]]);
              $("#formEditPembinaan #validation-" + name[i]).attr("style", "display:block");
            }
            $('#btnEditPembinaan .indicator-label').text("Cek Data Kembali");
            $('#btnEditPembinaan .indicator-label').show();
            $('#btnEditPembinaan .indicator-progress').hide();
            $('#btnEditPembinaan').removeClass("btn-primary");
            $('#btnEditPembinaan').addClass("btn-danger");
            setTimeout(function() {
              $('#btnEditPembinaan .indicator-label').text("Simpan");
              $('#btnEditPembinaan').removeClass("btn-danger");
              $('#btnEditPembinaan').addClass("btn-primary");
            }, 3500);
          } else {
            if (result.update == true) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil edit data pembinaan");
              $('#btnEditPembinaan .indicator-label').text("Berhasil, Mohon tunggu beberapa saat");
              $('#btnEditPembinaan .indicator-label').show();
              $('#btnEditPembinaan .indicator-progress').hide();
              $('#btnEditPembinaan').removeClass("btn-primary");
              $('#btnEditPembinaan').addClass("btn-success");
              location.reload();
            }
          }
        },
        error: function(result) {
          // alert(result);
        }
      });
    });

    $("#tabel_pembinaan .btnHapus").on('click', function() {
      var id = $(this).attr("data-id");
      Swal.fire({
        html: `Apakah Anda yakin menghapus data ini?`,
        icon: "warning",
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonText: "Hapus",
        cancelButtonText: 'Batal',
        customClass: {
          confirmButton: "btn btn-danger m-1",
          cancelButton: 'btn btn-secondary m-1'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '<?= base_url('karyawan/proses?act=delete_pembinaan') ?>',
            type: 'POST',
            data: {
              id: id
            },
            dataType: 'JSON',
            success: function(result) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil hapus data pembinaan");
              sessionStorage.setItem("alert_icon", "warning");
              location.reload();
            },
          });
        }
      });
    });

    $('#modalEditPembinaan').on('hidden.bs.modal', function() {
      if (pembinaanEditor) {
        pembinaanEditor.destroy()
          .then(() => {
            pembinaanEditor = null;
          });
      }
    });
  });
</script>
<?= $this->endSection() ?>