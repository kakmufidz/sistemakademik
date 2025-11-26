<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<?php

use App\Models\Department;
use App\Models\Karyawan as ModelsKaryawan;

$mkaryawan = new ModelsKaryawan();
$url = urlaktif();
$kantor = $url[4];
//Membuat NUK terbaru
$data = $mkaryawan->select("usernuk")->where(["kantor" => ucfirst(strtolower($kantor)), "deleted_at" => null])->get()->getResultArray();
$maxNumber = 0;
foreach ($data as $item) {
  $parts = explode('-', $item['usernuk']);
  if (isset($parts[1])) {
    $number = (int) $parts[1];
    if ($number > $maxNumber) {
      $maxNumber = $number;
    }
  }
}

$nextNumber = $maxNumber + 1;
$nextNumberFormatted = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

// Format hasil dengan tanggal hari ini
$tanggal = date('dmy'); // contoh: 280725
$usernukBaru = $tanggal . '-' . $nextNumberFormatted;

$datajabataninternal = $mkaryawan->getJabatanInternal();
?>
<div class="post d-flex flex-column-fluid">
  <!--begin::Container-->
  <div class="container-xxl">
    <!--begin::Row-->
    <div class="card mb-5 mb-xl-10">
      <!--begin::Card header-->
      <div class="card-header mt-5">
        <!--begin::Card title-->
        <div class="card-title flex-column">
          <h3 class="fw-bolder mb-1">Data Karyawan <?= ucfirst(strtolower($kantor)) ?></h3>
        </div>
        <!--end::Card title-->
      </div>
      <!--end::Card header-->
      <div class="card-body pt-0">
        <div class="container mt-4">
          <div class="row mb-6 align-items-center">
            <!--begin::Label-->
            <label class="col-lg-2 col-md-2 col-form-label required fw-bolder fs-5 mb-3">Kategori</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-4 col-md-4 mb-5">
              <select name="kategori" id="kategori" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value="Aktif">Karyawan Aktif</option>
                <option value="Tetap">Karyawan Tetap</option>
                <option value="Kontrak">Karyawan Kontrak</option>
                <option value="Training">Karyawan Training</option>
                <option value="Resign">Karyawan Resign</option>
                <option value="Semua">Semua Kategori</option>
              </select>
            </div>
            <!--end::Col-->
            <!--end::Col-->
            <div class="col-lg-6 col-md-6 mb-3 text-end">
              <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalInputKaryawan"><i class="bi bi-plus"></i> Input Karyawan</a>
              <button class="btn btn-sm btn-bg-light btn-active-color-primary ms-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr091.svg-->
                <span class="svg-icon svg-icon-muted">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(0 -1 -1 0 12.75 19.75)" fill="black" />
                    <path d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z" fill="black" />
                    <path d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z" fill="#C4C4C4" />
                  </svg>
                </span>
                <!--end::Svg Icon--> Export
              </button>
              <!--begin::Menu 3-->
              <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
                <!--begin::Heading-->
                <div class="menu-item px-3">
                  <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Export Data</div>
                </div>
                <!--end::Heading-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                  <a href="javascript:;" class="menu-link flex-stack px-3" id="export_excel">Excel
                    <i class="las la-file-excel ms-2 fs-4"></i>
                </div>
                <!--end::Menu item-->
              </div>
              <!--end::Menu 3-->
            </div>
            <!--end::Col-->
          </div>
          <div class="loading text-center" style="display: none;">
            <img src="<?= base_url() ?>assets/media/images/surrounded-indicator.gif" alt="Loading..."><br>
            <h3 class="text-gray-400 mt-5" style="margin-top: -30px;">Mengambil data ...</h3>
          </div>
          <div id="showKaryawan"></div>
        </div>
      </div>
      <!--end::Card body-->
    </div>
    <!--end::Row-->
  </div>
  <!--end::Container-->
</div>
<?= $this->endSection() ?>
<?= $this->section('modal') ?>
<div class="modal fade" id="modalInputKaryawan" tabindex="-1" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog mw-950px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header pb-0 border-0 justify-content-end">
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
      <!--begin::Modal header-->
      <!--begin::Modal body-->
      <div class="modal-body mx-5 mx-xl-18 pt-0 pb-15">
        <form id="formInputKaryawan" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
          <!--begin::Heading-->
          <div class="mb-13 text-center">
            <!--begin::Title-->
            <h1 class="mb-3">Input Data Karyawan Baru</h1>
            <?php
            $url = urlaktif();
            ?>
            <input type="hidden" name="kantor" value="<?= $url[4] ?>" required>
            <!--end::Title-->
          </div>
          <!--end::Heading-->
          <!--begin::Input group-->
          <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
              <label class="required fs-6 fw-bolder mb-2">Nomor Urut Karyawan (NUK)</label>
              <input type="text" class="form-control form-control-solid" placeholder="Nomor Urut Karyawan (NUK)" name="usernuk" value="<?= $usernukBaru ?>" required>
              <div id="validation-usernuk" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
              <label class="required fs-6 fw-bolder mb-2">NIK</label>
              <input type="text" class="form-control form-control-solid" placeholder="NIK" name="nik" required>
              <div id="validation-nik" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
              <label class="required fs-6 fw-bolder mb-2">Nama Depan</label>
              <input type="text" class="form-control form-control-solid" placeholder="Nama Depan" name="namaDepan" required>
              <div id="validation-namaDepan" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
              <label class="fs-6 fw-bolder mb-2">Nama Belakang</label>
              <input type="text" class="form-control form-control-solid" placeholder="Nama Belakang" name="namaBelakang">
              <div id="validation-namaBelakang" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
              <label class="required fs-6 fw-bolder mb-2">Tempat Lahir</label>
              <input type="text" class="form-control form-control-solid" placeholder="Tempat Lahir" name="tempatLahir" required>
              <div id="validation-tempatLahir" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
              <label class="required fs-6 fw-bolder mb-2">Tanggal Lahir</label>
              <!--begin::Input-->
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
              <!--end::Input-->
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
              <label class="required fs-6 fw-bolder mb-2">Jenis Kelamin</label>
              <select name="jenisKelamin" id="jenisKelamin" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="1">Laki-laki</option>
                <option value="0">Perempuan</option>
              </select>
              <div id="validation-jenisKelamin" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
              <label class="required fs-6 fw-bolder mb-2">Agama</label>
              <input type="text" class="form-control form-control-solid" placeholder="Agama" name="agama" required>
              <div id="validation-agama" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
              <label class="fs-6 fw-bolder mb-2">Golongan Darah</label>
              <input type="text" class="form-control form-control-solid" placeholder="Golongan Darah" name="golonganDarah">
              <div id="validation-golonganDarah" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
              <label class="required fs-6 fw-bolder mb-2">Status Perkawinan</label>
              <select name="perkawinan" id="perkawinan" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option></option>
                <?php
                $dataperkawinan = ["TK", "Menikah K0", "Menikah K1", "Menikah K2", "Menikah K3", "Menikah K4", "Menikah K5", "Menikah K6"];
                foreach ($dataperkawinan as $perkawinan):
                ?>
                  <option value="<?= $perkawinan ?>"><?= $perkawinan ?></option>
                <?php endforeach; ?>
              </select>
              <div id="validation-perkawinan" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
              <label class="fs-6 fw-bolder mb-2">Nomor Telphone</label>
              <input type="text" class="form-control form-control-solid" placeholder="Nomor Telphone" name="telp">
              <div id="validation-telp" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
              <label class="fs-6 fw-bolder mb-2">Email</label>
              <input type="text" class="form-control form-control-solid" placeholder="Email" name="email">
              <div id="validation-email" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="d-flex flex-column mb-8">
            <label class="required fs-6 fw-bolder mb-2">Alamat</label>
            <textarea class="form-control form-control-solid" rows="3" name="alamat" placeholder="Alamat" required></textarea>
            <div id="validation-alamat" class="fv-plugins-message-container invalid-feedback"></div>
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
              <label class="fs-6 fw-bolder mb-2">Nomor NPWP</label>
              <input type="text" class="form-control form-control-solid" placeholder="Nomor NPWP" name="npwp">
              <div id="validation-npwp" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
              <label class="fs-6 fw-bolder mb-2">Nomor BPJS</label>
              <input type="text" class="form-control form-control-solid" placeholder="Nomor BPJS" name="bpjs">
              <div id="validation-bpjs" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
              <label class="fs-6 fw-bolder mb-2">Nomor JHT</label>
              <input type="text" class="form-control form-control-solid" placeholder="Nomor JHT" name="jht">
              <div id="validation-jht" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
              <label class="fs-6 fw-bolder mb-2">Nomor Rekening Mandiri</label>
              <input type="text" class="form-control form-control-solid" placeholder="Nomor Rekening Mandiri" name="rekeningMandiri">
              <div id="validation-rekeningMandiri" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
              <label class="required fs-6 fw-bolder mb-2">Department</label>
              <select name="department" id="department" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <?php
                $mdepartment = new Department();
                $department = $mdepartment->select("*")->where(["kantor" => ucfirst(strtolower($kantor))])->get()->getResultArray();
                foreach ($department as $dep):
                ?>
                  <option value="<?= $dep["id"] ?>"><?= $dep["nama"] ?></option>
                <?php endforeach; ?>
              </select>
              <div id="validation-department" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
              <label class="required fs-6 fw-bolder mb-2">Posisi/Jabatan</label>
              <select name="jabatan" id="jabatan" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <?php
                foreach ($datajabataninternal as $jabatan):
                ?>
                  <option value="<?= strtoupper($jabatan) ?>"><?= strtoupper($jabatan) ?></option>
                <?php endforeach; ?>
              </select>
              <div id="validation-jabatan" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
              <label class="required fs-6 fw-bolder mb-2">Tanggal Masuk Kerja</label>
              <!--begin::Input-->
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
                <input class="form-control form-control-solid ps-12 flatpickr-input" placeholder="Pilih tanggal" name="masukKerja" id="masukKerja" type="text" required>
                <!--end::Datepicker-->
              </div>
              <div id="validation-masukKerja" class="fv-plugins-message-container invalid-feedback"></div>
              <!--end::Input-->
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Actions-->
          <div class="text-center">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" id="btnSubmit">
              <span class="indicator-label">Input Data Karyawan</span>
              <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
          </div>
          <!--end::Actions-->
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
      if (name == "kategori") {
        var placeholder = "Pilih kategori karyawan...";
      } else if (name == "department") {
        placeholder = "Pilih Department";
      } else if (name == "jabatan") {
        placeholder = "Pilih Jabatan";
      } else if (name == "jenisKelamin") {
        placeholder = "Pilih Jenis Kelamin";
      }
      $(this).select2({
        placeholder: placeholder || "Pilih data...",
        allowClear: allowClear || false,
        multiple: multiple || false
      });
    });
  }

  function get_data() {
    $(".loading").show();
    var kantor = "<?= $kantor ?>";
    var kategori = $("#kategori").val();
    $.ajax({
      url: '<?= base_url('karyawan/get_data?act=data_karyawan') ?>',
      type: 'POST',
      data: {
        kantor: kantor,
        kategori: kategori
      },
      success: function(result) {
        if (result) {
          $("#showKaryawan").html(result);
          $(".loading").hide();
        }
      }
    });
  }
  $(document).ready(function() {
    select2form();
    get_data();

    $('input[name="usernuk"]').on('input', function() {
      let val = $(this).val();
      // Hapus semua karakter selain angka dan tanda minus
      val = val.replace(/[^0-9\-]/g, '');
      $(this).val(val);
    });



    $('#kategori').on('change', function() {
      get_data();
    });

    $("#tanggalLahir").daterangepicker({
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

    $("#masukKerja").daterangepicker({
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

    $('#formInputKaryawan').on('submit', function(evt) {
      evt.preventDefault();
      $('#btnSubmit .indicator-label').hide();
      $('#btnSubmit .indicator-progress').show();
      var formdata = new FormData($(this)[0]);
      $.ajax({
        url: '<?= base_url() ?>karyawan/proses?act=input_karyawan',
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
              $("#validation-" + notempty[i]).html('');
            }
            for (i = 0; i < name.length; i++) {
              $("#validation-" + name[i]).attr("class", "invalid-feedback");
              $("#validation-" + name[i]).html(result.errors[name[i]]);
              $("#validation-" + name[i]).attr("style", "display:block");
            }
            $('#btnSubmit .indicator-label').text("Cek Data Kembali");
            $('#btnSubmit .indicator-label').show();
            $('#btnSubmit .indicator-progress').hide();
            $('#btnSubmit').removeClass("btn-primary");
            $('#btnSubmit').addClass("btn-danger");
            setTimeout(function() {
              $('#btnSubmit .indicator-label').text("Input Data Karyawan");
              $('#btnSubmit').removeClass("btn-danger");
              $('#btnSubmit').addClass("btn-primary");
            }, 3500);
          } else {
            if (result.insert == true) {
              $('#btnSubmit .indicator-label').text("Berhasil");
              $('#btnSubmit .indicator-label').show();
              $('#btnSubmit .indicator-progress').hide();
              $('#btnSubmit').removeClass("btn-primary");
              $('#btnSubmit').addClass("btn-success");
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil menambahkan data karyawan");
              location.reload();
            }
          }
        },
        error: function(result) {
          // alert(result);
        }
      });
    });

    $("#export_excel").on("click", function() {
      var kantor = "<?= $kantor ?>";
      var kategori = $('#kategori').val();
      const url = '<?= base_url() ?>karyawan/export?act=data_karyawan&kantor=' + kantor + '&kategori=' + kategori;
      window.open(url, '_blank');
    });
  });
</script>
<?= $this->endSection() ?>