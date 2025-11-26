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
          <div class="card-header">
            <!--begin::Heading-->
            <div class="card-title m-0">
              <h3 class="fw-bolder m-0">Dokumen</h3>
            </div>
            <!--end::Heading-->
            <!--begin::Toolbar-->
            <div class="card-toolbar">
              <!-- <a href="#" class="btn btn-sm btn-primary my-1">Tambah Data</a> -->
            </div>
            <!--end::Toolbar-->
          </div>
          <!--end::Card header-->
          <!--begin::Card body-->
          <div class="card-body p-0 datadokumen" id="datadokumen">
            <!--begin::Row-->
            <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
              <!--begin::Col-->
              <style>
                .thumbnail-wrapper {
                  width: 100%;
                  aspect-ratio: 4 / 3;
                  /* Landscape */
                  overflow: hidden;
                  border-radius: 8px;
                  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                }

                .thumbnail-wrapper img {
                  width: 100%;
                  height: 100%;
                  object-fit: cover;
                  object-position: center;
                }
              </style>
              <?php foreach ($datadokumen as $dokumen): ?>
                <div class="col-md-6 col-lg-4 col-xl-3">
                  <!--begin::Card-->
                  <div class="card h-100">
                    <!--begin::Card body-->
                    <div class="card-body d-flex justify-content-center text-center flex-column">
                      <!--begin::Name-->
                      <a href="#" class="text-gray-800 text-hover-primary d-flex flex-column">

                        <!--begin::Image-->
                        <div class="thumbnail-wrapper position-relative">
                          <!-- Tombol ganti tanggal di pojok kanan atas -->
                          <label class="btn btn-icon btn-circle btn-active-color-danger w-25px h-25px bg-white shadow position-absolute btnHapus" style="top: 5px; right: 5px;" data-id="<?= $dokumen["id"] ?>">
                            <span data-bs-toggle="tooltip" data-bs-original-title="Hapus Dokumen">
                              <i class="bi bi-trash-fill fs-7"></i>
                            </span>
                          </label>

                          <!-- Gambar dokumen -->
                          <?php
                          $explodefile = explode("/", $dokumen["nama_file"]);
                          $namafile = (count($explodefile) > 1) ? $explodefile[1] : $explodefile[0];
                          $path = WRITEPATH . 'uploads/dokumen_' . $kantor . '/' . $namafile;
                          $imgfile = base_url("assets/media/svg/files/file-not-found.svg");
                          $note = $namafile;
                          $displaydownload = "none";
                          if (is_file($path)) {
                            $note = $dokumen["note"];
                            $displaydownload = "block";
                          }
                          $explode = explode(".", $namafile);
                          $ekstensi = end($explode);
                          ?>
                          <?php if (is_file($path)):
                            if (strtoupper($ekstensi) == "PDF"): ?>
                              <div class="symbol symbol-100px p-8">
                                <a href="<?= base_url("docview/" . $kantor . "/dokumen/" . $namafile) ?>" class="popup-pdf">
                                  <img src="<?= base_url("assets/media/svg/files/pdf.svg") ?>" alt="<?= $namafile ?>">
                                </a>
                              </div>
                            <?php else:

                            ?>
                              <a href="<?= base_url("docview/" . $kantor . "/dokumen/" . $namafile) ?>" class="popup-img">
                                <img src="<?= base_url("docview/" . $kantor . "/dokumen/" . $namafile) ?>" class="img-thumbnail img-fluid" alt="<?= $namafile ?>">
                              </a>
                            <?php endif; ?>
                          <?php else: ?>
                            <div class="symbol symbol-500px p-8">
                              <img src="<?= base_url("assets/media/svg/files/file-not-found.svg") ?>" alt="<?= $namafile ?>">
                            </div>
                          <?php endif; ?>
                        </div>
                        <!--end::Image-->
                        <!--begin::Title-->
                        <div class="fs-5 fw-bolder my-3"><?= $note ?></div>
                        <!--end::Title-->
                      </a>
                      <!--end::Name-->
                      <!--begin::Description-->
                      <a href="<?= base_url("docload/" . $kantor . "/dokumen/" . $namafile) ?>" class="btn btn-light-primary" style="display: <?= $displaydownload ?>;">Download</a>
                      <!--end::Description-->
                    </div>

                    <!--end::Card body-->
                  </div>
                  <!--end::Card-->
                </div>
              <?php endforeach; ?>
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card bg-light-primary border-primary border border-dashed m-10 d-flex justify-content-center align-items-center text-center" style="min-height: 250px;" data-bs-toggle="modal" data-bs-target="#modalTambahDokumen">
                  <a href="#" class="flex-center d-flex flex-column align-items-center">
                    <img src="<?= base_url() ?>assets/media/svg/files/upload.svg" class="mb-5" alt="" />
                    <div class="text-hover-primary fs-5 fw-bolder mb-2">File Upload</div>
                  </a>
                </div>
              </div>
              <!--end::Col-->
            </div>
            <!--end:Row-->
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
<div class="modal fade" id="modalTambahDokumen" tabindex="-1" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog mw-850px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header">
        <!--begin::Modal title-->
        <h2>Tambah Dokumen</h2>
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
        <form id="formTambahDokumen" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
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
            <label class="col-lg-3 mt-3 fw-bolder text-muted">File Dokumen</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <input type="file" class="form-control" name="filedokumen" accept=".png, .jpg, .jpeg, .pdf" />
              <div id="validation-filedokumen" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Catatan</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <textarea class="form-control form-control-solid" rows="3" name="catatan" placeholder="Catatan"></textarea>
              <div id="validation-catatan" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--end::Input group-->
          <div class="text-center mt-7">
            <a class="btn btn-light me-3" data-bs-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-primary" id="btnTambahDokumen">
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
<script>
  $(document).ready(function() {
    $('.datadokumen').magnificPopup({
      delegate: 'a.popup-img, a.popup-pdf',
      type: 'image',
      gallery: {
        enabled: true
      },
      zoom: {
        enabled: true,
        duration: 300,
        opener: function(element) {
          return element.is('img') ? element : element.find('img');
        }
      },
      callbacks: {
        elementParse: function(item) {
          if (item.el.hasClass('popup-pdf')) {
            item.type = 'iframe';
            if (!item.src.includes('#')) {
              item.src += '#toolbar=0&navpanes=0&scrollbar=0';
            }
          } else if (item.el.hasClass('popup-img')) {
            item.type = 'image';
          }
        },
        imageLoadComplete: function() {
          let img = this.content.find('img');
          let scale = 1;

          img.css('transform', '').off('wheel.mfpZoom');
          img.on('wheel.mfpZoom', function(e) {
            e.preventDefault();
            if (e.originalEvent.deltaY < 0) {
              scale += 0.1;
            } else {
              scale = Math.max(1, scale - 0.1);
            }
            $(this).css('transform', 'scale(' + scale + ')');
          });
        },
        close: function() {
          this.content.find('img').off('wheel.mfpZoom').css('transform', '');
        }
      },
      iframe: {
        markup: '<div class="mfp-iframe-scaler">' +
          '<div class="mfp-close"></div>' +
          '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
          '</div>',
      }
    });

    $("#datadokumen .btnHapus").on('click', function() {
      var id = $(this).attr("data-id");
      Swal.fire({
        html: `Apakah Anda yakin menghapus dokumen ini?`,
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
            url: '<?= base_url('karyawan/proses?act=delete_dokumen') ?>',
            type: 'POST',
            data: {
              id: id
            },
            dataType: 'JSON',
            success: function(result) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil menghapus data dokumen");
              sessionStorage.setItem("alert_icon", "warning");
              location.reload();
            },
          });
        }
      });
    });

    $('#formTambahDokumen').on('submit', function(evt) {
      evt.preventDefault();
      $('#btnTambahDokumen .indicator-label').hide();
      $('#btnTambahDokumen .indicator-progress').show();
      var formdata = new FormData($(this)[0]);
      $.ajax({
        url: '<?= base_url() ?>karyawan/proses?act=tambah_dokumen',
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
              $("#formTambahDokumen #validation-" + notempty[i]).html('');
            }
            for (i = 0; i < name.length; i++) {
              $("#formTambahDokumen #validation-" + name[i]).attr("class", "invalid-feedback");
              $("#formTambahDokumen #validation-" + name[i]).html(result.errors[name[i]]);
              $("#formTambahDokumen #validation-" + name[i]).attr("style", "display:block");
            }
            $('#btnTambahDokumen .indicator-label').text("Cek Data Kembali");
            $('#btnTambahDokumen .indicator-label').show();
            $('#btnTambahDokumen .indicator-progress').hide();
            $('#btnTambahDokumen').removeClass("btn-primary");
            $('#btnTambahDokumen').addClass("btn-danger");
            setTimeout(function() {
              $('#btnTambahDokumen .indicator-label').text("Simpan");
              $('#btnTambahDokumen').removeClass("btn-danger");
              $('#btnTambahDokumen').addClass("btn-primary");
            }, 3500);
          } else {
            if (result.insert == true) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil menambahkan data dokumen");
              $('#btnTambahDokumen .indicator-label').text("Berhasil");
              $('#btnTambahDokumen .indicator-label').show();
              $('#btnTambahDokumen .indicator-progress').hide();
              $('#btnTambahDokumen').removeClass("btn-primary");
              $('#btnTambahDokumen').addClass("btn-success");
              location.reload();
            }
          }
        },
        error: function(result) {
          // alert(result);
        }
      });
    });
  });
</script>
<?= $this->endSection() ?>