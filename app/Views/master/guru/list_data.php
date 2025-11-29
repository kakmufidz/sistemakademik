<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<div class="post d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-xxl">
        <!--begin::Row-->
        <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header mt-5">
                <!--begin::Card title-->
                <div class="card-title flex-column">
                    <h3 class="fw-bolder mb-1"><?= $page_title ?></h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <div class="card-body pt-0">
                <div class="container mt-4">
                    <div class="row mb-6 align-items-center">
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
        var kantor = "";
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
            var kantor = "";
            var kategori = $('#kategori').val();
            const url = '<?= base_url() ?>karyawan/export?act=data_karyawan&kantor=' + kantor + '&kategori=' + kategori;
            window.open(url, '_blank');
        });
    });
</script>
<?= $this->endSection() ?>