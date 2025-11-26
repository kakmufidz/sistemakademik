<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<?php

use App\Models\Karyawan;

$this->db = db_connect();
$this->request = service('request');
$getKey = $this->request->getGet('key');
$mkaryawan = new Karyawan;
$datajabataninternal = $mkaryawan->getJabatanInternal();
$datadepartment = $this->db->table("department")->get()->getResultArray();

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
              <span class="card-label fw-bolder text-dark">Data Kontrak & Jabatan</span>
            </h3>
            <div class="card-toolbar">
              <a href="javascript:;" class="btn btn-primary align-self-center" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-bs-toggle="modal" data-bs-target="#modalTambahKontrak">Input Kontrak</a>
            </div>
          </div>
          <!--end::Header-->
          <!--begin::Body-->
          <div class="card-body pt-5">
            <?php if (empty($datakontrak)): ?>
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
                    <div class="fs-6 text-gray-700 pe-7">Harap masukan informasi data kontrak & jabatan.</div>
                  </div>
                  <!--end::Content-->
                </div>
                <!--end::Wrapper-->
              </div>
            <?php else: ?>
              <!--begin::Table container-->
              <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" id="tabel_kontrak">
                  <!--begin::Table head-->
                  <thead>
                    <tr class="fw-bolder text-muted">
                      <th class="w-30px">No</th>
                      <th class="min-w-140px">Data</th>
                      <th class="min-w-140px">Tanggal Mulai</th>
                      <th class="min-w-140px">Tanggal Selesai</th>
                      <th class="min-w-140px">File</th>
                      <th class="min-w-120px text-center">Evaluasi</th>
                      <th class="min-w-100px text-end">Actions</th>
                    </tr>
                  </thead>
                  <!--end::Table head-->
                  <!--begin::Table body-->
                  <tbody>
                    <?php $no = 1;
                    foreach ($datakontrak as $kontrak):
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
                              <span class="text-gray-800 text-hover-primary fs-6 fw-bolder"><?= $kontrak["jenis"] ?></span>
                              <span class="text-muted fw-bolder d-block fs-7"><?= $kontrak["jabatan"] ?></span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span class="text-gray-800 text-hover-primary fs-6 fw-bolder"><?= tgl_indo($kontrak["tgl_mulai"]) ?></span>
                        </td>
                        <td>
                          <span class="text-gray-800 text-hover-primary fs-6 fw-bolder"><?= ($kontrak["tgl_selesai"]) ? tgl_indo($kontrak["tgl_selesai"]) : "-" ?></span>
                        </td>
                        <td>
                          <?php if ($kontrak["file"]): ?>
                            <div class="d-flex align-items-center mb-5">
                              <!--begin::Icon-->
                              <div class="symbol symbol-30px me-5">
                                <img alt="Icon" src="<?= base_url("assets/media/svg/files/pdf.svg") ?>">
                              </div>
                              <!--end::Icon-->
                              <!--begin::Details-->
                              <div class="fw-bold">
                                <a class="fs-6 fw-bolder text-dark text-hover-primary" target="_blank" href="<?= base_url("docview/" . $kantor . "/kontrak/" . $kontrak["file"]) ?>"><?= $kontrak["file"] ?></a><br>
                                <a class="text-primary" href="<?= base_url("docload/" . $kantor . "/kontrak/" . $kontrak["file"]) ?>">
                                  <span>Downloads</span>
                                </a>
                              </div>
                              <!--end::Menu-->
                            </div>
                          <?php else: ?>
                            <span class="text-gray-800 text-hover-primary fs-6 fw-bolder">-</span>
                          <?php endif; ?>
                        </td>
                        <td class="text-center">
                          <?php if ($kontrak["status_evaluasi"] == null): ?>
                            <a class="badge badge-dark btnEvaluasi" href="javascript:;" data-id="<?= $kontrak["id"] ?>">Belum Evaluasi</a>
                          <?php else: ?>
                            <a class="badge badge-light-primary btnEditEvaluasi" href="javascript:;" data-id="<?= $kontrak["id"] ?>"><?= $kontrak["status_evaluasi"] ?></a>
                          <?php endif; ?>
                        </td>
                        <td>
                          <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btnEdit" data-id="<?= $kontrak["id"] ?>">
                              <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                              <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                  <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                  <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                </svg>
                              </span>
                              <!--end::Svg Icon-->
                            </a>
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm btnHapus" data-id="<?= $kontrak["id"] ?>">
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
<div class="modal fade" id="modalEvaluasi" tabindex="-1" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog mw-850px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header">
        <!--begin::Modal title-->
        <h2>Form Evaluasi Perjanjian Kontrak Karyawan</h2>
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
        <form id="formTambahEvaluasi" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
          <!--begin::Row-->
          <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-3 fw-bolder text-muted">NUK</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <span class="fw-bolder fs-6 text-gray-800"><?= $karyawan['usernuk'] ?></span>
              <input type="hidden" name="usernuk" value="<?= $karyawan['usernuk'] ?>" required>
              <input type="hidden" name="id_kontrak" required>
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
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Status Evaluasi</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="status_evaluasi" id="status_evaluasi" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="KONTRAK BARU">KONTRAK BARU</option>
                <option value="MENJADI KARYAWAN TETAP">MENJADI KARYAWAN TETAP</option>
                <option value="MUTASI">MUTASI</option>
                <option value="PROMOSI/KENAIKAN JABATAN">PROMOSI/KENAIKAN JABATAN</option>
                <option value="MEMBERHENTIKAN">MEMBERHENTIKAN</option>
              </select>
              <div id="validation-status_evaluasi" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Hasil Evaluasi</label>
            <!--end::Label-->
          </div>
          <div class="row mb-3">
            <!--begin::Label-->
            <div class="col-lg-12 mt-3">
              <textarea name="hasil_evaluasi" id="hasil_evaluasi"></textarea>
            </div>
            <!--end::Label-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">File Dokumen</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-9">
              <input type="file" class="form-control" name="filedokumen" accept=".pdf" />
              <div id="validation-filedokumen" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <div class="text-center mt-7">
            <a class="btn btn-light me-3" data-bs-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-primary" id="btnTambahEvaluasi">
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

<div class="modal fade" id="modalEditEvaluasi" tabindex="-1" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog mw-850px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header">
        <!--begin::Modal title-->
        <h2>Form Evaluasi Perjanjian Kontrak Karyawan</h2>
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
        <form id="formEditEvaluasi" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
          <!--begin::Row-->
          <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-3 fw-bolder text-muted">NUK</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <span class="fw-bolder fs-6 text-gray-800"><?= $karyawan['usernuk'] ?></span>
              <input type="hidden" name="usernuk" value="<?= $karyawan['usernuk'] ?>" required>
              <input type="hidden" name="id_kontrak" required>
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
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Status Evaluasi</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="edit_status_evaluasi" id="edit_status_evaluasi" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="KONTRAK BARU">KONTRAK BARU</option>
                <option value="MENJADI KARYAWAN TETAP">MENJADI KARYAWAN TETAP</option>
                <option value="MUTASI">MUTASI</option>
                <option value="PROMOSI/KENAIKAN JABATAN">PROMOSI/KENAIKAN JABATAN</option>
                <option value="MEMBERHENTIKAN">MEMBERHENTIKAN</option>
              </select>
              <div id="validation-edit_status_evaluasi" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Hasil Evaluasi</label>
            <!--end::Label-->
          </div>
          <div class="row mb-3">
            <!--begin::Label-->
            <div class="col-lg-12 mt-3">
              <textarea name="hasil_evaluasi" id="hasil_evaluasi"></textarea>
            </div>
            <!--end::Label-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row" id="file_evaluasi">
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Ganti Dokumen</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-9">
              <input type="file" class="form-control" name="filedokumen" accept=".pdf" />
              <div id="validation-filedokumen" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <div class="text-center mt-7">
            <a class="btn btn-light me-3" data-bs-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-primary" id="btnEditEvaluasi">
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

<div class="modal fade" id="modalTambahKontrak" tabindex="-1" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog mw-850px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header">
        <!--begin::Modal title-->
        <h2>Tambah Data Kontrak & Jabatan</h2>
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

        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed min-w-lg-600px flex-shrink-0 p-6 mb-7">
          <!--begin::Icon-->
          <!--begin::Svg Icon | path: icons/duotune/coding/cod004.svg-->
          <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
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
              <h4 class="text-gray-900 fw-bolder">Sesuaikan data!</h4>
              <div class="fs-6 text-gray-700 pe-7">Harap masukan informasi data kontrak & jabatan sesuai dokumen yang akan diupload.</div>
            </div>
            <!--end::Content-->
          </div>
          <!--end::Wrapper-->
        </div>
        <form id="formTambahKontrak" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
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
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Jenis</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="jenis_kontrak" id="jenis_kontrak" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="TRAINING">TRAINING</option>
                <option value="KONTRAK">KONTRAK</option>
                <option value="PEGAWAI TETAP">PEGAWAI TETAP</option>
                <option value="MUTASI">MUTASI</option>
                <option value="PROMOSI/KENAIKAN JABATAN">PROMOSI/KENAIKAN JABATAN</option>
              </select>
              <div id="validation-jenis_kontrak" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Department</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="department" id="department" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <?php foreach ($datadepartment as $department) : ?>
                  <option value="<?= $department["id"] ?>"><?= strtoupper($department["keterangan"]) ?></option>
                <?php endforeach; ?>
              </select>
              <div id="validation-department" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted required">Jabatan</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="jabatan" id="jabatan" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="jabatan-lain">JABATAN LAINNYA</option>
                <?php foreach ($datajabataninternal as $jabatan) : ?>
                  <option value="<?= strtoupper($jabatan) ?>"><?= strtoupper($jabatan) ?></option>
                <?php endforeach; ?>
              </select>
              <div id="showjabatan"></div>
              <div id="validation-jabatan" class="fv-plugins-message-container invalid-feedback"></div>
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
          <div id="row_tgl_selesai" style="display: none;">
            <div class="row">
              <!--begin::Label-->
              <label class="col-lg-3 mt-3 fw-bolder text-muted">Tanggal Selesai</label>
              <!--end::Label-->
              <!--begin::Col-->
              <div class="col-lg-8">
                <input class="form-control form-control-solid" type="text" placeholder="Tanggal Selesai" name="tgl_selesai" id="tgl_selesai" />
                <div id="validation-tgl_selesai" class="fv-plugins-message-container invalid-feedback"></div>
              </div>
              <!--end::Col-->
            </div>
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">File Dokumen</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <input type="file" class="form-control" name="filedokumen" accept=".pdf" />
              <div id="validation-filedokumen" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--end::Input group-->
          <div class="text-center mt-7">
            <a class="btn btn-light me-3" data-bs-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-primary" id="btnTambahKontrak">
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

<div class="modal fade" id="modalEditKontrak" tabindex="-1" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog mw-850px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header">
        <!--begin::Modal title-->
        <h2>Edit Data Kontrak</h2>
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
        <form id="formEditKontrak" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
          <!--begin::Row-->
          <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-3 fw-bolder text-muted">NUK</label>
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
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Jenis</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="edit_jenis_kontrak" id="edit_jenis_kontrak" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="TRAINING">TRAINING</option>
                <option value="KONTRAK">KONTRAK</option>
                <option value="PEGAWAI TETAP">PEGAWAI TETAP</option>
                <option value="MUTASI">MUTASI</option>
                <option value="PROMOSI/KENAIKAN JABATAN">PROMOSI/KENAIKAN JABATAN</option>
              </select>
              <div id="validation-edit_jenis_kontrak" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Department</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="edit_department" id="edit_department" class="form-select form-select-solid form-select-lg fw-bold">
                <option value=""></option>
                <?php foreach ($datadepartment as $department) : ?>
                  <option value="<?= $department["id"] ?>"><?= strtoupper($department["keterangan"]) ?></option>
                <?php endforeach; ?>
              </select>
              <div id="validation-edit_department" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Jabatan</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="edit_jabatan" id="edit_jabatan" class="form-select form-select-solid form-select-lg fw-bold">
                <option value=""></option>
                <option value="jabatan-lain">JABATAN LAINNYA</option>
                <?php foreach ($datajabataninternal as $jabatan) : ?>
                  <option value="<?= strtoupper($jabatan) ?>"><?= strtoupper($jabatan) ?></option>
                <?php endforeach; ?>
              </select>
              <div id="showjabatan"></div>
              <div id="validation-edit_jabatan" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Tanggal Mulai</label>
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
          <div id="row_edit_tgl_selesai" style="display: none;">
            <div class="row">
              <!--begin::Label-->
              <label class="col-lg-3 mt-3 fw-bolder text-muted">Tanggal Selesai</label>
              <!--end::Label-->
              <!--begin::Col-->
              <div class="col-lg-8">
                <input class="form-control form-control-solid" type="text" placeholder="Tanggal Selesai" name="edit_tgl_selesai" id="edit_tgl_selesai" />
                <div id="validation-edit_tgl_selesai" class="fv-plugins-message-container invalid-feedback"></div>
              </div>
              <!--end::Col-->
            </div>
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Ganti Dokumen</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <input type="file" class="form-control" name="edit_filedokumen" accept=".pdf" />
              <div id="validation-edit_filedokumen" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <div class="text-center mt-7">
            <a class="btn btn-light me-3" data-bs-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-primary" id="btnEditKontrak">
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
      if (name == "department") {
        placeholder = "Pilih department";
      } else if (name == "jabatan") {
        placeholder = "Pilih jabatan";
      } else if (name == "jenis_kontrak") {
        placeholder = "Pilih jenis kontrak";
      } else if (name == "status_evaluasi") {
        placeholder = "Pilih status evaluasi";
      } else if (name == "edit_status_evaluasi") {
        placeholder = "Pilih status evaluasi";
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

    ClassicEditor
      .create(document.querySelector('#formTambahEvaluasi textarea[name="hasil_evaluasi"]'))
      .then(editor => {
        // console.log(editor);
      })
      .catch(error => {
        // console.error(error);
      });

    $('#formTambahKontrak input[name="tgl_mulai"]').daterangepicker({
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

    $('#formTambahKontrak input[name="tgl_selesai"]').daterangepicker({
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

    $('#formTambahKontrak').on('change', 'select[name="jenis_kontrak"]', function() {
      var select = $(this).val();
      let jenis = ['TRAINING', 'KONTRAK'];
      if ($.inArray(select, jenis) !== -1) {
        $("#formTambahKontrak #row_tgl_selesai").css("display", "block");
      } else {
        $("#formTambahKontrak #row_tgl_selesai").css("display", "none")
      }
    });

    $('#formTambahKontrak').on('change', 'select[name="jabatan"]', function() {
      var select = $(this).val();
      $('#formTambahKontrak input[name="jabatan_lain"]').remove();
      if (select === 'jabatan-lain') {
        $('#formTambahKontrak #showjabatan').append(`<input type="text" name="jabatan_lain" class="form-control form-control-solid mt-2" placeholder="Masukkan nama jabatan lain" required />`);
      }
    });

    $('#formTambahKontrak').on('submit', function(evt) {
      evt.preventDefault();
      $('#btnTambahKontrak .indicator-label').hide();
      $('#btnTambahKontrak .indicator-progress').show();
      var formdata = new FormData($(this)[0]);
      formdata.append("kantor", kantor);
      $.ajax({
        url: '<?= base_url() ?>karyawan/proses?act=tambah_kontrak',
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
              $("#formTambahKontrak #validation-" + notempty[i]).html('');
            }
            for (i = 0; i < name.length; i++) {
              $("#formTambahKontrak #validation-" + name[i]).attr("class", "invalid-feedback");
              $("#formTambahKontrak #validation-" + name[i]).html(result.errors[name[i]]);
              $("#formTambahKontrak #validation-" + name[i]).attr("style", "display:block");
            }
            $('#btnTambahKontrak .indicator-label').text("Cek Data Kembali");
            $('#btnTambahKontrak .indicator-label').show();
            $('#btnTambahKontrak .indicator-progress').hide();
            $('#btnTambahKontrak').removeClass("btn-primary");
            $('#btnTambahKontrak').addClass("btn-danger");
            setTimeout(function() {
              $('#btnTambahKontrak .indicator-label').text("Simpan");
              $('#btnTambahKontrak').removeClass("btn-danger");
              $('#btnTambahKontrak').addClass("btn-primary");
            }, 3500);
          } else {
            if (result.insert == true) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil menambahkan data kontrak");
              $('#btnTambahKontrak .indicator-label').text("Berhasil");
              $('#btnTambahKontrak .indicator-label').show();
              $('#btnTambahKontrak .indicator-progress').hide();
              $('#btnTambahKontrak').removeClass("btn-primary");
              $('#btnTambahKontrak').addClass("btn-success");
              location.reload();
            }
          }
        },
        error: function(result) {
          // alert(result);
        }
      });
    });

    $('#formEditKontrak input[name="edit_tgl_mulai"]').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      minYear: 1950,
      locale: {
        format: 'DD MMM YYYY'
      },
    });

    $('#formEditKontrak input[name="edit_tgl_selesai"]').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      minYear: 1950,
      locale: {
        format: 'DD MMM YYYY'
      },
    });

    // Event klik edit
    $("#tabel_kontrak .btnEdit").on('click', function() {
      var id = $(this).attr("data-id");
      $.ajax({
        url: '<?= base_url('karyawan/get_data?act=kontrak') ?>',
        type: 'POST',
        data: {
          id: id,
          kantor: kantor
        },
        dataType: 'json',
        success: function(kontrak) {
          if (kontrak) {
            $('#formEditKontrak input[name="id_data"]').val(kontrak.id);
            $('#formEditKontrak select[name="edit_jenis_kontrak"]').val(kontrak.jenis.toUpperCase()).trigger('change');
            $('#formEditKontrak select[name="edit_department"]').val(kontrak.id_department).trigger('change');
            $('#formEditKontrak select[name="edit_jabatan"]').val(kontrak.jabatan.toUpperCase()).trigger('change');
            const tgl_mulai = moment(kontrak.tgl_mulai, 'YYYY-MM-DD').format('DD MMM YYYY');
            $('#formEditKontrak input[name="edit_tgl_mulai"]').data('daterangepicker').setStartDate(tgl_mulai);
            let jenis = ['TRAINING', 'KONTRAK'];
            if ($.inArray(kontrak.jenis, jenis) !== -1) {
              const tgl_selesai = moment(kontrak.tgl_selesai, 'YYYY-MM-DD').format('DD MMM YYYY');
              $('#formEditKontrak input[name="edit_tgl_selesai"]').data('daterangepicker').setStartDate(tgl_selesai);
              $("#formEditKontrak #row_edit_tgl_selesai").css("display", "block");
            } else {
              $("#formEditKontrak #row_edit_tgl_selesai").css("display", "none")
            }
            $("#modalEditKontrak").modal("show");
          }
        }
      });
    });

    $('#formEditKontrak').on('change', 'select[name="edit_jenis_kontrak"]', function() {
      var select = $(this).val();
      let jenis = ['TRAINING', 'KONTRAK'];
      if ($.inArray(select, jenis) !== -1) {
        $("#formEditKontrak #row_edit_tgl_selesai").css("display", "block");
      } else {
        $("#formEditKontrak #row_edit_tgl_selesai").css("display", "none")
      }
    });

    $('#formEditKontrak').on('change', 'select[name="edit_jabatan"]', function() {
      var select = $(this).val();
      $('#formEditKontrak input[name="jabatan_lain"]').remove();
      if (select === 'jabatan-lain') {
        $('#formEditKontrak #showjabatan').append(`<input type="text" name="jabatan_lain" class="form-control form-control-solid mt-2" placeholder="Masukkan nama jabatan lain" required />`);
      }
    });

    $('#formEditKontrak').on('submit', function(evt) {
      evt.preventDefault();
      $('#btnEditKontrak .indicator-label').hide();
      $('#btnEditKontrak .indicator-progress').show();
      var formdata = new FormData($(this)[0]);
      formdata.append("kantor", kantor);
      $.ajax({
        url: '<?= base_url() ?>karyawan/proses?act=update_kontrak',
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
              $("#formTambahKontrak #validation-" + notempty[i]).html('');
            }
            for (i = 0; i < name.length; i++) {
              $("#formTambahKontrak #validation-" + name[i]).attr("class", "invalid-feedback");
              $("#formTambahKontrak #validation-" + name[i]).html(result.errors[name[i]]);
              $("#formTambahKontrak #validation-" + name[i]).attr("style", "display:block");
            }
            $('#btnEditKontrak .indicator-label').text("Cek Data Kembali");
            $('#btnEditKontrak .indicator-label').show();
            $('#btnEditKontrak .indicator-progress').hide();
            $('#btnEditKontrak').removeClass("btn-primary");
            $('#btnEditKontrak').addClass("btn-danger");
            setTimeout(function() {
              $('#btnEditKontrak .indicator-label').text("Simpan");
              $('#btnEditKontrak').removeClass("btn-danger");
              $('#btnEditKontrak').addClass("btn-primary");
            }, 3500);
          } else {
            if (result.update == true) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil edit data kontrak");
              $('#btnEditKontrak .indicator-label').text("Berhasil");
              $('#btnEditKontrak .indicator-label').show();
              $('#btnEditKontrak .indicator-progress').hide();
              $('#btnEditKontrak').removeClass("btn-primary");
              $('#btnEditKontrak').addClass("btn-success");
              location.reload();
            }
          }
        },
        error: function(result) {
          // alert(result);
        }
      });
    });

    $("#tabel_kontrak .btnHapus").on('click', function() {
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
            url: '<?= base_url('karyawan/proses?act=delete_kontrak') ?>',
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

    // Event Ecaluasi
    $("#tabel_kontrak .btnEvaluasi").on('click', function() {
      var id = $(this).attr("data-id");
      $('#formTambahEvaluasi input[name="id_kontrak"]').val(id);
      $("#modalEvaluasi").modal("show");
    });

    $('#formTambahEvaluasi').on('submit', function(evt) {
      evt.preventDefault();
      $('#btnTambahEvaluasi .indicator-label').hide();
      $('#btnTambahEvaluasi .indicator-progress').show();
      var formdata = new FormData($(this)[0]);
      formdata.append("kantor", kantor);
      $.ajax({
        url: '<?= base_url() ?>karyawan/proses?act=tambah_evaluasi',
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
              $("#formTambahKontrak #validation-" + notempty[i]).html('');
            }
            for (i = 0; i < name.length; i++) {
              $("#formTambahKontrak #validation-" + name[i]).attr("class", "invalid-feedback");
              $("#formTambahKontrak #validation-" + name[i]).html(result.errors[name[i]]);
              $("#formTambahKontrak #validation-" + name[i]).attr("style", "display:block");
            }
            $('#btnTambahEvaluasi .indicator-label').text("Cek Data Kembali");
            $('#btnTambahEvaluasi .indicator-label').show();
            $('#btnTambahEvaluasi .indicator-progress').hide();
            $('#btnTambahEvaluasi').removeClass("btn-primary");
            $('#btnTambahEvaluasi').addClass("btn-danger");
            setTimeout(function() {
              $('#btnTambahEvaluasi .indicator-label').text("Simpan");
              $('#btnTambahEvaluasi').removeClass("btn-danger");
              $('#btnTambahEvaluasi').addClass("btn-primary");
            }, 3500);
          } else {
            if (result.update_evaluasi == true) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil membuat evaluasi data kontrak");
              $('#btnTambahEvaluasi .indicator-label').text("Berhasil");
              $('#btnTambahEvaluasi .indicator-label').show();
              $('#btnTambahEvaluasi .indicator-progress').hide();
              $('#btnTambahEvaluasi').removeClass("btn-primary");
              $('#btnTambahEvaluasi').addClass("btn-success");
              location.reload();
            }
          }
        },
        error: function(result) {
          // alert(result);
        }
      });
    });

    let evaluasiEditor; // Global var untuk menyimpan instance CKEditor

    $("#tabel_kontrak .btnEditEvaluasi").on('click', function() {
      var id = $(this).attr("data-id");
      $.ajax({
        url: '<?= base_url('karyawan/get_data?act=kontrak') ?>',
        type: 'POST',
        data: {
          id: id,
          kantor: kantor
        },
        dataType: 'json',
        success: function(kontrak) {
          if (kontrak) {
            $('#formEditEvaluasi input[name="id_kontrak"]').val(kontrak.id);
            $('#formEditEvaluasi select[name="edit_status_evaluasi"]').val(kontrak.status_evaluasi.toUpperCase()).trigger('change');
            $('#formEditEvaluasi textarea[name="hasil_evaluasi"]').val(kontrak.hasil_evaluasi);

            // Destroy editor jika sudah ada
            if (evaluasiEditor) {
              evaluasiEditor.destroy()
                .then(() => {
                  evaluasiEditor = null;
                  initEditor();
                });
            } else {
              initEditor();
            }

            function initEditor() {
              ClassicEditor
                .create(document.querySelector('#formEditEvaluasi textarea[name="hasil_evaluasi"]'))
                .then(editor => {
                  evaluasiEditor = editor;
                  console.log("CKEditor berhasil diinisialisasi");
                })
                .catch(error => {
                  // console.error(error);
                });
            }
            if (kontrak.file_evaluasi && kontrak.file_evaluasi.trim() !== '') {
              var doc = '';
              doc += '<div class="col-lg-9">';
              doc += '<a class="d-flex align-items-center mb-5" href="<?= base_url() ?>docload/' + kantor + '/evaluasi/' + kontrak.file_evaluasi + '">';
              doc += '<div class="symbol symbol-30px me-5">';
              doc += '<img alt="Icon" src="<?= base_url("assets/media/svg/files/pdf.svg") ?>">';
              doc += '</div>';
              doc += '<div class="fw-bold">';
              doc += '<span class="fs-6 fw-bolder text-dark text-hover-primary">' + kontrak.file_evaluasi + '</span>';
              doc += '</div>';
              doc += '</a>';
              doc += '</div>';
              $('#formEditEvaluasi #file_evaluasi').html(doc);
            }

            $("#modalEditEvaluasi").modal("show");
          }
        }
      });
    });

    $('#modalEditEvaluasi').on('hidden.bs.modal', function() {
      $('#formEditEvaluasi #file_evaluasi').html("");
      if (evaluasiEditor) {
        evaluasiEditor.destroy()
          .then(() => {
            evaluasiEditor = null;
          });
      }
    });

    $('#formEditEvaluasi').on('submit', function(evt) {
      evt.preventDefault();
      $('#btnEditEvaluasi .indicator-label').hide();
      $('#btnEditEvaluasi .indicator-progress').show();

      if (evaluasiEditor) {
        $('#formEditEvaluasi textarea[name="hasil_evaluasi"]').val(evaluasiEditor.getData());
      }

      var formdata = new FormData($(this)[0]);
      formdata.append("kantor", kantor);
      $.ajax({
        url: '<?= base_url() ?>karyawan/proses?act=update_evaluasi',
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
              $("#formEditEvaluasi #validation-" + notempty[i]).html('');
            }
            for (i = 0; i < name.length; i++) {
              $("#formEditEvaluasi #validation-" + name[i]).attr("class", "invalid-feedback");
              $("#formEditEvaluasi #validation-" + name[i]).html(result.errors[name[i]]);
              $("#formEditEvaluasi #validation-" + name[i]).attr("style", "display:block");
            }
            $('#btnEditEvaluasi .indicator-label').text("Cek Data Kembali");
            $('#btnEditEvaluasi .indicator-label').show();
            $('#btnEditEvaluasi .indicator-progress').hide();
            $('#btnEditEvaluasi').removeClass("btn-primary");
            $('#btnEditEvaluasi').addClass("btn-danger");
            setTimeout(function() {
              $('#btnEditEvaluasi .indicator-label').text("Simpan");
              $('#btnEditEvaluasi').removeClass("btn-danger");
              $('#btnEditEvaluasi').addClass("btn-primary");
            }, 3500);
          } else {
            if (result.update_evaluasi == true) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil edit data evaluasi kontrak");
              $('#btnEditEvaluasi .indicator-label').text("Berhasil, Mohon tunggu beberapa saat");
              $('#btnEditEvaluasi .indicator-label').show();
              $('#btnEditEvaluasi .indicator-progress').hide();
              $('#btnEditEvaluasi').removeClass("btn-primary");
              $('#btnEditEvaluasi').addClass("btn-success");
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