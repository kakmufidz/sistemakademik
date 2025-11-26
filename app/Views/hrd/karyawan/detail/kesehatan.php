<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<?php

use App\Models\Department;
use App\Models\Karyawan as ModelsKaryawan;
use App\Models\Pendidikan;
use App\Models\Riwayat_kerja;

$this->db = db_connect();
$this->request = service('request');
$getKey = $this->request->getGet('key');
?>
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
              <h3 class="fw-bolder m-0">Data Kesehatan Utama</h3>
            </div>
            <!--end::Card title-->
            <!--begin::Action-->
            <?php if (in_array($_SESSION['level'], ["superadmin"])) : ?>
              <div class="card-toolbar">
                <a href="javascript:;" class="btn btn-sm btn-primary align-self-center mx-2" id="btnEditBio">Edit</a>
              </div>
            <?php endif; ?>
            <!--end::Action-->
          </div>
          <!--begin::Card header-->
          <!--begin::Card body-->
          <div class="card-body p-9">
            <form id="formEditBiodata" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
              <!--begin::Row-->
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">NUK</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                  <span class="fw-bolder fs-6 text-gray-800"><?= $karyawan['usernuk'] ?></span>
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
                  <span class="fw-bolder fs-6 text-gray-800 textForm" id="text-nama"><?= $karyawan['user_nama_depan'] . " " . $karyawan['user_nama_belakang'] ?></span>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Row-->
              <!--begin::Input group-->
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">Department</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                  <span class="fw-bolder text-gray-800 fs-6 textForm" id="text-department"><?= $karyawan['department'] ?></span>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Input group-->
              <!--begin::Input group-->
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">Catatan Khusus</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                  <span class="fw-bolder text-gray-800 fs-6 textForm" id="text-catatan">Ini Contoh Catatan</span>
                </div>
                <!--end::Col-->
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
    <!--begin::Row-->
    <div class="row g-5 g-xxl-8">
      <!--begin::Pendidikan-->
      <div class="col-xl-12" id="tabKesehatan">
        <!--begin::List Widget 4-->
        <div class="card card-xl-stretch mb-5 mb-xl-8">
          <!--begin::Header-->
          <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
              <span class="card-label fw-bolder text-dark">Riwayat Cek kesehatan</span>
            </h3>
            <div class="card-toolbar">
              <a href="javascript:;" class="btn btn-sm btn-primary align-self-center mx-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-bs-toggle="modal" data-bs-target="#modalTambahKesehatan">
                <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr017.svg-->
                <span class="svg-icon svg-icon-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M11 13H7C6.4 13 6 12.6 6 12C6 11.4 6.4 11 7 11H11V13ZM17 11H13V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="black" />
                    <path d="M21 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H21C21.6 2 22 2.4 22 3V21C22 21.6 21.6 22 21 22ZM17 11H13V7C13 6.4 12.6 6 12 6C11.4 6 11 6.4 11 7V11H7C6.4 11 6 11.4 6 12C6 12.6 6.4 13 7 13H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="black" />
                  </svg>
                </span>
                <!--end::Svg Icon-->
                Input</a>
            </div>
          </div>
          <!--end::Header-->
          <!--begin::Body-->
          <div class="card-body pt-5">
            <?php $no = 1;
            foreach ($datakesehatan as $item): ?>
              <!--begin::Item-->
              <div class="d-flex align-items-sm-center mb-7">
                <!--begin::Symbol-->
                <div class="symbol symbol-30px me-5">
                  <span class="symbol-label">
                    <span class="align-self-center text-primary fw-bolder" alt=""><?= $no++ ?></span>
                  </span>
                </div>
                <!--end::Symbol-->
                <!--begin::Section-->
                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                  <div class="flex-grow-1 me-2">
                    <a href="javascript:;" class="text-gray-800 text-hover-primary fs-6 fw-bolder btnEdit" data-id="<?= $item["id"] ?>">Cek Kesehatan Tanggal <?= tgl_indo(date($item["tanggal"])) ?></a>
                    <span class="text-muted fw-bolder d-block fs-7"><?= $item["status_fit"]; ?></span>
                    <span class="text-muted fw-bolder d-block fs-7">Catatan: <?= excerpt($item["catatan"], 2); ?></span>
                    <span class="text-muted fw-bolder d-block fs-7">Rekomendasi: <?= excerpt($item["rekomendasi"], 2); ?></span>
                  </div>

                  <div class="d-flex justify-content-end flex-shrink-0">
                    <a href="javascript:;" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btnEdit" data-id="<?= $item["id"] ?>">
                      <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                      <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                          <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                          <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                        </svg>
                      </span>
                      <!--end::Svg Icon-->
                    </a>
                    <a href="javascript:;" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm btnHapus" data-id="<?= $item["id"] ?>">
                      <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                      <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                          <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                          <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                          <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                        </svg>
                      </span>
                      <!--end::Svg Icon-->
                    </a>
                  </div>
                </div>
                <!--end::Section-->
              </div>
              <!--end::Item-->
            <?php endforeach; ?>
          </div>
          <!--end::Body-->
        </div>
        <!--end::List Widget 4-->
      </div>
      <!--end::Pendidikan-->
    </div>
    <!--end::Row-->
  </div>
  <!--end::Container-->
</div>
<!--end::Post-->
<?= $this->endSection() ?>
<?= $this->section('modal') ?>
<div class="modal fade" id="modalTambahKesehatan" tabindex="-1" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog mw-950px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header">
        <!--begin::Modal title-->
        <h2>Form Input Cek Kesehatan</h2>
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
      <div class="modal-body">
        <form id="formTambahKesehatan" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
          <div class="row">
            <div class="col-lg-12">
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
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 mt-3 fw-bolder text-muted required">Tanggal Pemeriksaan</label>
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
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 mt-3 fw-bolder text-muted required">Petugas Pemeriksa</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                  <input class="form-control form-control-solid" type="text" placeholder="Petugas" name="petugas" id="petugas" required />
                  <div id="validation-petugas" class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Input group-->
            </div>
          </div>
          <div class="card card-xl-stretch mb-5 mb-xl-8 bg-light-primary border border-primary border-dashed">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
              <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder text-dark">Data Pemeriksaan Umum</span>
              </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
              <!--begin::Item-->
              <div class="row">
                <div class="col-lg-6">
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Tekanan Darah (Blood Pressure)</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Tekanan Darah" name="tekanan_darah" id="tekanan_darah" />
                      <div id="validation-tekanan_darah" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Denyut Nadi (Pulse)</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Denyut Nadi" name="nadi" id="nadi" />
                      <div id="validation-nadi" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Suhu Tubuh</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Suhu Tubuh" name="suhu" id="suhu" />
                      <div id="validation-suhu" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                </div>
                <div class="col-lg-6">
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Tinggi Badan</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Tinggi Badan" name="tinggi" id="tinggi" />
                      <div id="validation-tinggi" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Berat Badan</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Berat Badan" name="berat" id="berat" />
                      <div id="validation-berat" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">BMI (Body Mass Index)</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="BMI (Body Mass Index)" name="bmi" id="bmi" />
                      <div id="validation-bmi" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                </div>
              </div>
              <!--end::Item-->
            </div>
            <!--end::Body-->
          </div>
          <div class="card card-xl-stretch mb-5 mb-xl-8 bg-light-primary border border-primary border-dashed">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
              <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder text-dark">Pemeriksaan Laboratorium</span>
              </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
              <!--begin::Item-->
              <div class="row">
                <div class="col-lg-6">
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Kadar Gula Darah</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Gula Darah" name="gula_darah" id="gula_darah" />
                      <div id="validation-gula_darah" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Kolesterol</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Kolesterol" name="kolesterol" id="kolesterol" />
                      <div id="validation-kolesterol" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Asam Urat</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Asam Urat" name="asam_urat" id="asam_urat" />
                      <div id="validation-asam_urat" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                </div>
                <div class="col-lg-6">
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Fungsi Hati</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Fungsi Hati" name="fungsi_hati" id="fungsi_hati" />
                      <div id="validation-fungsi_hati" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Fungsi Ginjal</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Fungsi Ginjal" name="fungsi_ginjal" id="fungsi_ginjal" />
                      <div id="validation-fungsi_ginjal" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Hemoglobin / Darah Lengkap</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Hemoglobin / Darah Lengkap" name="hemoglobin" id="hemoglobin" />
                      <div id="validation-hemoglobin" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                </div>
              </div>
              <!--end::Item-->
            </div>
            <!--end::Body-->
          </div>
          <div class="card card-xl-stretch mb-5 mb-xl-8 bg-light-primary border border-primary border-dashed">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
              <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder text-dark">Pemeriksaan Khusus</span>
              </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
              <!--begin::Item-->
              <div class="row">
                <div class="col-lg-6">
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Tes Penglihatan</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Tes Penglihatan" name="tes_penglihatan" id="tes_penglihatan" />
                      <div id="validation-tes_penglihatan" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Tes Pendengaran</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Tes Pendengaran" name="tes_pendengaran" id="tes_pendengaran" />
                      <div id="validation-tes_pendengaran" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Rontgen / EKG / Spirometri</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Rontgen / EKG / Spirometri" name="rontgen" id="rontgen" />
                      <div id="validation-rontgen" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                </div>
              </div>
              <!--end::Item-->
            </div>
            <!--end::Body-->
          </div>
          <div class="card card-xl-stretch mb-5 mb-xl-8 bg-light-primary border border-primary border-dashed">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
              <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder text-dark">Catatan</span>
              </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
              <!--begin::Item-->
              <div class="row">
                <div class="col-lg-12">
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Catatan / Diagnosis Awal / Kesimpulan</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <textarea name="catatan" id="catatan"></textarea>
                      <div id="validation-catatan" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Rekomendasi Tindakan</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <textarea name="rekomendasi" id="rekomendasi"></textarea>
                      <div id="validation-rekomendasi" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted required">Status Fit to Work</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <select name="status_fit" id="status_fit" class="form-select form-select-solid form-select-lg fw-bold" required>
                        <option value=""></option>
                        <option value="FIT">FIT</option>
                        <option value="FIT DENGAN CATATAN">FIT DENGAN CATATAN</option>
                        <option value="TIDAK">TIDAK</option>
                      </select>
                      <div id="validation-status_fit" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                </div>
              </div>
              <!--end::Item-->
            </div>
            <!--end::Body-->
          </div>
          <div class="text-center mt-7">
            <a class="btn btn-light me-3" data-bs-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-primary" id="btnTambahKesehatan">
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

<div class="modal fade" id="modalEditKesehatan" tabindex="-1" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog mw-950px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header">
        <!--begin::Modal title-->
        <h2>Form Edit Cek Kesehatan</h2>
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
      <div class="modal-body">
        <form id="formEditKesehatan" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
          <div class="row">
            <div class="col-lg-12">
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">NUK</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                  <span class="fw-bolder fs-6 text-gray-800"><?= $karyawan['usernuk'] ?></span>
                  <input type="hidden" name="usernuk" value="<?= $karyawan['usernuk'] ?>" required>
                  <input type="hidden" name="id_data" value="" required>
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
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 mt-3 fw-bolder text-muted required">Tanggal Pemeriksaan</label>
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
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 mt-3 fw-bolder text-muted required">Petugas Pemeriksa</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                  <input class="form-control form-control-solid" type="text" placeholder="Petugas" name="edit_petugas" id="edit_petugas" required />
                  <div id="validation-edit_petugas" class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Input group-->
            </div>
          </div>
          <div class="card card-xl-stretch mb-5 mb-xl-8 border border-primary border-dashed">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
              <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder text-dark">Data Pemeriksaan Umum</span>
              </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
              <!--begin::Item-->
              <div class="row">
                <div class="col-lg-6">
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Tekanan Darah (Blood Pressure)</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Tekanan Darah" name="edit_tekanan_darah" id="edit_tekanan_darah" />
                      <div id="validation-edit_tekanan_darah" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Denyut Nadi (Pulse)</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Denyut Nadi" name="edit_nadi" id="edit_nadi" />
                      <div id="validation-edit_nadi" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Suhu Tubuh</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Suhu Tubuh" name="edit_suhu" id="edit_suhu" />
                      <div id="validation-edit_suhu" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                </div>
                <div class="col-lg-6">
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Tinggi Badan</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Tinggi Badan" name="edit_tinggi" id="edit_tinggi" />
                      <div id="validation-edit_tinggi" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Berat Badan</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Berat Badan" name="edit_berat" id="edit_berat" />
                      <div id="validation-edit_berat" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">BMI (Body Mass Index)</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="BMI (Body Mass Index)" name="edit_bmi" id="edit_bmi" />
                      <div id="validation-edit_bmi" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                </div>
              </div>
              <!--end::Item-->
            </div>
            <!--end::Body-->
          </div>
          <div class="card card-xl-stretch mb-5 mb-xl-8 border border-primary border-dashed">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
              <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder text-dark">Pemeriksaan Laboratorium</span>
              </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
              <!--begin::Item-->
              <div class="row">
                <div class="col-lg-6">
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Kadar Gula Darah</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Gula Darah" name="edit_gula_darah" id="edit_gula_darah" />
                      <div id="validation-edit_gula_darah" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Kolesterol</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Kolesterol" name="edit_kolesterol" id="edit_kolesterol" />
                      <div id="validation-edit_kolesterol" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Asam Urat</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Asam Urat" name="edit_asam_urat" id="edit_asam_urat" />
                      <div id="validation-edit_asam_urat" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                </div>
                <div class="col-lg-6">
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Fungsi Hati</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Fungsi Hati" name="edit_fungsi_hati" id="edit_fungsi_hati" />
                      <div id="validation-edit_fungsi_hati" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Fungsi Ginjal</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Fungsi Ginjal" name="edit_fungsi_ginjal" id="edit_fungsi_ginjal" />
                      <div id="validation-edit_fungsi_ginjal" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Hemoglobin / Darah Lengkap</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Hemoglobin / Darah Lengkap" name="edit_hemoglobin" id="edit_hemoglobin" />
                      <div id="validation-edit_hemoglobin" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                </div>
              </div>
              <!--end::Item-->
            </div>
            <!--end::Body-->
          </div>
          <div class="card card-xl-stretch mb-5 mb-xl-8 border border-primary border-dashed">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
              <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder text-dark">Pemeriksaan Khusus</span>
              </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
              <!--begin::Item-->
              <div class="row">
                <div class="col-lg-6">
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Tes Penglihatan</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Tes Penglihatan" name="edit_tes_penglihatan" id="edit_tes_penglihatan" />
                      <div id="validation-edit_tes_penglihatan" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Tes Pendengaran</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Tes Pendengaran" name="edit_tes_pendengaran" id="edit_tes_pendengaran" />
                      <div id="validation-edit_tes_pendengaran" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Rontgen / EKG / Spirometri</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <input class="form-control form-control-solid" type="text" placeholder="Rontgen / EKG / Spirometri" name="edit_rontgen" id="edit_rontgen" />
                      <div id="validation-edit_rontgen" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                </div>
              </div>
              <!--end::Item-->
            </div>
            <!--end::Body-->
          </div>
          <div class="card card-xl-stretch mb-5 mb-xl-8 border border-primary border-dashed">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
              <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder text-dark">Catatan</span>
              </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
              <!--begin::Item-->
              <div class="row">
                <div class="col-lg-12">
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Catatan / Diagnosis Awal / Kesimpulan</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <textarea name="edit_catatan" id="edit_catatan"></textarea>
                      <div id="validation-edit_catatan" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted">Rekomendasi Tindakan</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <textarea name="edit_rekomendasi" id="edit_rekomendasi"></textarea>
                      <div id="validation-edit_rekomendasi" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-3 mt-3 fw-bolder text-muted required">Status Fit to Work</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                      <select name="edit_status_fit" id="edit_status_fit" class="form-select form-select-solid form-select-lg fw-bold" required>
                        <option value=""></option>
                        <option value="FIT">FIT</option>
                        <option value="FIT DENGAN CATATAN">FIT DENGAN CATATAN</option>
                        <option value="TIDAK">TIDAK</option>
                      </select>
                      <div id="validation-edit_status_fit" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Input group-->
                </div>
              </div>
              <!--end::Item-->
            </div>
            <!--end::Body-->
          </div>
          <div class="text-center mt-7">
            <a class="btn btn-light me-3" data-bs-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-primary" id="btnEditKesehatan">
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
      var parent;
      var name = $(this).attr("name");
      parent = $(this).closest('form');
      if (name == "status_fit") {
        placeholder = "Pilih status";
        // parent = $(this).closest('.modal');
      }
      $(this).select2({
        placeholder: placeholder || "Pilih data...",
        allowClear: allowClear || false,
        multiple: multiple || false,
        dropdownParent: parent
      });
    });
  }
  $(document).ready(function() {
    select2form();

    $('#modalTambahKesehatan input[name="tanggal"]').daterangepicker({
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
    $('#modalEditKesehatan input[name="edit_tanggal"]').daterangepicker({
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

    ['catatan', 'rekomendasi'].forEach(name => {
      ClassicEditor
        .create(document.querySelector(`#formTambahKesehatan textarea[name="${name}"]`))
        .then(editor => {
          // console.log(`${name} editor ready`, editor);
        })
        .catch(error => {
          console.error(`Error init ${name} editor`, error);
        });
    });

    $('#formTambahKesehatan').on('submit', function(evt) {
      evt.preventDefault();
      $('#btnTambahKesehatan .indicator-label').hide();
      $('#btnTambahKesehatan .indicator-progress').show();
      var formdata = new FormData($(this)[0]);
      $.ajax({
        url: '<?= base_url() ?>karyawan/proses?act=tambah_kesehatan',
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
              $("#formTambahPendidikan #validation-" + notempty[i]).html('');
            }
            for (i = 0; i < name.length; i++) {
              $("#formTambahPendidikan #validation-" + name[i]).attr("class", "invalid-feedback");
              $("#formTambahPendidikan #validation-" + name[i]).html(result.errors[name[i]]);
              $("#formTambahPendidikan #validation-" + name[i]).attr("style", "display:block");
            }
            $('#btnTambahKesehatan .indicator-label').text("Cek Data Kembali");
            $('#btnTambahKesehatan .indicator-label').show();
            $('#btnTambahKesehatan .indicator-progress').hide();
            $('#btnTambahKesehatan').removeClass("btn-primary");
            $('#btnTambahKesehatan').addClass("btn-danger");
            setTimeout(function() {
              $('#btnTambahKesehatan .indicator-label').text("Simpan");
              $('#btnTambahKesehatan').removeClass("btn-danger");
              $('#btnTambahKesehatan').addClass("btn-primary");
            }, 3500);
          } else {
            if (result.insert == true) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil menambahkan data cek kesehatan");
              $('#btnTambahKesehatan .indicator-label').text("Berhasil");
              $('#btnTambahKesehatan .indicator-label').show();
              $('#btnTambahKesehatan .indicator-progress').hide();
              $('#btnTambahKesehatan').removeClass("btn-primary");
              $('#btnTambahKesehatan').addClass("btn-success");
              location.reload();
            }
          }
        },
        error: function(result) {
          // alert(result);
        }
      });
    });

    const editors = {}; // simpan semua instance editor
    ['edit_catatan', 'edit_rekomendasi'].forEach(name => {
      ClassicEditor
        .create(document.querySelector(`#formEditKesehatan textarea[name="${name}"]`))
        .then(editor => {
          editors[name] = editor; // simpan instance editor
          // kalau mau langsung isi value saat init:
          const value = document.querySelector(`#formEditKesehatan textarea[name="${name}"]`).dataset.value || '';
          editor.setData(value);
        })
        .catch(error => {
          console.error(`Error init ${name} editor`, error);
        });
    });

    // Event klik edit
    $("#tabKesehatan").on('click', ".btnEdit", function() {
      var id = $(this).attr("data-id");
      $.ajax({
        url: '<?= base_url('karyawan/get_data?act=kesehatan') ?>',
        type: 'POST',
        data: {
          id: id,
        },
        dataType: 'json',
        success: function(result) {
          if (result) {
            $('#formEditKesehatan input[name="id_data"]').val(result.id);
            const tanggal = moment(result.tanggal, 'YYYY-MM-DD').format('DD MMM YYYY');
            $('#formEditKesehatan input[name="edit_tanggal"]').data('daterangepicker').setStartDate(tanggal);
            $('#formEditKesehatan input[name="edit_petugas"]').val(result.petugas);
            $('#formEditKesehatan input[name="edit_tekanan_darah"]').val(result.tekanan_darah);
            $('#formEditKesehatan input[name="edit_nadi"]').val(result.nadi);
            $('#formEditKesehatan input[name="edit_suhu"]').val(result.suhu);
            $('#formEditKesehatan input[name="edit_tinggi"]').val(result.tinggi);
            $('#formEditKesehatan input[name="edit_berat"]').val(result.berat);
            $('#formEditKesehatan input[name="edit_bmi"]').val(result.bmi);
            $('#formEditKesehatan input[name="edit_gula_darah"]').val(result.gula_darah);
            $('#formEditKesehatan input[name="edit_kolesterol"]').val(result.kolesterol);
            $('#formEditKesehatan input[name="edit_asam_urat"]').val(result.asam_urat);
            $('#formEditKesehatan input[name="edit_fungsi_hati"]').val(result.fungsi_hati);
            $('#formEditKesehatan input[name="edit_fungsi_ginjal"]').val(result.fungsi_ginjal);
            $('#formEditKesehatan input[name="edit_hemoglobin"]').val(result.hemoglobin);
            $('#formEditKesehatan input[name="edit_tes_penglihatan"]').val(result.tes_penglihatan);
            $('#formEditKesehatan input[name="edit_tes_pendengaran"]').val(result.tes_pendengaran);
            $('#formEditKesehatan input[name="edit_rontgen"]').val(result.rontgen);
            $('#formEditKesehatan input[name="edit_catatan"]').val("<p>sasddasd</p>");
            editors['edit_catatan'].setData(result.catatan);
            editors['edit_rekomendasi'].setData(result.rekomendasi);
            $('#formEditKesehatan select[name="edit_status_fit"]').val(result.status_fit.toUpperCase()).trigger('change');
            $("#modalEditKesehatan").modal("show");
          }
        }
      });
    });

    $('#formEditKesehatan').on('submit', function(evt) {
      evt.preventDefault();
      $('#btnEditKesehatan .indicator-label').hide();
      $('#btnEditKesehatan .indicator-progress').show();
      var formdata = new FormData($(this)[0]);
      $.ajax({
        url: '<?= base_url() ?>karyawan/proses?act=update_kesehatan',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        success: function(result) {
          if (result.errors) {
            var name = Object.keys(result.errors);
            var notempty = result.notempty;
            for (i = 0; i < notempty.length; i++) {
              $("#formEditPendidikan #validation-" + notempty[i]).html('');
            }
            for (i = 0; i < name.length; i++) {
              $("#formEditPendidikan #validation-" + name[i])
                .attr("class", "invalid-feedback")
                .html(result.errors[name[i]])
                .attr("style", "display:block");
            }
            $('#btnEditKesehatan .indicator-label').text("Cek Data Kembali").show();
            $('#btnEditKesehatan .indicator-progress').hide();
            $('#btnEditKesehatan').removeClass("btn-primary").addClass("btn-danger");
            setTimeout(function() {
              $('#btnEditKesehatan .indicator-label').text("Simpan");
              $('#btnEditKesehatan').removeClass("btn-danger").addClass("btn-primary");
            }, 3500);
          } else if (result.update === true) {
            sessionStorage.setItem("alert", "show");
            sessionStorage.setItem("alert_title", "Berhasil mengedit data cek kesehatan");
            $('#btnEditKesehatan .indicator-label').text("Berhasil").show();
            $('#btnEditKesehatan .indicator-progress').hide();
            $('#btnEditKesehatan').removeClass("btn-primary").addClass("btn-success");
            location.reload();
          }
        },
        error: function(result) {
          console.error(result);
        }
      });
    });

    $("#tabKesehatan .btnHapus").on('click', function() {
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
            url: '<?= base_url('karyawan/proses?act=delete_kesehatan') ?>',
            type: 'POST',
            data: {
              id: id
            },
            dataType: 'JSON',
            success: function(result) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil hapus data kesehatan");
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