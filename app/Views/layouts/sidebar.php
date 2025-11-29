<?php
$this->request = service('request');
$level = $_SESSION['level'];
?>
<div class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
  <!--begin::Aside Toolbarl-->
  <div class="aside-toolbar flex-column-auto">
    <div class="aside-user d-flex align-items-sm-center justify-content-center py-5" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-overflow="true">
      <div class="symbol symbol-50px">
        <?php
        $photo = str_replace("photo/", "", $biodata['photo']);
        $photoFile = FCPATH . "photo/" . $photo;
        if (!empty($photo) && file_exists($photoFile)) : ?>
          <img style="object-fit: cover; object-position: top;" src="<?= base_url() ?>photo/<?= $photo ?>" alt="Profile" />
        <?php else : ?>
          <?php if ($biodata['jk'] == "1") : ?>
            <img src="<?= base_url() ?>assets/media/images/avatar-man.svg" alt="Profile" />
          <?php else : ?>
            <img src="<?= base_url() ?>assets/media/images/avatar-woman.svg" alt="Profile" />
          <?php endif; ?>
        <?php endif; ?>
      </div>
      <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
        <div class="d-flex">
          <div class="flex-grow-1 me-2">
            <a href="javascript:;" class="text-white text-hover-primary fs-6 fw-bold"><?= $biodata['nama'] ?></a>
            <span class="text-gray-600 fw-bold d-block fs-8 mb-1"><?= $biodata['user_status'] ?></span>
            <div class="d-flex align-items-center text-success fs-9">
              <span class="bullet bullet-dot bg-success me-1"></span>online
            </div>
          </div>
          <div class="me-n2">
            <a href="javascript:;" class="btn btn-icon btn-sm btn-active-color-primary mt-n2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
              <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
              <span class="svg-icon svg-icon-muted svg-icon-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="black" />
                  <path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="black" />
                </svg>
              </span>
              <!--end::Svg Icon-->
            </a>
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
              <div class="menu-item px-5">
                <a href="<?= base_url("profile") ?>" class="menu-link px-5">Profile</a>
              </div>
              <!-- <div class="menu-item px-5">
                <a href="../../demo8/dist/pages/projects/list.html" class="menu-link px-5">
                  <span class="menu-text">My Projects</span>
                  <span class="menu-badge">
                    <span class="badge badge-light-danger badge-circle fw-bolder fs-7">3</span>
                  </span>
                </a>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="aside-footer flex-column-auto py-5">
    <a href="javascript:;" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#modalLogout">
      <span class="btn-label">Keluar</span>
    </a>
  </div>
  <?php
  $url = urlaktif();
  ?>
  <!--begin::Aside menu-->
  <div class="aside-menu flex-column-fluid">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y px-2 my-5 my-lg-5" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
      <!--begin::Menu-->
      <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" data-kt-menu="true">
        <div class="menu-item">
          <div class="menu-content pb-2">
            <span class="menu-section text-muted text-uppercase fs-8 ls-1">DASHBOARD</span>
          </div>
        </div>

        <!-- Dashboard -->
        <div class="menu-item">
          <a class="menu-link <?= ($url[3] == "dashboard") ? "active" : "" ?>" href="<?= base_url("dashboard") ?>">
            <span class="menu-icon">
              <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
              <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                  <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                  <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                  <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                </svg>
              </span>
              <!--end::Svg Icon-->
            </span>
            <span class="menu-title">DASHBOARD</span>
          </a>
        </div>

        <!-- HRD - Karyawan -->
        <div class="menu-item">
          <div class="menu-content pb-2">
            <span class="menu-section text-muted text-uppercase fs-8 ls-1">MASTER DATA</span>
          </div>
        </div>
        <?php
        $pageMaster = ["biodata"];
        ?>
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= (in_array($url[3], $pageMaster)) ? "here show" : "" ?>">
          <span class="menu-link">
            <span class="menu-icon">
              <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="black" />
                  <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="black" />
                </svg>
              </span>
            </span>
            <span class="menu-title">BIODATA</span>
            <span class="menu-arrow"></span>
          </span>
          <?php $pageFour = "admin"; ?>
          <div class="menu-sub menu-sub-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "menu-active-bg" : "" ?>">
            <a class="menu-item menu-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "here show" : "" ?>" href="<?= base_url("biodata/" . $pageFour) ?>">
              <span class="menu-link <?= (($url[3] == "biodata") && ((in_array($url[4], [$pageFour])))) ? "active bg-primary" : "" ?>">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">DATA ADMIN</span>
              </span>
            </a>
          </div>
          <?php $pageFour = "akun"; ?>
          <div class="menu-sub menu-sub-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "menu-active-bg" : "" ?>">
            <a class="menu-item menu-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "here show" : "" ?>" href="<?= base_url("biodata/" . $pageFour) ?>">
              <span class="menu-link <?= (($url[3] == "biodata") && ((in_array($url[4], [$pageFour])))) ? "active bg-primary" : "" ?>">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">DATA AKUN</span>
              </span>
            </a>
          </div>
          <?php $pageFour = "guru"; ?>
          <div class="menu-sub menu-sub-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "menu-active-bg" : "" ?>">
            <a class="menu-item menu-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "here show" : "" ?>" href="<?= base_url("biodata/" . $pageFour) ?>">
              <span class="menu-link <?= (($url[3] == "biodata") && ((in_array($url[4], [$pageFour])))) ? "active bg-primary" : "" ?>">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">DATA GURU</span>
              </span>
            </a>
          </div>
          <?php $pageFour = "siswa"; ?>
          <div class="menu-sub menu-sub-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "menu-active-bg" : "" ?>">
            <a class="menu-item menu-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "here show" : "" ?>" href="<?= base_url("biodata/" . $pageFour) ?>">
              <span class="menu-link <?= (($url[3] == "biodata") && ((in_array($url[4], [$pageFour])))) ? "active bg-primary" : "" ?>">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">DATA SISWA</span>
              </span>
            </a>
          </div>
          <?php $pageFour = "wali_siswa"; ?>
          <div class="menu-sub menu-sub-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "menu-active-bg" : "" ?>">
            <a class="menu-item menu-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "here show" : "" ?>" href="<?= base_url("biodata/" . $pageFour) ?>">
              <span class="menu-link <?= (($url[3] == "biodata") && ((in_array($url[4], [$pageFour])))) ? "active bg-primary" : "" ?>">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">DATA WALI SISWA</span>
              </span>
            </a>
          </div>
        </div>
        <?php
        $pageMaster = ["administrasi"];
        ?>
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= (in_array($url[3], $pageMaster)) ? "here show" : "" ?>">
          <span class="menu-link">
            <span class="menu-icon">
              <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="black" />
                  <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="black" />
                </svg>
              </span>
            </span>
            <span class="menu-title">ADMINISTRASI</span>
            <span class="menu-arrow"></span>
          </span>
          <?php $pageFour = "admin"; ?>
          <div class="menu-sub menu-sub-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "menu-active-bg" : "" ?>">
            <a class="menu-item menu-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "here show" : "" ?>" href="<?= base_url("biodata/" . $pageFour) ?>">
              <span class="menu-link <?= (($url[3] == "biodata") && ((in_array($url[4], [$pageFour])))) ? "active bg-primary" : "" ?>">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">DATA SEKOLAH</span>
              </span>
            </a>
          </div>
          <?php $pageFour = "akun"; ?>
          <div class="menu-sub menu-sub-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "menu-active-bg" : "" ?>">
            <a class="menu-item menu-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "here show" : "" ?>" href="<?= base_url("biodata/" . $pageFour) ?>">
              <span class="menu-link <?= (($url[3] == "biodata") && ((in_array($url[4], [$pageFour])))) ? "active bg-primary" : "" ?>">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">DATA TAHUN PELAJARAN</span>
              </span>
            </a>
          </div>
          <?php $pageFour = "guru"; ?>
          <div class="menu-sub menu-sub-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "menu-active-bg" : "" ?>">
            <a class="menu-item menu-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "here show" : "" ?>" href="<?= base_url("biodata/" . $pageFour) ?>">
              <span class="menu-link <?= (($url[3] == "biodata") && ((in_array($url[4], [$pageFour])))) ? "active bg-primary" : "" ?>">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">DATA KELAS</span>
              </span>
            </a>
          </div>
          <?php $pageFour = "siswa"; ?>
          <div class="menu-sub menu-sub-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "menu-active-bg" : "" ?>">
            <a class="menu-item menu-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "here show" : "" ?>" href="<?= base_url("biodata/" . $pageFour) ?>">
              <span class="menu-link <?= (($url[3] == "biodata") && ((in_array($url[4], [$pageFour])))) ? "active bg-primary" : "" ?>">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">DATA MATA PELAJARAN</span>
              </span>
            </a>
          </div>
        </div>
        <?php
        $pageMaster = ["penilaian"];
        ?>
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= (in_array($url[3], $pageMaster)) ? "here show" : "" ?>">
          <span class="menu-link">
            <span class="menu-icon">
              <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="black" />
                  <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="black" />
                </svg>
              </span>
            </span>
            <span class="menu-title">PENILAIAN</span>
            <span class="menu-arrow"></span>
          </span>
          <?php $pageFour = "siswa"; ?>
          <div class="menu-sub menu-sub-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "menu-active-bg" : "" ?>">
            <a class="menu-item menu-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "here show" : "" ?>" href="<?= base_url("biodata/" . $pageFour) ?>">
              <span class="menu-link <?= (($url[3] == "biodata") && ((in_array($url[4], [$pageFour])))) ? "active bg-primary" : "" ?>">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">ABSENSI</span>
              </span>
            </a>
          </div>
          <?php $pageFour = "siswa"; ?>
          <div class="menu-sub menu-sub-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "menu-active-bg" : "" ?>">
            <a class="menu-item menu-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "here show" : "" ?>" href="<?= base_url("biodata/" . $pageFour) ?>">
              <span class="menu-link <?= (($url[3] == "biodata") && ((in_array($url[4], [$pageFour])))) ? "active bg-primary" : "" ?>">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">CATATAN</span>
              </span>
            </a>
          </div>
          <?php $pageFour = "siswa"; ?>
          <div class="menu-sub menu-sub-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "menu-active-bg" : "" ?>">
            <a class="menu-item menu-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "here show" : "" ?>" href="<?= base_url("biodata/" . $pageFour) ?>">
              <span class="menu-link <?= (($url[3] == "biodata") && ((in_array($url[4], [$pageFour])))) ? "active bg-primary" : "" ?>">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">EKSTRAKULIKULER</span>
              </span>
            </a>
          </div>
          <?php $pageFour = "akun"; ?>
          <div class="menu-sub menu-sub-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "menu-active-bg" : "" ?>">
            <a class="menu-item menu-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "here show" : "" ?>" href="<?= base_url("biodata/" . $pageFour) ?>">
              <span class="menu-link <?= (($url[3] == "biodata") && ((in_array($url[4], [$pageFour])))) ? "active bg-primary" : "" ?>">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">NILAI SOSIAL</span>
              </span>
            </a>
          </div>
          <?php $pageFour = "guru"; ?>
          <div class="menu-sub menu-sub-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "menu-active-bg" : "" ?>">
            <a class="menu-item menu-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "here show" : "" ?>" href="<?= base_url("biodata/" . $pageFour) ?>">
              <span class="menu-link <?= (($url[3] == "biodata") && ((in_array($url[4], [$pageFour])))) ? "active bg-primary" : "" ?>">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">NILAI SPIRITUAL</span>
              </span>
            </a>
          </div>
          <?php $pageFour = "admin"; ?>
          <div class="menu-sub menu-sub-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "menu-active-bg" : "" ?>">
            <a class="menu-item menu-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "here show" : "" ?>" href="<?= base_url("biodata/" . $pageFour) ?>">
              <span class="menu-link <?= (($url[3] == "biodata") && ((in_array($url[4], [$pageFour])))) ? "active bg-primary" : "" ?>">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">PEMBELAJARAN</span>
              </span>
            </a>
          </div>
          <?php $pageFour = "siswa"; ?>
          <div class="menu-sub menu-sub-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "menu-active-bg" : "" ?>">
            <a class="menu-item menu-accordion <?= (($url[3] == "biodata") && (in_array($url[4], [$pageFour]))) ? "here show" : "" ?>" href="<?= base_url("biodata/" . $pageFour) ?>">
              <span class="menu-link <?= (($url[3] == "biodata") && ((in_array($url[4], [$pageFour])))) ? "active bg-primary" : "" ?>">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">PRESTASI</span>
              </span>
            </a>
          </div>
        </div>

        <div class="menu-item">
          <div class="menu-content pb-2">
            <span class="menu-section text-muted text-uppercase fs-8 ls-1">RAPORT</span>
          </div>
        </div>

        <!-- RAPORT -->
        <div class="menu-item">
          <a class="menu-link <?= ($url[3] == "raport") ? "active" : "" ?>" href="<?= base_url("dashboard") ?>">
            <span class="menu-icon">
              <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
              <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                  <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                  <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                  <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                </svg>
              </span>
              <!--end::Svg Icon-->
            </span>
            <span class="menu-title">NILAI AKHIR</span>
          </a>
        </div>
        <div class="menu-item">
          <a class="menu-link <?= ($url[3] == "raport") ? "active" : "" ?>" href="<?= base_url("dashboard") ?>">
            <span class="menu-icon">
              <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
              <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                  <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                  <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                  <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                </svg>
              </span>
              <!--end::Svg Icon-->
            </span>
            <span class="menu-title">CETAK RAPORT</span>
          </a>
        </div>

        <?php if (in_array($_SESSION["level"], ["admin", "superadmin"])): ?>
          <!-- Pengaturan -->
          <div class="menu-item">
            <div class="menu-content pb-2">
              <span class="menu-section text-muted text-uppercase fs-8 ls-1">Pengaturan</span>
            </div>
          </div>
          <div class="menu-item">
            <a class="menu-link <?= ($url[3] == "settings") && ($url[4] == "notifikasi") ? "active bg-primary" : "" ?>" href="<?= base_url() ?>settings/notifikasi">
              <span class="menu-icon">
                <i class="bi bi-bell fs-3"></i>
              </span>
              <span class="menu-title">Notifikasi</span>
            </a>
          </div>
          <div class="menu-item">
            <a class="menu-link <?= ($url[3] == "log") ? "active bg-primary" : "" ?>" href="<?= base_url() ?>log">
              <span class="menu-icon">
                <i class="bi bi-calendar3-event fs-3"></i>
              </span>
              <span class="menu-title">Log Aktifitas</span>
            </a>
          </div>
        <?php endif; ?>

      </div>
      <!--end::Menu-->
    </div>
    <!--end::Aside Menu-->
  </div>
  <!--end::Aside menu-->
</div>