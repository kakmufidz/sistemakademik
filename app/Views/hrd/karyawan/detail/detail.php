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
$mkaryawan = new ModelsKaryawan();
$mpendidikan = new Pendidikan();
$mpekerjaan = new Riwayat_kerja();
$datasekolah = $this->db->table("pendidikan")->distinct()->select("tempat")->orderBy("tempat", "asc")->get()->getResultArray();
$datajurusan = $this->db->table("pendidikan")->distinct()->select("jurusan")->orderBy("jurusan", "asc")->get()->getResultArray();
$dataperusahaan = $this->db->table("riwayat_kerja")->distinct()->select("tempat")->orderBy("tempat", "asc")->get()->getResultArray();
$datajabatan = $this->db->table("riwayat_kerja")->distinct()->select("jabatan")->orderBy("jabatan", "asc")->get()->getResultArray();
$datajabataninternal = $mkaryawan->getJabatanInternal();

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
              <h3 class="fw-bolder m-0">Biodata</h3>
            </div>
            <!--end::Card title-->
            <!--begin::Action-->
            <?php if (in_array($_SESSION['level'], ["superadmin"])) : ?>
              <div class="card-toolbar">
                <a href="javascript:;" class="btn btn-sm btn-primary align-self-center mx-2" id="btnEditBio">Edit Biodata</a>
                <a href="javascript:;" class="btn btn-sm btn-danger align-self-center mx-2" id="btnHapusBio" data-id="<?= $karyawan["id"] ?>"><i class="bi bi-trash"></i> Hapus</a>
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
                  <input type="hidden" name="usernuk" value="<?= $karyawan['usernuk'] ?>" required>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Row-->
              <!--begin::Row-->
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">NIK</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                  <span class="fw-bolder fs-6 text-gray-800 textForm" id="text-nik"><?= $karyawan['nik'] ?? "-" ?></span>
                  <input type="text" class="form-control form-control-solid inputForm" placeholder="NIK" name="nik" value="<?= $karyawan['nik'] ?>" required>
                  <div id="validation-nik" class="fv-plugins-message-container invalid-feedback"></div>
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
                  <div class="row inputForm">
                    <div class="col-lg-6">
                      <input type="text" class="form-control form-control-solid" placeholder="Nama Depan" name="namaDepan" value="<?= $karyawan['user_nama_depan'] ?>" required>
                      <div id="validation-namaDepan" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <div class="col-lg-6">
                      <input type="text" class="form-control form-control-solid" placeholder="Nama Belakang" name="namaBelakang" value="<?= $karyawan['user_nama_belakang'] ?>">
                      <div id="validation-namaBelakang" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                  </div>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Row-->
              <!--begin::Input group-->
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">Tempat, Tanggal Lahir</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                  <span class="fw-bolder text-gray-800 fs-6 textForm" id="text-lahir"><?= $karyawan['tmpat_lahir'] . ", " . tgl_indo($karyawan['birthday']) ?></span>
                  <div class="row inputForm">
                    <div class="col-lg-6">
                      <input type="text" class="form-control form-control-solid" placeholder="Tempat Lahir" name="tempatLahir" value="<?= $karyawan['tmpat_lahir'] ?>" required>
                      <div id="validation-tempatLahir" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <div class="col-lg-6">
                      <div class="position-relative d-flex align-items-center">
                        <!--begin::Icon-->
                        <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                        <span class="svg-icon svg-icon-2 position-absolute mx-4">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black"></path>
                            <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black"></path>
                            <path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black"></path>
                          </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <!--end::Icon-->
                        <!--begin::Datepicker-->
                        <input class="form-control form-control-solid ps-12 flatpickr-input" placeholder="Pilih tanggal" name="tanggalLahir" id="tanggalLahir" type="text" required>
                        <!--end::Datepicker-->
                      </div>
                      <div id="validation-tanggalLahir" class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                  </div>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Input group-->
              <!--begin::Input group-->
              <div class="row">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">Jenis Kelamin</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                  <span class="fw-bolder text-gray-800 fs-6 textForm" id="text-jenisKelamin"><?= ($karyawan['jk'] == 1) ? "Laki-laki" : "Perempuan" ?></span>
                  <select name="jenisKelamin" id="jenisKelamin" class="form-select form-select-solid form-select-lg fw-bold mb-7 inputForm" required>
                    <option value=""></option>
                    <option value="1" <?= ($karyawan['jk'] == 1) ? "selected" : "" ?>>Laki-laki</option>
                    <option value="0" <?= ($karyawan['jk'] == 0) ? "selected" : "" ?>>Perempuan</option>
                  </select>
                  <div id="validation-jenisKelamin" class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Input group-->
              <!--begin::Row-->
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">Agama</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                  <span class="fw-bolder fs-6 text-gray-800 textForm" id="text-agama"><?= $karyawan['agama'] ?? "-" ?></span>
                  <input type="text" class="form-control form-control-solid inputForm" placeholder="Agama" name="agama" value="<?= $karyawan['agama'] ?>" required>
                  <div id="validation-agama" class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Row-->
              <!--begin::Input group-->
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">Golongan Darah</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                  <span class="fw-bolder text-gray-800 fs-6 textForm" id="text-golonganDarah"><?= $karyawan['golda'] ?? "-" ?></span>
                  <input type="text" class="form-control form-control-solid inputForm" placeholder="Golongan Darah" name="golonganDarah" value="<?= $karyawan['golda'] ?>">
                  <div id="validation-golonganDarah" class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Input group-->
              <!--begin::Input group-->
              <div class="row">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">Status Perkawinan</label>
                <!--begin::Label-->
                <!--begin::Label-->
                <div class="col-lg-8">
                  <span class="fw-bolder text-gray-800 fs-6 textForm" id="text-perkawinan"><?= $karyawan['status_perkawinan'] ?? "-" ?></span>
                  <select name="perkawinan" id="perkawinan" class="form-select form-select-solid form-select-lg fw-bold mb-7 inputForm" required>
                    <option></option>
                    <?php
                    $dataperkawinan = ["TK", "Menikah K0", "Menikah K1", "Menikah K2", "Menikah K3", "Menikah K4", "Menikah K5", "Menikah K6"];
                    foreach ($dataperkawinan as $perkawinan):
                      $select = ($karyawan['status_perkawinan'] == $perkawinan) ? "selected" : "";
                    ?>
                      <option value="<?= $perkawinan ?>" <?= $select ?>><?= $perkawinan ?></option>
                    <?php endforeach; ?>
                  </select>
                  <div id="validation-perkawinan" class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--begin::Label-->
              </div>
              <!--end::Input group-->
              <!--begin::Input group-->
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">No Telpon</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                  <span class="fw-bolder text-gray-800 fs-6 textForm" id="text-telp"><?= $karyawan['no_telp'] ?? "-" ?></span>
                  <input type="text" class="form-control form-control-solid inputForm" placeholder="Nomor Telphone" name="telp" value="<?= $karyawan['no_telp'] ?>">
                  <div id="validation-telp" class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Input group-->
              <!--begin::Input group-->
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">Email</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                  <span class="fw-bolder text-gray-800 fs-6 textForm" id="text-email"><?= $karyawan['email'] ?? "-" ?></span>
                  <input type="text" class="form-control form-control-solid inputForm" placeholder="Email" name="email" value="<?= $karyawan['email'] ?>">
                  <div id="validation-email" class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Input group-->
              <!--begin::Input group-->
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">Alamat</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                  <span class="fw-bolder text-gray-800 fs-6 textForm" id="text-alamat"><?= $karyawan['alamat'] ?></span>
                  <textarea class="form-control form-control-solid inputForm" rows="3" name="alamat" placeholder="Alamat" required><?= $karyawan['alamat'] ?></textarea>
                  <div id="validation-alamat" class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Input group-->
              <!--begin::Input group-->
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">NPWP</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                  <span class="fw-bolder text-gray-800 fs-6 textForm" id="text-npwp"><?= $karyawan['npwp'] ?? "-" ?></span>
                  <input type="text" class="form-control form-control-solid inputForm" placeholder="Nomor NPWP" name="npwp" value="<?= $karyawan['npwp'] ?>">
                  <div id="validation-npwp" class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Input group-->
              <!--begin::Input group-->
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">No BPJS</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                  <span class="fw-bolder text-gray-800 fs-6 textForm" id="text-bpjs"><?= $karyawan['no_bpjs'] ?></span>
                  <input type="text" class="form-control form-control-solid inputForm" placeholder="Nomor BPJS" name="bpjs" value="<?= $karyawan['no_bpjs'] ?>">
                  <div id="validation-bpjs" class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Input group-->
              <!--begin::Input group-->
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">No JHT</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                  <span class="fw-bolder text-gray-800 fs-6 textForm" id="text-jht"><?= $karyawan['no_jht'] ?></span>
                  <input type="text" class="form-control form-control-solid inputForm" placeholder="Nomor JHT" name="jht" value="<?= $karyawan['no_jht'] ?>">
                  <div id="validation-jht" class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Input group-->
              <!--begin::Input group-->
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">No Rekening Mandiri</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                  <span class="fw-bolder text-gray-800 fs-6 textForm" id="text-rekeningMandiri"><?= $karyawan['no_rek'] ?></span>
                  <input type="text" class="form-control form-control-solid inputForm" placeholder="Nomor Rekening Mandiri" name="rekeningMandiri" value="<?= $karyawan['no_rek'] ?>">
                  <div id="validation-rekeningMandiri" class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Input group-->
              <!--begin::Input group-->
              <div class="row">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">Department</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                  <span class="fw-bolder text-gray-800 fs-6 textForm" id="text-department"><?= $karyawan['department'] ?></span>
                  <select name="department" id="department" class="form-select form-select-solid form-select-lg fw-bold mb-7 inputForm" required>
                    <option value=""></option>
                    <?php
                    $mdepartment = new Department();
                    $department = $mdepartment->select("*")->get()->getResultArray();
                    foreach ($department as $dep):
                      $select = ($karyawan['department']  == $dep["nama"]) ? "selected" : "";
                    ?>
                      <option value="<?= $dep["id"] ?>" <?= $select ?>><?= $dep["nama"] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <div id="validation-department" class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Input group-->
              <!--begin::Input group-->
              <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-3 fw-bolder text-muted">Jabatan</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                  <span class="fw-bolder text-gray-800 fs-6 textForm" id="text-jabatan"><?= $karyawan['jabatan'] ?></span>
                  <select name="jabatankantor" id="jabatankantor" class="form-select form-select-solid form-select-lg fw-bold inputForm" required>
                    <option value=""></option>
                    <?php foreach ($datajabataninternal as $jabatan):
                      $select = (strtoupper($karyawan['jabatan'])  == strtoupper($jabatan)) ? "selected" : "";
                    ?>
                      <option value="<?= strtoupper($jabatan) ?>" <?= $select ?>><?= strtoupper($jabatan) ?></option>
                    <?php endforeach; ?>
                  </select>
                  <div id="validation-jabatan" class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->
              </div>
              <!--end::Input group-->
              <div class="text-center mb-7 inputForm">
                <a href="<?= base_url() ?>karyawan/detail?key=<?= $getKey ?>" class="btn btn-light me-3">Batal</a>
                <button type="submit" class="btn btn-primary" id="btnSubmit">
                  <span class="indicator-label">Simpan Biodata</span>
                  <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
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
      <div class="col-xl-6" id="tabPendidikan">
        <!--begin::List Widget 4-->
        <div class="card card-xl-stretch mb-5 mb-xl-8">
          <!--begin::Header-->
          <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
              <span class="card-label fw-bolder text-dark">Pendidikan</span>
            </h3>
            <div class="card-toolbar">
              <!--begin::Menu-->
              <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-bs-toggle="modal" data-bs-target="#modalTambahPendidikan">
                <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr017.svg-->
                <span class="svg-icon svg-icon-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M11 13H7C6.4 13 6 12.6 6 12C6 11.4 6.4 11 7 11H11V13ZM17 11H13V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="black" />
                    <path d="M21 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H21C21.6 2 22 2.4 22 3V21C22 21.6 21.6 22 21 22ZM17 11H13V7C13 6.4 12.6 6 12 6C11.4 6 11 6.4 11 7V11H7C6.4 11 6 11.4 6 12C6 12.6 6.4 13 7 13H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="black" />
                  </svg>
                </span>
                <!--end::Svg Icon-->
              </button>
            </div>
          </div>
          <!--end::Header-->
          <!--begin::Body-->
          <div class="card-body pt-5">
            <!--begin::Item-->
            <?php $nop = 1;
            foreach ($datapendidikan as $pendidikan):
              $jurusan = (!empty($pendidikan["jurusan"])) ? " (" . $pendidikan["jurusan"] . ")" : "";
            ?>
              <div class="d-flex align-items-sm-center mb-7">
                <!--begin::Symbol-->
                <div class="symbol symbol-30px me-5">
                  <span class="symbol-label">
                    <span class="align-self-center text-primary fw-bolder" alt="<?= $nop ?>"><?= $nop ?></span>
                  </span>
                </div>
                <!--end::Symbol-->
                <!--begin::Section-->
                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                  <div class="flex-grow-1 me-2">
                    <span class="text-gray-800 text-hover-primary fs-6 fw-bolder"><?= $pendidikan["tempat"] ?></span>
                    <span class="text-muted fw-bolder d-block fs-7"><?= $pendidikan["tahun"] . $jurusan ?></span>
                  </div>

                  <div class="d-flex justify-content-end flex-shrink-0">
                    <a href="javascript:;" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btnEdit" data-id="<?= $pendidikan["id"] ?>">
                      <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                      <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                          <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                          <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                        </svg>
                      </span>
                      <!--end::Svg Icon-->
                    </a>
                    <a href="javascript:;" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm btnHapus" data-id="<?= $pendidikan["id"] ?>">
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
            <?php $nop++;
            endforeach; ?>
            <!--end::Item-->
          </div>
          <!--end::Body-->
        </div>
        <!--end::List Widget 4-->
      </div>
      <!--end::Pendidikan-->
      <!--begin::Riwayat Kerja-->
      <div class="col-xl-6" id="tabPekerjaan">
        <!--begin::List Widget 4-->
        <div class="card card-xl-stretch mb-5 mb-xl-8">
          <!--begin::Header-->
          <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
              <span class="card-label fw-bolder text-dark">Riwayat Kerja</span>
            </h3>
            <div class="card-toolbar">
              <!--begin::Menu-->
              <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-bs-toggle="modal" data-bs-target="#modalTambahPekerjaan">
                <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr017.svg-->
                <span class="svg-icon svg-icon-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M11 13H7C6.4 13 6 12.6 6 12C6 11.4 6.4 11 7 11H11V13ZM17 11H13V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="black" />
                    <path d="M21 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H21C21.6 2 22 2.4 22 3V21C22 21.6 21.6 22 21 22ZM17 11H13V7C13 6.4 12.6 6 12 6C11.4 6 11 6.4 11 7V11H7C6.4 11 6 11.4 6 12C6 12.6 6.4 13 7 13H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="black" />
                  </svg>
                </span>
                <!--end::Svg Icon-->
              </button>
            </div>
          </div>
          <!--end::Header-->
          <!--begin::Body-->
          <div class="card-body pt-5">
            <!--begin::Item-->
            <?php $nor = 1;
            foreach ($datariwayatkerja as $riwayat):
              $jabatan = (!empty($riwayat["jabatan"])) ? " (" . $riwayat["jabatan"] . ")" : "";
            ?>
              <div class="d-flex align-items-sm-center mb-7">
                <!--begin::Symbol-->
                <div class="symbol symbol-30px me-5">
                  <span class="symbol-label">
                    <span class="align-self-center text-primary fw-bolder" alt="<?= $nor ?>"><?= $nor ?></span>
                  </span>
                </div>
                <!--end::Symbol-->
                <!--begin::Section-->
                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                  <div class="flex-grow-1 me-2">
                    <span class="text-gray-800 text-hover-primary fs-6 fw-bolder"><?= $riwayat["tempat"] ?></span>
                    <span class="text-muted fw-bolder d-block fs-7"><?= $riwayat["tahun"] . $jabatan ?></span>
                  </div>

                  <div class="d-flex justify-content-end flex-shrink-0">
                    <a href="javascript:;" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btnEdit" data-id="<?= $riwayat["id"] ?>">
                      <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                      <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                          <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                          <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                        </svg>
                      </span>
                      <!--end::Svg Icon-->
                    </a>
                    <a href="javascript:;" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm btnHapus" data-id="<?= $riwayat["id"] ?>">
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
            <?php $nor++;
            endforeach; ?>
            <!--end::Item-->
          </div>
          <!--end::Body-->
        </div>
        <!--end::List Widget 4-->
      </div>
      <!--end::Riwayat Kerja-->
    </div>
    <!--end::Row-->
  </div>
  <!--end::Container-->
</div>
<!--end::Post-->
<?= $this->endSection() ?>
<?= $this->section('modal') ?>
<div class="modal fade" id="modalTambahPendidikan" tabindex="-1" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog mw-850px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header">
        <!--begin::Modal title-->
        <h2>Tambah Pendidikan</h2>
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
        <form id="formTambahPendidikan" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
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
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Tahun</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <input type="text" class="form-control form-control-solid" placeholder="Masukkan tahun masuk - lulus" name="tahun" required>
              <div id="validation-tahun" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Tempat Sekolah</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="sekolah" id="sekolah" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="sekolah-lain">SEKOLAH LAINNYA</option>
                <?php foreach ($datasekolah as $sekolahan) : ?>
                  <option value="<?= strtoupper($sekolahan["tempat"]) ?>"><?= strtoupper($sekolahan["tempat"]) ?></option>
                <?php endforeach; ?>
              </select>
              <div id="showsekolah"></div>
              <div id="validation-sekolah" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Jurusan</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="jurusan" id="jurusan" class="form-select form-select-solid form-select-lg fw-bold">
                <option value=""></option>
                <option value="jurusan-lain">JURUSAN LAINNYA</option>
                <?php foreach ($datajurusan as $jurusan) : ?>
                  <option value="<?= strtoupper($jurusan["jurusan"]) ?>"><?= strtoupper($jurusan["jurusan"]) ?></option>
                <?php endforeach; ?>
              </select>
              <div id="showjurusan"></div>
              <div id="validation-jurusan" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--end::Input group-->
          <div class="text-center mt-7">
            <a class="btn btn-light me-3" data-bs-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-primary" id="btnTambahSekolah">
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

<div class="modal fade" id="modalEditPendidikan" tabindex="-1" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog mw-850px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header">
        <!--begin::Modal title-->
        <h2>Edit Data Pendidikan</h2>
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
        <form id="formEditPendidikan" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
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
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Tahun</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <div id="showtahun"></div>
              <div id="validation-tahun" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Tempat Sekolah</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <div id="showtempat"></div>
              <div id="validation-sekolah" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Jurusan</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <div id="showjurusan"></div>
              <div id="validation-jurusan" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--end::Input group-->
          <div class="text-center mt-7">
            <a class="btn btn-light me-3" data-bs-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-primary" id="btnEditSekolah">
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

<div class="modal fade" id="modalTambahPekerjaan" tabindex="-1" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog modal-dialog-centered mw-900px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header">
        <!--begin::Modal title-->
        <h2>Tambah Riwayat Pekerjaan</h2>
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
        <form id="formTambahPekerjaan" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
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
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Tahun</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <input type="text" class="form-control form-control-solid" placeholder="Masukkan tahun" name="tahun" required>
              <div id="validation-tahun" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Perusahaan</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <select name="perusahaan" id="perusahaan" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="perusahaan-lain">PERUSAHAAN LAINNYA</option>
                <?php foreach ($dataperusahaan as $perusahaanan) : ?>
                  <option value="<?= strtoupper($perusahaanan["tempat"]) ?>"><?= strtoupper($perusahaanan["tempat"]) ?></option>
                <?php endforeach; ?>
              </select>
              <div id="showperusahaan"></div>
              <div id="validation-perusahaan" class="fv-plugins-message-container invalid-feedback"></div>
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
              <select name="jabatan" id="jabatan" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="jabatan-lain">JABATAN LAINNYA</option>
                <?php foreach ($datajabatan as $jabatan) : ?>
                  <option value="<?= strtoupper($jabatan["jabatan"]) ?>"><?= strtoupper($jabatan["jabatan"]) ?></option>
                <?php endforeach; ?>
              </select>
              <div id="showjabatan"></div>
              <div id="validation-jabatan" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--end::Input group-->
          <div class="text-center mt-7">
            <a class="btn btn-light me-3" data-bs-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-primary" id="btnTambahPekerjaan">
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

<div class="modal fade" id="modalEditPekerjaan" tabindex="-1" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog mw-850px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header">
        <!--begin::Modal title-->
        <h2>Edit Data Pekerjaan</h2>
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
        <form id="formEditPekerjaan" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
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
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Tahun</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <div id="showtahun"></div>
              <div id="validation-tahun" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Perusahaan</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <div id="showperusahaan"></div>
              <div id="validation-perusahaan" class="fv-plugins-message-container invalid-feedback"></div>
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
              <div id="showjabatan"></div>
              <div id="validation-jabatan" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--end::Input group-->
          <div class="text-center mt-7">
            <a class="btn btn-light me-3" data-bs-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-primary" id="btnEditPekerjaan">
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
  function select2form() {
    $('.form-select').each(function() {
      var placeholder;
      var allowClear;
      var multiple;
      var name = $(this).attr("name");
      if (name == "department") {
        placeholder = "Pilih Department";
      } else if (name == "jabatan") {
        placeholder = "Pilih jabatan";
      } else if (name == "jenisKelamin") {
        placeholder = "Pilih jenis kelamin";
      } else if (name == "sekolah") {
        placeholder = "Pilih sekolahan";
      } else if (name == "perusahaan") {
        placeholder = "Pilih perusahaan";
      } else if (name == "jurusan") {
        placeholder = "Pilih jurusan";
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

    $("#formEditBiodata .inputForm").css("display", "none");

    var tanggal_lahir = ("<?= $karyawan['birthday'] ?>" == "") ? "<?= date("Y-m-d") ?>" : "<?= $karyawan['birthday'] ?>";

    $("#tanggalLahir").daterangepicker({
      startDate: moment(tanggal_lahir, 'YYYY-MM-DD'),
      locale: {
        format: 'DD MMM YYYY'
      },
      singleDatePicker: true,
      placeholder: {
        text: "Pilih tanggal"
      },
      showDropdowns: true,
      minYear: 1950,
      maxYear: parseInt(moment().format("Y-m-d"), 10)
    });

    $('#btnEditBio').on('click', function() {
      $("#formEditBiodata .inputForm").css("display", "block");
      $("#btnsubmit").css("display", "block");
      $("#formEditBiodata .textForm").css("display", "none");
      $("#btnEditBio").css("display", "none");
    });

    $('#formEditBiodata').on('submit', function(evt) {
      evt.preventDefault();
      $('#btnSubmit .indicator-label').hide();
      $('#btnSubmit .indicator-progress').show();
      var formdata = new FormData($(this)[0]);
      $.ajax({
        url: '<?= base_url() ?>karyawan/proses?act=edit_biodata',
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
              $("#formEditBiodata #validation-" + notempty[i]).html('');
            }
            for (i = 0; i < name.length; i++) {
              $("#formEditBiodata #validation-" + name[i]).attr("class", "invalid-feedback");
              $("#formEditBiodata #validation-" + name[i]).html(result.errors[name[i]]);
              $("#formEditBiodata #validation-" + name[i]).attr("style", "display:block");
            }
            $('#btnSubmit .indicator-label').text("Cek Data Kembali");
            $('#btnSubmit .indicator-label').show();
            $('#btnSubmit .indicator-progress').hide();
            $('#btnSubmit').removeClass("btn-primary");
            $('#btnSubmit').addClass("btn-danger");
            setTimeout(function() {
              $('#btnSubmit .indicator-label').text("Edit Biodata");
              $('#btnSubmit').removeClass("btn-danger");
              $('#btnSubmit').addClass("btn-primary");
            }, 3500);
          } else {
            if (result.proses == true) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil edit biodata");
              $('#btnSubmit .indicator-label').text("Berhasil");
              $('#btnSubmit .indicator-label').show();
              $('#btnSubmit .indicator-progress').hide();
              $('#btnSubmit').removeClass("btn-primary");
              $('#btnSubmit').addClass("btn-success");
              location.reload();
            }
          }
        },
        error: function(result) {
          // alert(result);
        }
      });
    });

    // Javascript Pendidikan
    $('#formTambahPendidikan').on('change', 'select[name="sekolah"]', function() {
      var select = $(this).val();
      $('#formTambahPendidikan input[name="sekolah_lain"]').remove();
      if (select === 'sekolah-lain') {
        $('#formTambahPendidikan #showsekolah').append(`<input type="text" name="sekolah_lain" class="form-control form-control-solid mt-2" placeholder="Masukkan nama sekolah lain" required />`);
      }
    });

    $('#formTambahPendidikan').on('change', 'select[name="jurusan"]', function() {
      var select = $(this).val();
      $('#formTambahPendidikan input[name="jurusan_lain"]').remove();
      if (select === 'jurusan-lain') {
        $('#formTambahPendidikan #showjurusan').append(`<input type="text" name="jurusan_lain" class="form-control form-control-solid mt-2" placeholder="Masukkan nama jurusan lain" required />`);
      }
    });

    $('#formTambahPendidikan').on('submit', function(evt) {
      evt.preventDefault();
      $('#btnTambahSekolah .indicator-label').hide();
      $('#btnTambahSekolah .indicator-progress').show();
      var formdata = new FormData($(this)[0]);
      $.ajax({
        url: '<?= base_url() ?>karyawan/proses?act=tambah_sekolah',
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
            $('#btnTambahSekolah .indicator-label').text("Cek Data Kembali");
            $('#btnTambahSekolah .indicator-label').show();
            $('#btnTambahSekolah .indicator-progress').hide();
            $('#btnTambahSekolah').removeClass("btn-primary");
            $('#btnTambahSekolah').addClass("btn-danger");
            setTimeout(function() {
              $('#btnTambahSekolah .indicator-label').text("Simpan");
              $('#btnTambahSekolah').removeClass("btn-danger");
              $('#btnTambahSekolah').addClass("btn-primary");
            }, 3500);
          } else {
            if (result.insert == true) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil menambahkan data sekolah");
              $('#btnTambahSekolah .indicator-label').text("Berhasil");
              $('#btnTambahSekolah .indicator-label').show();
              $('#btnTambahSekolah .indicator-progress').hide();
              $('#btnTambahSekolah').removeClass("btn-primary");
              $('#btnTambahSekolah').addClass("btn-success");
              location.reload();
            }
          }
        },
        error: function(result) {
          // alert(result);
        }
      });
    });

    $("#tabPendidikan .btnEdit").on('click', function() {
      var id = $(this).attr("data-id");
      $.ajax({
        url: '<?= base_url('karyawan/get_data?act=pendidikan') ?>',
        type: 'POST',
        data: {
          id: id,
        },
        dataType: 'json', // PENTING
        success: function(result) {
          if (result) {
            const pendidikan = result.pendidikan;
            const datasekolah = result.datasekolah;
            const datajurusan = result.datajurusan;
            var bersekolah = pendidikan.tempat.toUpperCase();
            var berjurusan = (pendidikan.jurusan) ? pendidikan.jurusan.toUpperCase() : "";
            var bertahun = (pendidikan.tahun) ? pendidikan.tahun.toUpperCase() : "";

            var tahun = '<input type="text" class="form-control form-control-solid inputForm" placeholder="Masukkan tahun masuk - lulus" name="tahun" value="' + bertahun + '" required>';
            tahun += '<input type="hidden" name="id" value="' + pendidikan.id + '" required>';

            var sekolah = '<select name="sekolah" id="sekolah" class="form-select form-select-solid form-select-lg fw-bold" required>';
            sekolah += '<option value=""></option>';
            for (let i = 0; i < datasekolah.length; i++) {
              var sekolahan = datasekolah[i].tempat.toUpperCase();
              var select = (sekolahan === bersekolah) ? "selected" : "";
              sekolah += '<option value="' + sekolahan + '" ' + select + '>' + sekolahan + '</option>';
            }
            sekolah += '<option value="sekolah-lain">SEKOLAH LAINNYA</option>';
            sekolah += '</select>';

            var jurusan = '<select name="jurusan" id="jurusan" class="form-select form-select-solid form-select-lg fw-bold">';
            jurusan += '<option value=""></option>';
            for (let i = 0; i < datajurusan.length; i++) {
              var jurusanan = (datajurusan[i].jurusan) ? datajurusan[i].jurusan.toUpperCase() : "";
              var select = (jurusanan === berjurusan) ? "selected" : "";
              jurusan += '<option value="' + jurusanan + '" ' + select + '>' + jurusanan + '</option>';
            }
            jurusan += '<option value="jurusan-lain">JURUSAN LAINNYA</option>';
            jurusan += '</select>';

            $("#formEditPendidikan #showtahun").html(tahun);
            $("#formEditPendidikan #showtempat").html(sekolah);
            $("#formEditPendidikan #showjurusan").html(jurusan);
            $("#modalEditPendidikan").modal("show");
          }
        }
      });
    });

    $("#modalEditPendidikan").on("shown.bs.modal", function() {
      $('#formEditPendidikan select[name="sekolah"]').select2({
        placeholder: "Pilih tempat sekolah",
        dropdownParent: $('#modalEditPendidikan')
      });
      $('#formEditPendidikan select[name="jurusan"]').select2({
        placeholder: "Pilih jurusan",
        dropdownParent: $('#modalEditPendidikan')
      });
    });

    $('#formEditPendidikan').on('change', 'select[name="sekolah"]', function() {
      var select = $(this).val();
      $('#formEditPendidikan input[name="sekolah_lain"]').remove();
      if (select === 'sekolah-lain') {
        $('#formEditPendidikan #showtempat').append(`<input type="text" name="sekolah_lain" class="form-control form-control-solid mt-2" placeholder="Masukkan nama sekolah lain" required />`);
      }
    });

    $('#formEditPendidikan').on('change', 'select[name="jurusan"]', function() {
      var select = $(this).val();
      $('#formEditPendidikan input[name="jurusan_lain"]').remove();
      if (select === 'jurusan-lain') {
        $('#formEditPendidikan #showjurusan').append(`<input type="text" name="jurusan_lain" class="form-control form-control-solid mt-2" placeholder="Masukkan nama jurusan lain" required />`);
      }
    });

    $('#formEditPendidikan').on('submit', function(evt) {
      evt.preventDefault();
      $('#btnEditSekolah .indicator-label').hide();
      $('#btnEditSekolah .indicator-progress').show();
      var formdata = new FormData($(this)[0]);
      $.ajax({
        url: '<?= base_url() ?>karyawan/proses?act=update_sekolah',
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
              $("#formEditPendidikan #validation-" + notempty[i]).html('');
            }
            for (i = 0; i < name.length; i++) {
              $("#formEditPendidikan #validation-" + name[i]).attr("class", "invalid-feedback");
              $("#formEditPendidikan #validation-" + name[i]).html(result.errors[name[i]]);
              $("#formEditPendidikan #validation-" + name[i]).attr("style", "display:block");
            }
            $('#btnEditSekolah .indicator-label').text("Cek Data Kembali");
            $('#btnEditSekolah .indicator-label').show();
            $('#btnEditSekolah .indicator-progress').hide();
            $('#btnEditSekolah').removeClass("btn-primary");
            $('#btnEditSekolah').addClass("btn-danger");
            setTimeout(function() {
              $('#btnEditSekolah .indicator-label').text("Simpan");
              $('#btnEditSekolah').removeClass("btn-danger");
              $('#btnEditSekolah').addClass("btn-primary");
            }, 3500);
          } else {
            if (result.proses == true) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil edit data sekolah");
              $('#btnEditSekolah .indicator-label').text("Berhasil");
              $('#btnEditSekolah .indicator-label').show();
              $('#btnEditSekolah .indicator-progress').hide();
              $('#btnEditSekolah').removeClass("btn-primary");
              $('#btnEditSekolah').addClass("btn-success");
              location.reload();
            }
          }
        },
        error: function(result) {
          // alert(result);
        }
      });
    });

    $("#tabPendidikan .btnHapus").on('click', function() {
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
            url: '<?= base_url('karyawan/proses?act=delete_sekolah') ?>',
            type: 'POST',
            data: {
              id: id
            },
            dataType: 'JSON',
            success: function(result) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil hapus data sekolah");
              sessionStorage.setItem("alert_icon", "warning");
              location.reload();
            },
          });
        }
      });
    });

    // Javascript Riwayat Pekerjaan
    $('#formTambahPekerjaan').on('change', 'select[name="perusahaan"]', function() {
      var select = $(this).val();
      $('#formTambahPekerjaan input[name="perusahaan_lain"]').remove();
      if (select === 'perusahaan-lain') {
        $('#formTambahPekerjaan #showperusahaan').append(`<input type="text" name="perusahaan_lain" class="form-control form-control-solid mt-2" placeholder="Masukkan perusahaan lain" required />`);
      }
    });

    $('#formTambahPekerjaan').on('change', 'select[name="jabatan"]', function() {
      var select = $(this).val();
      $('#formTambahPekerjaan input[name="jabatan_lain"]').remove();
      if (select === 'jabatan-lain') {
        $('#formTambahPekerjaan #showjabatan').append(`<input type="text" name="jabatan_lain" class="form-control form-control-solid mt-2" placeholder="Masukkan jabatan lain" required />`);
      }
    });

    $('#formTambahPekerjaan').on('submit', function(evt) {
      evt.preventDefault();
      $('#btnTambahPekerjaan .indicator-label').hide();
      $('#btnTambahPekerjaan .indicator-progress').show();
      var formdata = new FormData($(this)[0]);
      $.ajax({
        url: '<?= base_url() ?>karyawan/proses?act=tambah_pekerjaan',
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
              $("#formTambahPekerjaan #validation-" + notempty[i]).html('');
            }
            for (i = 0; i < name.length; i++) {
              $("#formTambahPekerjaan #validation-" + name[i]).attr("class", "invalid-feedback");
              $("#formTambahPekerjaan #validation-" + name[i]).html(result.errors[name[i]]);
              $("#formTambahPekerjaan #validation-" + name[i]).attr("style", "display:block");
            }
            $('#btnTambahPekerjaan .indicator-label').text("Cek Data Kembali");
            $('#btnTambahPekerjaan .indicator-label').show();
            $('#btnTambahPekerjaan .indicator-progress').hide();
            $('#btnTambahPekerjaan').removeClass("btn-primary");
            $('#btnTambahPekerjaan').addClass("btn-danger");
            setTimeout(function() {
              $('#btnTambahPekerjaan .indicator-label').text("Simpan");
              $('#btnTambahPekerjaan').removeClass("btn-danger");
              $('#btnTambahPekerjaan').addClass("btn-primary");
            }, 3500);
          } else {
            if (result.insert == true) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil menambahkan data pekerjaan");
              $('#btnTambahPekerjaan .indicator-label').text("Berhasil");
              $('#btnTambahPekerjaan .indicator-label').show();
              $('#btnTambahPekerjaan .indicator-progress').hide();
              $('#btnTambahPekerjaan').removeClass("btn-primary");
              $('#btnTambahPekerjaan').addClass("btn-success");
              location.reload();
            }
          }
        },
        error: function(result) {
          // alert(result);
        }
      });
    });

    $("#tabPekerjaan .btnEdit").on('click', function() {
      var id = $(this).attr("data-id");
      $.ajax({
        url: '<?= base_url('karyawan/get_data?act=pekerjaan') ?>',
        type: 'POST',
        data: {
          id: id,
        },
        dataType: 'json', // PENTING
        success: function(result) {
          if (result) {
            const pekerjaan = result.pekerjaan;
            const dataperusahaan = result.dataperusahaan;
            const datajabatan = result.datajabatan;
            var tempatkerja = pekerjaan.tempat.toUpperCase();
            var jabatankerja = (pekerjaan.jabatan) ? pekerjaan.jabatan.toUpperCase() : "";
            var tahunkerja = (pekerjaan.tahun) ? pekerjaan.tahun.toUpperCase() : "";

            var tahun = '<input type="text" class="form-control form-control-solid inputForm" placeholder="Masukkan tahun masuk - lulus" name="tahun" value="' + tahunkerja + '" required>';
            tahun += '<input type="hidden" name="id" value="' + pekerjaan.id + '" required>';

            var selectperusahaan = '<select name="perusahaan" id="perusahaan" class="form-select form-select-solid form-select-lg fw-bold" required>';
            selectperusahaan += '<option value=""></option>';
            for (let i = 0; i < dataperusahaan.length; i++) {
              var perusahaan = dataperusahaan[i].tempat.toUpperCase();
              var select = (perusahaan === tempatkerja) ? "selected" : "";
              selectperusahaan += '<option value="' + perusahaan + '" ' + select + '>' + perusahaan + '</option>';
            }
            selectperusahaan += '<option value="perusahaan-lain">PERUSAHAAN LAINNYA</option>';
            selectperusahaan += '</select>';

            var selectjabatan = '<select name="jabatan" id="jabatan" class="form-select form-select-solid form-select-lg fw-bold">';
            selectjabatan += '<option value=""></option>';
            for (let i = 0; i < datajabatan.length; i++) {
              var jabatan = (datajabatan[i].jabatan) ? datajabatan[i].jabatan.toUpperCase() : "";
              var select = (jabatan === jabatankerja) ? "selected" : "";
              selectjabatan += '<option value="' + jabatan + '" ' + select + '>' + jabatan + '</option>';
            }
            selectjabatan += '<option value="jabatan-lain">JABATAN LAINNYA</option>';
            selectjabatan += '</select>';

            $("#formEditPekerjaan #showtahun").html(tahun);
            $("#formEditPekerjaan #showperusahaan").html(selectperusahaan);
            $("#formEditPekerjaan #showjabatan").html(selectjabatan);
            $("#modalEditPekerjaan").modal("show");
          }
        }
      });
    });

    $("#modalEditPekerjaan").on("shown.bs.modal", function() {
      $('#formEditPekerjaan select[name="perusahaan"]').select2({
        placeholder: "Pilih perusahaan",
        dropdownParent: $('#modalEditPekerjaan')
      });
      $('#formEditPekerjaan select[name="jabatan"]').select2({
        placeholder: "Pilih jabatan",
        dropdownParent: $('#modalEditPekerjaan')
      });
    });

    $('#formEditPekerjaan').on('change', 'select[name="perusahaan"]', function() {
      var select = $(this).val();
      $('#formEditPekerjaan input[name="perusahaan_lain"]').remove();
      if (select === 'perusahaan-lain') {
        $('#formEditPekerjaan #showperusahaan').append(`<input type="text" name="perusahaan_lain" class="form-control form-control-solid mt-2" placeholder="Masukkan  perusahaan lain" required />`);
      }
    });

    $('#formEditPekerjaan').on('change', 'select[name="jabatan"]', function() {
      var select = $(this).val();
      $('#formEditPekerjaan input[name="jabatan_lain"]').remove();
      if (select === 'jabatan-lain') {
        $('#formEditPekerjaan #showjabatan').append(`<input type="text" name="jabatan_lain" class="form-control form-control-solid mt-2" placeholder="Masukkan jabatan lain" required />`);
      }
    });

    $('#formEditPekerjaan').on('submit', function(evt) {
      evt.preventDefault();
      $('#btnEditPekerjaan .indicator-label').hide();
      $('#btnEditPekerjaan .indicator-progress').show();
      var formdata = new FormData($(this)[0]);
      $.ajax({
        url: '<?= base_url() ?>karyawan/proses?act=update_pekerjaan',
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
              $("#formEditPekerjaan #validation-" + notempty[i]).html('');
            }
            for (i = 0; i < name.length; i++) {
              $("#formEditPekerjaan #validation-" + name[i]).attr("class", "invalid-feedback");
              $("#formEditPekerjaan #validation-" + name[i]).html(result.errors[name[i]]);
              $("#formEditPekerjaan #validation-" + name[i]).attr("style", "display:block");
            }
            $('#btnEditPekerjaan .indicator-label').text("Cek Data Kembali");
            $('#btnEditPekerjaan .indicator-label').show();
            $('#btnEditPekerjaan .indicator-progress').hide();
            $('#btnEditPekerjaan').removeClass("btn-primary");
            $('#btnEditPekerjaan').addClass("btn-danger");
            setTimeout(function() {
              $('#btnEditPekerjaan .indicator-label').text("Simpan");
              $('#btnEditPekerjaan').removeClass("btn-danger");
              $('#btnEditPekerjaan').addClass("btn-primary");
            }, 3500);
          } else {
            if (result.proses == true) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil edit data pekerjaan");
              $('#btnEditPekerjaan .indicator-label').text("Berhasil");
              $('#btnEditPekerjaan .indicator-label').show();
              $('#btnEditPekerjaan .indicator-progress').hide();
              $('#btnEditPekerjaan').removeClass("btn-primary");
              $('#btnEditPekerjaan').addClass("btn-success");
              location.reload();
            }
          }
        },
        error: function(result) {
          // alert(result);
        }
      });
    });

    $("#tabPekerjaan .btnHapus").on('click', function() {
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
            url: '<?= base_url('karyawan/proses?act=delete_pekerjaan') ?>',
            type: 'POST',
            data: {
              id: id
            },
            dataType: 'JSON',
            success: function(result) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil menghapus data pekerjaan");
              sessionStorage.setItem("alert_icon", "warning");
              location.reload();
            },
          });
        }
      });
    });

    $("#btnHapusBio").on('click', function() {
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
            url: '<?= base_url('karyawan/proses?act=delete_karyawan') ?>',
            type: 'POST',
            data: {
              id: id
            },
            dataType: 'JSON',
            success: function(result) {
              if (result.delete == true) {
                sessionStorage.setItem("alert", "show");
                sessionStorage.setItem("alert_title", "Berhasil menghapus data pekerjaan");
                sessionStorage.setItem("alert_icon", "warning");
                const kantor = "<?= $kantor ?>";
                const url = '<?= base_url() ?>karyawan/' + kantor;
                window.location.href = url;
              }
            },
          });
        }
      });
    });
  });
</script>
<?= $this->endSection() ?>