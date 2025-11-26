<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<!--begin::Post-->
<div class="post d-flex flex-column-fluid">
  <!--begin::Container-->
  <div class="container-xxl">
    <?= $this->include('profile/head_detail') ?>
    <!--begin::Row-->
    <div class="row g-5 g-xxl-8">
      <!--begin::Col-->
      <div class="col-xl-12">
        <!--begin::details View-->
        <div class="card mb-5 mb-xl-10">
          <!--begin::Card body-->
          <div class="card-body p-9">
            <!--begin::Notice-->
            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
              <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                  <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black" />
                  <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black" />
                </svg>
              </span>
              <div class="d-flex flex-stack flex-grow-1">
                <div class="fw-bold">
                  <h4 class="text-gray-900 fw-bolder">Perhatian!</h4>
                  <div class="fs-6 text-gray-700">Untuk mengetahui data lengkap anda ada di menu Karyawan.</div>
                </div>
              </div>
            </div>
            <!--end::Notice-->
          </div>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Row-->
    </div>
    <!--end::Col-->
  </div>
  <!--end::Input group-->
</div>
<!--end::Post-->
<?= $this->endSection() ?>
<?= $this->section('modal') ?>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>