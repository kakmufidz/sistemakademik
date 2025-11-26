<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<?php

use App\Models\Karyawan;

$this->db = db_connect();
$this->request = service('request');
$getKey = $this->request->getGet('key');
$mkaryawan = new Karyawan;
// Ambil data nama pelatihan dari tabel pelatihan
$kumpulandatapelatihan = $this->db->table("pelatihan")
  ->distinct()
  ->select("nama")
  ->get()
  ->getResultArray();

// Ambil data penyelenggara dari tabel pelatihan
$kumpulandatapenyelenggara = $this->db->table("pelatihan")
  ->distinct()
  ->select("penyelenggara")
  ->get()
  ->getResultArray();

// Ambil data tempat dari tabel pelatihan
$kumpulandatatempat = $this->db->table("pelatihan")
  ->distinct()
  ->select("tempat")
  ->get()
  ->getResultArray();
?>
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
              <span class="card-label fw-bolder text-dark">Data Pelatihan</span>
            </h3>
            <div class="card-toolbar">
              <a href="javascript:;" class="btn btn-primary align-self-center" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-bs-toggle="modal" data-bs-target="#modalTambahPelatihan">Input Pelatihan</a>
            </div>
          </div>
          <!--end::Header-->
          <!--begin::Body-->
          <div class="card-body pt-5">
            <?php if (empty($datapelatihan)): ?>
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
                    <div class="fs-6 text-gray-700 pe-7">Harap masukan informasi data pelatihan.</div>
                  </div>
                  <!--end::Content-->
                </div>
                <!--end::Wrapper-->
              </div>
            <?php else: ?>
              <!--begin::Table container-->
              <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" id="tabel_pelatihan">
                  <!--begin::Table head-->
                  <thead>
                    <tr class="fw-bolder text-muted">
                      <th class="w-30px">No</th>
                      <th class="min-w-140px">Pelatihan</th>
                      <th class="min-w-140px">Penyelenggara</th>
                      <th class="min-w-140px">Tempat</th>
                      <th class="min-w-140px">Tanggal Mulai</th>
                      <th class="min-w-140px">Tanggal Selesai</th>
                      <th class="min-w-140px">File</th>
                      <th class="min-w-140px">Materi</th>
                      <th class="min-w-100px text-end">Actions</th>
                    </tr>
                  </thead>
                  <!--end::Table head-->
                  <!--begin::Table body-->
                  <tbody>
                    <?php $no = 1;
                    foreach ($datapelatihan as $pelatihan):
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
                          <div class="d-flex align-items-center">
                            <div class="flex-grow-1 me-2">
                              <span class="text-gray-800 fs-6 fw-bolder"><?= $pelatihan["nama"] ?></span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="flex-grow-1 me-2">
                              <span class="text-gray-800 fs-6 fw-bolder"><?= $pelatihan["penyelenggara"] ?></span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="flex-grow-1 me-2">
                              <span class="text-gray-800 fs-6 fw-bolder"><?= $pelatihan["tempat"] ?></span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span class="text-gray-800 fs-6 fw-bolder"><?= tgl_indo($pelatihan["tgl_mulai"]) ?></span>
                        </td>
                        <td>
                          <span class="text-gray-800 fs-6 fw-bolder"><?= ($pelatihan["tgl_selesai"]) ? tgl_indo($pelatihan["tgl_selesai"]) : "-" ?></span>
                        </td>
                        <td>
                          <?php if ($pelatihan["file"]): ?>
                            <div class="d-flex align-items-center mb-5">
                              <!--begin::Icon-->
                              <div class="symbol symbol-30px me-5">
                                <img alt="Icon" src="<?= base_url("assets/media/svg/files/pdf.svg") ?>">
                              </div>
                              <!--end::Icon-->
                              <!--begin::Details-->
                              <div class="fw-bold">
                                <a class="fs-6 fw-bolder text-dark text-hover-primary" target="_blank" href="<?= base_url("docview/" . $kantor . "/pelatihan/" . $pelatihan["file"]) ?>"><?= $pelatihan["file"] ?></a><br>
                                <a class="text-primary" href="<?= base_url("docload/" . $kantor . "/pelatihan/" . $pelatihan["file"]) ?>">
                                  <span>Downloads</span>
                                </a>
                              </div>
                              <!--end::Menu-->
                            </div>
                          <?php else: ?>
                            -
                          <?php endif; ?>
                        </td>
                        <td class="text-center">
                          <?php if ($pelatihan["link_materi"]): ?>
                            <a href="<?= $pelatihan["link_materi"] ?>" target="_blank" class="btn btn-icon btn-primary w-40px h-40px me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                              <!--begin::Svg Icon | path: assets/media/icons/duotune/coding/cod008.svg-->
                              <span class="svg-icon svg-icon-muted svg-icon-2hx">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                  <path d="M11.2166 8.50002L10.5166 7.80007C10.1166 7.40007 10.1166 6.80005 10.5166 6.40005L13.4166 3.50002C15.5166 1.40002 18.9166 1.50005 20.8166 3.90005C22.5166 5.90005 22.2166 8.90007 20.3166 10.8001L17.5166 13.6C17.1166 14 16.5166 14 16.1166 13.6L15.4166 12.9C15.0166 12.5 15.0166 11.9 15.4166 11.5L18.3166 8.6C19.2166 7.7 19.1166 6.30002 18.0166 5.50002C17.2166 4.90002 16.0166 5.10007 15.3166 5.80007L12.4166 8.69997C12.2166 8.89997 11.6166 8.90002 11.2166 8.50002ZM11.2166 15.6L8.51659 18.3001C7.81659 19.0001 6.71658 19.2 5.81658 18.6C4.81658 17.9 4.71659 16.4 5.51659 15.5L8.31658 12.7C8.71658 12.3 8.71658 11.7001 8.31658 11.3001L7.6166 10.6C7.2166 10.2 6.6166 10.2 6.2166 10.6L3.6166 13.2C1.7166 15.1 1.4166 18.1 3.1166 20.1C5.0166 22.4 8.51659 22.5 10.5166 20.5L13.3166 17.7C13.7166 17.3 13.7166 16.7001 13.3166 16.3001L12.6166 15.6C12.3166 15.2 11.6166 15.2 11.2166 15.6Z" fill="black" />
                                  <path opacity="0.3" d="M5.0166 9L2.81659 8.40002C2.31659 8.30002 2.0166 7.79995 2.1166 7.19995L2.31659 5.90002C2.41659 5.20002 3.21659 4.89995 3.81659 5.19995L6.0166 6.40002C6.4166 6.60002 6.6166 7.09998 6.5166 7.59998L6.31659 8.30005C6.11659 8.80005 5.5166 9.1 5.0166 9ZM8.41659 5.69995H8.6166C9.1166 5.69995 9.5166 5.30005 9.5166 4.80005L9.6166 3.09998C9.6166 2.49998 9.2166 2 8.5166 2H7.81659C7.21659 2 6.71659 2.59995 6.91659 3.19995L7.31659 4.90002C7.41659 5.40002 7.91659 5.69995 8.41659 5.69995ZM14.6166 18.2L15.1166 21.3C15.2166 21.8 15.7166 22.2 16.2166 22L17.6166 21.6C18.1166 21.4 18.4166 20.8 18.1166 20.3L16.7166 17.5C16.5166 17.1 16.1166 16.9 15.7166 17L15.2166 17.1C14.8166 17.3 14.5166 17.7 14.6166 18.2ZM18.4166 16.3L19.8166 17.2C20.2166 17.5 20.8166 17.3 21.0166 16.8L21.3166 15.9C21.5166 15.4 21.1166 14.8 20.5166 14.8H18.8166C18.0166 14.8 17.7166 15.9 18.4166 16.3Z" fill="black" />
                                </svg>
                              </span>
                              <!--end::Svg Icon-->
                            </a>
                          <?php else: ?>
                            -
                          <?php endif; ?>
                        </td>
                        <td>
                          <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btnEdit" data-id="<?= $pelatihan["id"] ?>">
                              <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                              <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                  <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                  <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                </svg>
                              </span>
                              <!--end::Svg Icon-->
                            </a>
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm btnHapus" data-id="<?= $pelatihan["id"] ?>">
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
<div class="modal fade" id="modalTambahPelatihan" tabindex="-1" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog mw-850px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header">
        <!--begin::Modal title-->
        <h2>Tambah Data Pelatihan</h2>
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
        <form id="formTambahPelatihan" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
          <!--begin::Row-->
          <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-3 fw-bolder text-muted required">NUK</label>
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
            <label class="col-lg-3 fw-bolder text-muted required">Nama</label>
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
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Pelatihan</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="pelatihan" id="pelatihan" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="pelatihan-lain">PELATIHAN LAINNYA</option>
                <?php foreach ($kumpulandatapelatihan as $item) : ?>
                  <option value="<?= strtoupper($item["nama"]) ?>"><?= strtoupper($item["nama"]) ?></option>
                <?php endforeach; ?>
              </select>
              <div id="showpelatihan"></div>
              <div id="validation-pelatihan" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Penyelenggara</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="penyelenggara" id="penyelenggara" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="penyelenggara-lain">PENYELENGGARA LAINNYA</option>
                <?php foreach ($kumpulandatapenyelenggara as $item) : ?>
                  <option value="<?= strtoupper($item["penyelenggara"]) ?>"><?= strtoupper($item["penyelenggara"]) ?></option>
                <?php endforeach; ?>
              </select>
              <div id="showpenyelenggara"></div>
              <div id="validation-penyelenggara" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Tempat</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="tempat" id="tempat" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="tempat-lain">TEMPAT LAINNYA</option>
                <?php foreach ($kumpulandatatempat as $item) : ?>
                  <option value="<?= strtoupper($item["tempat"]) ?>"><?= strtoupper($item["tempat"]) ?></option>
                <?php endforeach; ?>
              </select>
              <div id="showtempat"></div>
              <div id="validation-tempat" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Tanggal Mulai</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <input class="form-control form-control-solid" type="text" placeholder="Tanggal Mulai" name="tgl_mulai" id="tgl_mulai" required />
              <div id="validation-tgl_mulai" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Tanggal Selesai</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <input class="form-control form-control-solid" type="text" placeholder="Tanggal Selesai" name="tgl_selesai" id="tgl_selesai" />
              <div id="validation-tgl_selesai" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">File Sertifikat</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <input type="file" class="form-control" name="filedokumen" accept=".pdf" />
              <div id="validation-filedokumen" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Link Materi</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <textarea name="materi" id="materi" class="form-control form-control-solid" rows="3"></textarea>
              <div id="validation-materi" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--end::Input group-->
          <div class="text-center mt-7">
            <a class="btn btn-light me-3" data-bs-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-primary" id="btnTambahPelatihan">
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

<div class="modal fade" id="modalEditPelatihan" tabindex="-1" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog mw-850px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header">
        <!--begin::Modal title-->
        <h2>Edit Data Pelatihan</h2>
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
        <form id="formEditPelatihan" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
          <!--begin::Row-->
          <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-3 fw-bolder text-muted required">NUK</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <span class="fw-bolder fs-6 text-gray-800"><?= $karyawan['usernuk'] ?></span>
              <input type="hidden" name="id_data" value="" required>
              <input type="hidden" name="usernuk" value="<?= $karyawan['usernuk'] ?>" required>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Row-->
          <!--begin::Row-->
          <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-3 fw-bolder text-muted required">Nama</label>
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
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Pelatihan</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="edit_pelatihan" id="edit_pelatihan" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="pelatihan-lain">PELATIHAN LAINNYA</option>
                <?php foreach ($kumpulandatapelatihan as $item) : ?>
                  <option value="<?= strtoupper($item["nama"]) ?>"><?= strtoupper($item["nama"]) ?></option>
                <?php endforeach; ?>
              </select>
              <div id="showpelatihan"></div>
              <div id="validation-edit_pelatihan" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Penyelenggara</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="edit_penyelenggara" id="edit_penyelenggara" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="penyelenggara-lain">PENYELENGGARA LAINNYA</option>
                <?php foreach ($kumpulandatapenyelenggara as $item) : ?>
                  <option value="<?= strtoupper($item["penyelenggara"]) ?>"><?= strtoupper($item["penyelenggara"]) ?></option>
                <?php endforeach; ?>
              </select>
              <div id="showpenyelenggara"></div>
              <div id="validation-edit_penyelenggara" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Tempat</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="edit_tempat" id="edit_tempat" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="tempat-lain">PENYELENGGARA LAINNYA</option>
                <?php foreach ($kumpulandatatempat as $item) : ?>
                  <option value="<?= strtoupper($item["tempat"]) ?>"><?= strtoupper($item["tempat"]) ?></option>
                <?php endforeach; ?>
              </select>
              <div id="showtempat"></div>
              <div id="validation-edit_tempat" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Tanggal Mulai</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <input class="form-control form-control-solid" type="text" placeholder="Tanggal Mulai" name="edit_tgl_mulai" id="edit_tgl_mulai" required />
              <div id="validation-edit_tgl_mulai" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Tanggal Selesai</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <input class="form-control form-control-solid" type="text" placeholder="Tanggal Selesai" name="edit_tgl_selesai" id="edit_tgl_selesai" />
              <div id="validation-edit_tgl_selesai" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Ganti Sertifikat</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <input type="file" class="form-control" name="edit_filedokumen" accept=".pdf" />
              <div id="validation-edit_filedokumen" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Link Materi</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <textarea name="edit_materi" id="edit_materi" class="form-control form-control-solid" rows="3"></textarea>
              <div id="validation-edit_materi" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--end::Input group-->
          <div class="text-center mt-7">
            <a class="btn btn-light me-3" data-bs-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-primary" id="btnEditPelatihan">
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
      if (name == "pelatihan") {
        placeholder = "Pilih data pelatihan";
      } else if (name == "penyelenggara") {
        placeholder = "Pilih data penyelenggara";
      } else if (name == "tempat") {
        placeholder = "Pilih data tempat";
      } else if (name == "edit_pelatihan") {
        placeholder = "Pilih data pelatihan";
      } else if (name == "edit_penyelenggara") {
        placeholder = "Pilih data penyelenggara";
      } else if (name == "edit_tempat") {
        placeholder = "Pilih data tempat";
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
    var kantor = "<?= $kantor ?>";
    $('#formTambahPelatihan input[name="tgl_mulai"]').daterangepicker({
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

    $('#formTambahPelatihan input[name="tgl_selesai"]').daterangepicker({
      locale: {
        format: 'DD MMM YYYY',
      },
      singleDatePicker: true,
      placeholder: {
        text: "Pilih tanggal"
      },
      showDropdowns: true,
      minYear: 1950,
    });

    $('#formTambahPelatihan').on('change', 'select[name="pelatihan"]', function() {
      var select = $(this).val();
      $('#formTambahPelatihan input[name="pelatihan_lain"]').remove();
      if (select === 'pelatihan-lain') {
        $('#formTambahPelatihan #showpelatihan').append(`<input type="text" name="pelatihan_lain" class="form-control form-control-solid mt-2" placeholder="Masukkan nama pelatihan lain" required />`);
      }
    });

    $('#formTambahPelatihan').on('change', 'select[name="penyelenggara"]', function() {
      var select = $(this).val();
      $('#formTambahPelatihan input[name="penyelenggara_lain"]').remove();
      if (select === 'penyelenggara-lain') {
        $('#formTambahPelatihan #showpenyelenggara').append(`<input type="text" name="penyelenggara_lain" class="form-control form-control-solid mt-2" placeholder="Masukkan nama penyelenggara lain" required />`);
      }
    });

    $('#formTambahPelatihan').on('change', 'select[name="tempat"]', function() {
      var select = $(this).val();
      $('#formTambahPelatihan input[name="tempat_lain"]').remove();
      if (select === 'tempat-lain') {
        $('#formTambahPelatihan #showtempat').append(`<input type="text" name="tempat_lain" class="form-control form-control-solid mt-2" placeholder="Masukkan nama tempat lain" required />`);
      }
    });

    $('#formTambahPelatihan').on('submit', function(evt) {
      evt.preventDefault();
      $('#btnTambahPelatihan .indicator-label').hide();
      $('#btnTambahPelatihan .indicator-progress').show();
      var formdata = new FormData($(this)[0]);
      formdata.append("kantor", kantor);
      $.ajax({
        url: '<?= base_url() ?>karyawan/proses?act=tambah_pelatihan',
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
              $("#formTambahPelatihan #validation-" + notempty[i]).html('');
            }
            for (i = 0; i < name.length; i++) {
              $("#formTambahPelatihan #validation-" + name[i]).attr("class", "invalid-feedback");
              $("#formTambahPelatihan #validation-" + name[i]).html(result.errors[name[i]]);
              $("#formTambahPelatihan #validation-" + name[i]).attr("style", "display:block");
            }
            $('#btnTambahPelatihan .indicator-label').text("Cek Data Kembali");
            $('#btnTambahPelatihan .indicator-label').show();
            $('#btnTambahPelatihan .indicator-progress').hide();
            $('#btnTambahPelatihan').removeClass("btn-primary");
            $('#btnTambahPelatihan').addClass("btn-danger");
            setTimeout(function() {
              $('#btnTambahPelatihan .indicator-label').text("Simpan");
              $('#btnTambahPelatihan').removeClass("btn-danger");
              $('#btnTambahPelatihan').addClass("btn-primary");
            }, 3500);
          } else {
            if (result.insert == true) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil menambahkan data pelatihan");
              $('#btnTambahPelatihan .indicator-label').text("Berhasil");
              $('#btnTambahPelatihan .indicator-label').show();
              $('#btnTambahPelatihan .indicator-progress').hide();
              $('#btnTambahPelatihan').removeClass("btn-primary");
              $('#btnTambahPelatihan').addClass("btn-success");
              location.reload();
            }
          }
        },
        error: function(result) {
          // alert(result);
        }
      });
    });

    $('#formEditPelatihan input[name="edit_tgl_mulai"]').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      minYear: 1950,
      locale: {
        format: 'DD MMM YYYY'
      },
    });

    $('#formEditPelatihan input[name="edit_tgl_selesai"]').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      minYear: 1950,
      locale: {
        format: 'DD MMM YYYY'
      },
    });

    // Event klik edit
    $("#tabel_pelatihan .btnEdit").on('click', function() {
      var id = $(this).attr("data-id");
      $.ajax({
        url: '<?= base_url('karyawan/get_data?act=pelatihan') ?>',
        type: 'POST',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(result) {
          if (result) {
            $('#formEditPelatihan input[name="id_data"]').val(result.id);
            $('#formEditPelatihan select[name="edit_pelatihan"]').val(result.nama.toUpperCase()).trigger('change');
            if (result && result.penyelenggara) {
              $('#formEditPelatihan select[name="edit_penyelenggara"]')
                .val(result.penyelenggara.toUpperCase())
                .trigger('change');
            } else {
              $('#formEditPelatihan select[name="edit_penyelenggara"]').val("").trigger('change');
            }
            if (result && result.tempat) {
              $('#formEditPelatihan select[name="edit_tempat"]')
                .val(result.tempat.toUpperCase())
                .trigger('change');
            } else {
              $('#formEditPelatihan select[name="edit_tempat"]').val("").trigger('change');
            }
            const tgl_mulai = moment(result.tgl_mulai, 'YYYY-MM-DD').format('DD MMM YYYY');
            const tgl_selesai = moment(result.tgl_selesai, 'YYYY-MM-DD').format('DD MMM YYYY');
            $('#formEditPelatihan input[name="edit_tgl_mulai"]').data('daterangepicker').setStartDate(tgl_mulai);
            $('#formEditPelatihan input[name="edit_tgl_selesai"]').data('daterangepicker').setStartDate(tgl_selesai);
            $('#formEditPelatihan textarea[name="edit_materi"]').val(result.link_materi);
            $("#modalEditPelatihan").modal("show");
          }
        }
      });
    });

    $('#formEditPelatihan').on('change', 'select[name="edit_pelatihan"]', function() {
      var select = $(this).val();
      $('#formEditPelatihan input[name="edit_pelatihan_lain"]').remove();
      if (select === 'pelatihan-lain') {
        $('#formEditPelatihan #showpelatihan').append(`<input type="text" name="edit_pelatihan_lain" class="form-control form-control-solid mt-2" placeholder="Masukkan nama pelatihan lain" required />`);
      }
    });

    $('#formEditPelatihan').on('change', 'select[name="edit_penyelenggara"]', function() {
      var select = $(this).val();
      $('#formEditPelatihan input[name="edit_penyelenggara_lain"]').remove();
      if (select === 'penyelenggara-lain') {
        $('#formEditPelatihan #showpenyelenggara').append(`<input type="text" name="edit_penyelenggara_lain" class="form-control form-control-solid mt-2" placeholder="Masukkan nama penyelenggara lain" required />`);
      }
    });

    $('#formEditPelatihan').on('change', 'select[name="edit_tempat"]', function() {
      var select = $(this).val();
      $('#formEditPelatihan input[name="edit_tempat_lain"]').remove();
      if (select === 'tempat-lain') {
        $('#formEditPelatihan #showtempat').append(`<input type="text" name="edit_tempat_lain" class="form-control form-control-solid mt-2" placeholder="Masukkan nama tempat lain" required />`);
      }
    });

    $('#formEditPelatihan').on('submit', function(evt) {
      evt.preventDefault();
      $('#btnEditPelatihan .indicator-label').hide();
      $('#btnEditPelatihan .indicator-progress').show();
      var formdata = new FormData($(this)[0]);
      formdata.append("kantor", kantor);
      $.ajax({
        url: '<?= base_url() ?>karyawan/proses?act=update_pelatihan',
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
              $("#formEditPelatihan #validation-" + notempty[i]).html('');
            }
            for (i = 0; i < name.length; i++) {
              $("#formEditPelatihan #validation-" + name[i]).attr("class", "invalid-feedback");
              $("#formEditPelatihan #validation-" + name[i]).html(result.errors[name[i]]);
              $("#formEditPelatihan #validation-" + name[i]).attr("style", "display:block");
            }
            $('#btnEditPelatihan .indicator-label').text("Cek Data Kembali");
            $('#btnEditPelatihan .indicator-label').show();
            $('#btnEditPelatihan .indicator-progress').hide();
            $('#btnEditPelatihan').removeClass("btn-primary");
            $('#btnEditPelatihan').addClass("btn-danger");
            setTimeout(function() {
              $('#btnEditPelatihan .indicator-label').text("Simpan");
              $('#btnEditPelatihan').removeClass("btn-danger");
              $('#btnEditPelatihan').addClass("btn-primary");
            }, 3500);
          } else {
            if (result.update == true) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil merubah data pelatihan");
              $('#btnEditPelatihan .indicator-label').text("Berhasil");
              $('#btnEditPelatihan .indicator-label').show();
              $('#btnEditPelatihan .indicator-progress').hide();
              $('#btnEditPelatihan').removeClass("btn-primary");
              $('#btnEditPelatihan').addClass("btn-success");
              location.reload();
            }
          }
        },
        error: function(result) {
          // alert(result);
        }
      });
    });

    // Event klik hapus
    $("#tabel_pelatihan .btnHapus").on('click', function() {
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
            url: '<?= base_url('karyawan/proses?act=delete_pelatihan') ?>',
            type: 'POST',
            data: {
              id: id,
              kantor: kantor
            },
            dataType: 'JSON',
            success: function(result) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil hapus data kontrak");
              sessionStorage.setItem("alert_icon", "warning");
              location.reload();
            },
          });
        }
      });
    });

  });
</script>
<?= $this->endSection() ?>