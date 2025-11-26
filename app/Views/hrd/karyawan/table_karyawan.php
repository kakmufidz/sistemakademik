<!--begin::Table container-->
<div class="table-responsive">
  <!--begin::Table-->
  <table id="tabelKaryawan" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder">
    <!--begin::Head-->
    <thead class="fs-7 text-gray-400 text-uppercase">
      <tr>
        <th class="min-w-10px text-center">No</th>
        <th class="min-w-100px">NUK`</th>
        <th class="min-w-150px">Nama</th>
        <th class="min-w-50px">Dept</th>
        <th class="min-w-50px">Posisi</th>
        <th class="min-w-50px">Usia</th>
        <th class="min-w-50px">Tanggal Masuk</th>
        <?php if ($kategori == "Resign") : ?>
          <th class="min-w-50px">Tanggal Keluar</th>
        <?php endif; ?>
        <th class="min-w-50px">Masa Kerja</th>
        <th class="min-w-50px">Action</th>
      </tr>
    </thead>
    <!--end::Head-->
    <!--begin::Body-->
    <tbody>
      <?php
      $no = 1;
      foreach ($datakaryawan as $karyawan) :
        $base64Encoded = base64_encode($karyawan['usernuk'] . "additional");
        $catbase64Encoded = base64_encode($kantor);
        $nama = $karyawan["user_nama_depan"] . " " . $karyawan["user_nama_belakang"];
        $usia = countTanggal($karyawan["birthday"], null, "tahun");
        $resign_date = ((empty($karyawan['resign_date'])) || ($karyawan['resign_date'] == "0000-00-00")) ? date("Y-m-d") : $karyawan['resign_date'];
        $masakerja = countTanggal($karyawan["reg_date"], $resign_date, "full");
      ?>
        <tr>
          <td class="text-center"><?= $no ?></td>
          <td><a href="<?= base_url("karyawan/detail?key=" . $base64Encoded) ?>" class="text-gray-900 text-hover-primary fw-bolder"><?= $karyawan["usernuk"] ?></a></td>
          <td><a href="<?= base_url("karyawan/detail?key=" . $base64Encoded) ?>" class="text-gray-900 text-hover-primary fw-bolder"><?= $nama ?></a></td>
          <td><?= $karyawan["nama_department"] ?></td>
          <td><?= $karyawan["jabatan"] ?></td>
          <td><?= $usia ?></td>
          <td><?= tgl_indo($karyawan["reg_date"]) ?></td>
          <?php if ($kategori == "Resign") : ?>
            <td><?= tgl_indo($karyawan["resign_date"]) ?></td>
          <?php endif; ?>
          <td><?= $masakerja ?></td>
          <td class=" text-center">
            <a href="<?= base_url("karyawan/detail?key=" . $base64Encoded) ?>" class="btn btn-icon btn-primary w-40px h-40px me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
              <span class="svg-icon svg-icon-muted svg-icon-2hx">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black" />
                  <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black" />
                </svg>
              </span>
            </a>
          </td>
        </tr>
      <?php $no++;
      endforeach; ?>
    </tbody>
    <!--end::Body-->
  </table>
  <!--end::Table-->
</div>
<!--end::Table container-->


<script>
  $(document).ready(function() {
    let tabelmaster = new DataTable('#tabelKaryawan', {
      responsive: false,
      layout: {
        topStart: 'search',
        topEnd: 'pageLength'
      },
      language: {
        search: "",
        searchPlaceholder: "Cari data karyawan...",
        lengthMenu: "_MENU_"
      },
    });
    $(".dt-length").addClass("d-flex align-items-center");
    $(".dt-length select").addClass("form-select form-select-solid form-select-sm");
    $(".dt-search").addClass("d-flex align-items-center my-1");
    $(".dt-search input").addClass("form-control form-control-solid form-select-sm w-300px ps-9");
    var html = '<span class="svg-icon svg-icon-3 position-absolute ms-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" /><path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" /></svg></span>';
    $(".dt-search input").before(html);

  });
</script>