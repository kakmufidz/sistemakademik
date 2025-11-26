<!--begin::Navbar-->
<div class="card mb-5 mb-xxl-8">
  <div class="card-body pt-9 pb-0">
    <!--begin::Details-->
    <div class="d-flex flex-wrap flex-sm-nowrap">
      <!--begin: Pic-->
      <div class="mb-4 me-9">
        <!--begin::Image input-->
        <?php
        $this->request = service('request');
        if ($karyawan['jk'] == "1") {
          $url_foto = base_url("assets/media/images/avatar-man.svg");
        } else {
          $url_foto = base_url("assets/media/images/avatar-woman.svg");
        }
        if (!empty($karyawan['photo'])) {
          $photo = str_replace("photo/", "", $karyawan['photo']);
          $fotoPath = FCPATH . "photo/" . $photo;
          if (is_file($fotoPath)) {
            // Jika file foto ada di direktori
            $url_foto = base_url("photo/" . $photo);
          }
        }
        ?>
        <form id="uploadFotoForm" enctype="multipart/form-data">
          <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('<?= $url_foto ?>')">
            <div id="avatarPreview" class="image-input-wrapper w-150px h-150px bgi-position-center"
              style="background-size: 100%; background-fit: cover; background-position: top; background-image: url('<?= $url_foto ?>')">
            </div>
            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
              data-kt-image-input-action="change"
              data-bs-toggle="tooltip" data-bs-original-title="Ganti Foto">
              <i class="bi bi-pencil-fill fs-7"></i>
              <input type="file" name="avatar" id="avatarInput" accept=".png, .jpg, .jpeg">
            </label>
          </div>
          <input type="hidden" name="usernuk" value="<?= $karyawan['usernuk'] ?>">
        </form>
        <div id="uploadStatus" class="text-muted small mt-2"></div>
      </div>
      <!--end::Pic-->
      <!--begin::Info-->
      <div class="flex-grow-1">
        <!--begin::Title-->
        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
          <!--begin::User-->
          <div class="d-flex flex-column">
            <!--begin::Name-->
            <div class="d-flex align-items-center mb-2">
              <a href="javascript:;" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1"><?= $karyawan['user_nama_depan'] . " " . $karyawan['user_nama_belakang'] ?></a>
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
            <!--begin::Info-->
            <div class="d-flex flex-wrap fw-bolder fs-6 mb-4 pe-2">
              <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                <span class="svg-icon svg-icon-4 me-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black" />
                    <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black" />
                  </svg>
                </span>
                <!--end::Svg Icon--><?= $karyawan['usernuk'] ?></a>
              <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                <span class="svg-icon svg-icon-4 me-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="black" />
                    <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="black" />
                  </svg>
                </span>
                <!--end::Svg Icon--><?= $karyawan['department'] ?></a>
              <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                <span class="svg-icon svg-icon-4 me-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="black" />
                    <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="black" />
                  </svg>
                </span>
                <!--end::Svg Icon--><?= $karyawan['no_telp'] ?></a>
            </div>
            <!--end::Info-->
          </div>
          <!--end::User-->
        </div>
        <!--end::Title-->
        <!--begin::Stats-->
        <div class="d-flex flex-wrap flex-stack">
          <!--begin::Wrapper-->
          <div class="d-flex flex-column flex-grow-1 pe-8">
            <!--begin::Stats-->
            <div class="d-flex flex-wrap">
              <!--begin::Stat-->
              <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                <!--begin::Number-->
                <div class="d-flex align-items-center">
                  <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                  <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
                      <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
                    </svg>
                  </span>
                  <!--end::Svg Icon-->
                  <?php
                  $resign_date = ((empty($karyawan['resign_date'])) || ($karyawan['resign_date'] == "0000-00-00")) ? date("Y-m-d") : $karyawan['resign_date'];
                  $masakerja = countTanggal($karyawan["reg_date"], $resign_date);
                  ?>
                  <div class="fs-2 fw-bolder"><span data-kt-countup="true" data-kt-countup-value="<?= $masakerja->y ?>">0</span> Tahun</div>
                </div>
                <!--end::Number-->
                <!--begin::Label-->
                <div class="fw-bolder fs-6 text-gray-400">Masa Kerja</div>
                <!--end::Label-->
              </div>
              <!--end::Stat-->
              <!--begin::Stat-->
              <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                <!--begin::Number-->
                <div class="d-flex align-items-center">
                  <!--end::Svg Icon-->
                  <?php if ($karyawan['user_status'] == 0) {
                    $status = "<span class='badge badge-light-danger fs-5 fw-bolder'>Resign</span>";
                  } elseif ($karyawan['user_status'] == 1) {
                    $status = "<span class='badge badge-light-success fs-5 fw-bolder'>Tetap</span>";
                  } elseif ($karyawan['user_status'] == 2) {
                    $status = "<span class='badge badge-light-primary fs-5 fw-bolder'>Kontrak</span>";
                  } elseif ($karyawan['user_status'] == 3) {
                    $status = "<span class='badge badge-light-info fs-5 fw-bolder'>Training</span>";
                  } ?>
                  <?= $status ?>
                </div>
                <!--end::Number-->
                <!--begin::Label-->
                <div class="fw-bolder fs-6 text-gray-400">Status</div>
                <!--end::Label-->
              </div>
              <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" id="gantiTanggal" style="margin-left: -35px; margin-top:-10px;" data-bs-toggle="modal" data-bs-target="#modalGantiTanggal">
                <span data-bs-toggle="tooltip" data-bs-original-title="Ganti Tanggal">
                  <i class="bi bi-pencil-fill fs-7"></i>
                </span>
              </label>
              <!--end::Stat-->
              <!--begin::Stat-->
              <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 ms-3 mb-3">
                <!--begin::Number-->
                <div class="d-flex align-items-center">
                  <div class="fs-2 fw-bolder"><?= $karyawan["jabatan"] ?></div>
                </div>
                <!--end::Number-->
                <!--begin::Label-->
                <div class="fw-bolder fs-6 text-gray-400"><?= $karyawan["department"] ?></div>
                <!--end::Label-->
              </div>
              <!--end::Stat-->
              <!--begin::Stat-->
              <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                <!--begin::Number-->
                <div class="fw-bolder fs-6 text-gray-400">Tanggal Masuk: <?= tgl_indo($karyawan['reg_date']) ?></div>
                <?php if ($karyawan["resign_date"] !== null): ?>
                  <div class="fw-bolder fs-6 text-gray-400">Tanggal Keluar: <?= tgl_indo($karyawan['resign_date']) ?></div>
                <?php endif; ?>
                <!--end::Number-->
                <!--begin::Label-->
                <div class="fw-bolder fs-6 text-gray-400">Masa Kerja: <span data-kt-countup="true" data-kt-countup-value="<?= $masakerja->y ?>">0</span> Tahun <span data-kt-countup="true" data-kt-countup-value="<?= $masakerja->m ?>">0</span> Bulan <span data-kt-countup="true" data-kt-countup-value="<?= $masakerja->d ?>">0</span> Hari</div>
                <!--end::Label-->
              </div>
              <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" id="gantiTanggal" style="margin-left: -35px; margin-top:-10px;" data-bs-toggle="modal" data-bs-target="#modalGantiTanggal">
                <span data-bs-toggle="tooltip" data-bs-original-title="Ganti Tanggal">
                  <i class="bi bi-pencil-fill fs-7"></i>
                </span>
              </label>
              <!--end::Stat-->
            </div>
            <!--end::Stats-->
          </div>
          <!--end::Wrapper-->
        </div>
        <!--end::Stats-->
      </div>
      <!--end::Info-->
    </div>
    <!--end::Details-->
    <!--begin::Navs-->
    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
      <!--begin::Nav item-->
      <?php
      $getAct = $this->request->getGet('act');
      $base64Encoded = base64_encode($karyawan['usernuk'] . "additional");
      $navmenu = ["dokumen", "kontrak", "pelatihan", "pembinaan", "kesehatan"];
      $actbio = "";
      $dokumen = "";
      $kontrak = "";
      $pelatihan = "";
      $pembinaan = "";
      $kesehatan = "";
      if (isset($getAct)) {
        if (!in_array($getAct, $navmenu)) {
          $actbio = "active";
        } else {
          $dokumen = ($getAct == "dokumen") ? "active" : "";
          $kontrak = ($getAct == "kontrak") ? "active" : "";
          $pelatihan = ($getAct == "pelatihan") ? "active" : "";
          $pembinaan = ($getAct == "pembinaan") ? "active" : "";
          $kesehatan = ($getAct == "kesehatan") ? "active" : "";
        }
      } else {
        $actbio = "active";
      }
      ?>
      <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 <?= $actbio ?>" href="<?= base_url("karyawan/detail?key=" . $base64Encoded) ?>" id="btnBiodata">Biodata</a>
      </li>
      <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 <?= $dokumen ?>" href="<?= base_url("karyawan/detail?key=" . $base64Encoded . "&act=dokumen") ?>">Dokumen</a>
      </li>
      <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 <?= $kontrak ?>" href="<?= base_url("karyawan/detail?key=" . $base64Encoded . "&act=kontrak") ?>">Kontrak & Riwayat Jabatan</a>
      </li>
      <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 <?= $pelatihan ?>" href="<?= base_url("karyawan/detail?key=" . $base64Encoded . "&act=pelatihan") ?>">Pelatihan</a>
      </li>
      <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 <?= $pembinaan ?>" href="<?= base_url("karyawan/detail?key=" . $base64Encoded . "&act=pembinaan") ?>">Pembinaan</a>
      </li>
      <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 <?= $kesehatan ?>" href="<?= base_url("karyawan/detail?key=" . $base64Encoded . "&act=kesehatan") ?>">Cek Kesehatan Rutin</a>
      </li>
      <!-- <table -->
    </ul>
    <!--begin::Navs-->
  </div>
</div>
<!--end::Navbar-->

<div class="modal fade" id="modalGantiTanggal" tabindex="-1" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog mw-650px">
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
        <form id="formStatus" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
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
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Status</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <?php $status = [] ?>
              <select name="status" id="status" class="form-select form-select-solid form-select-lg fw-bold" required>
                <option value=""></option>
                <option value="3" <?= ($karyawan['user_status'] == 3) ? "selected" : "" ?>>Training</option>
                <option value="2" <?= ($karyawan['user_status'] == 2) ? "selected" : "" ?>>Kontrak</option>
                <option value="1" <?= ($karyawan['user_status'] == 1) ? "selected" : "" ?>>Tetap</option>
                <option value="0" <?= ($karyawan['user_status'] == 0) ? "selected" : "" ?>>Resign</option>
              </select>
              <div id="validation-status" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Row-->
          <div class="row">
            <!--begin::Label-->
            <label class="col-lg-3 mt-3 fw-bolder text-muted">Tanggal Masuk</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
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
                <input class="form-control form-control-solid ps-12 flatpickr-input" placeholder="Pilih tanggal" name="tanggalMasuk" id="tanggalMasuk" type="text" required>
                <!--end::Datepicker-->
              </div>
              <div id="validation-tanggalMasuk" class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Row-->
          <!--begin::Row-->
          <?php $tgl_keluar = ($karyawan['user_status'] == 0) ? "block" : "none"; ?>
          <div id="inputTglKeluar" style="display: <?= $tgl_keluar ?>;">
            <div class="row">
              <!--begin::Label-->
              <label class="col-lg-3 mt-3 fw-bolder text-muted">Tanggal Keluar</label>
              <!--end::Label-->
              <!--begin::Col-->
              <div class="col-lg-8">
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
                  <input class="form-control form-control-solid ps-12 flatpickr-input" placeholder="Pilih tanggal" name="tanggalKeluar" id="tanggalKeluar" type="text" required>
                  <!--end::Datepicker-->
                </div>
                <div id="validation-tanggalKeluar" class="fv-plugins-message-container invalid-feedback"></div>
              </div>
              <!--end::Col-->
            </div>
          </div>
          <!--end::Row-->
          <!--end::Input group-->
          <div class="text-center mt-7">
            <a class="btn btn-light me-3" data-bs-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-primary" id="btnSubmitStatus">
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
<script>
  $(document).ready(function() {
    var defaultPhotoUrl = '<?= $url_foto ?>'; // simpan URL awal
    var tanggal_masuk = ("<?= $karyawan['reg_date'] ?>" == "") ? "<?= date("Y-m-d") ?>" : "<?= $karyawan['reg_date'] ?>";
    var tanggal_keluar = ("<?= $karyawan['resign_date'] ?>" == "") ? "<?= date("Y-m-d") ?>" : "<?= $karyawan['resign_date'] ?>";

    $("#tanggalMasuk").daterangepicker({
      startDate: moment(tanggal_masuk, 'YYYY-MM-DD'),
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

    $("#tanggalKeluar").daterangepicker({
      startDate: moment(tanggal_keluar, 'YYYY-MM-DD'),
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

    $("#status").on("change", function() {
      var status = $(this).val();
      if (status == 0) {
        $("#inputTglKeluar").css("display", "block");
      } else {
        $("#inputTglKeluar").css("display", "none");
      }
    });

    $('#avatarInput').on('change', function() {
      var formData = new FormData($("#uploadFotoForm")[0]);
      $.ajax({
        url: '<?= base_url('karyawan/proses?act=upload_photo') ?>',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {
          if (data.success) {
            $('#avatarPreview').css('background-image', 'url(' + data.photo_url + ')');
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Foto berhasil diunggah.',
              showConfirmButton: true,
            });
          } else {
            $('#avatarPreview').css('background-image', 'url(' + defaultPhotoUrl + ')');
            $('#uploadStatus').text('Upload gagal: ' + data.message);
            Swal.fire({
              position: 'center',
              icon: 'warning',
              title: 'Foto gagal diunggah.',
              showConfirmButton: false,
              timer: 2000
            });
          }
        },
        error: function() {
          $('#avatarPreview').css('background-image', 'url(' + defaultPhotoUrl + ')');
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Terjadi kesalahan saat mengunggah.',
            showConfirmButton: true,
          });
        }
      });
    });

    $('#formStatus').on('submit', function(evt) {
      evt.preventDefault();
      $('#btnSubmitStatus .indicator-label').hide();
      $('#btnSubmitStatus .indicator-progress').show();
      var formdata = new FormData($(this)[0]);
      $.ajax({
        url: '<?= base_url() ?>karyawan/proses?act=update_status',
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
            $('#btnSubmitStatus .indicator-label').text("Cek Data Kembali");
            $('#btnSubmitStatus .indicator-label').show();
            $('#btnSubmitStatus .indicator-progress').hide();
            $('#btnSubmitStatus').removeClass("btn-primary");
            $('#btnSubmitStatus').addClass("btn-danger");
            setTimeout(function() {
              $('#btnSubmitStatus .indicator-label').text("Edit Biodata");
              $('#btnSubmitStatus').removeClass("btn-danger");
              $('#btnSubmitStatus').addClass("btn-primary");
            }, 3500);
          } else {
            if (result.proses == true) {
              sessionStorage.setItem("alert", "show");
              sessionStorage.setItem("alert_title", "Berhasil update status");
              $('#btnSubmitStatus .indicator-label').text("Berhasil");
              $('#btnSubmitStatus .indicator-label').show();
              $('#btnSubmitStatus .indicator-progress').hide();
              $('#btnSubmitStatus').removeClass("btn-primary");
              $('#btnSubmitStatus').addClass("btn-success");
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