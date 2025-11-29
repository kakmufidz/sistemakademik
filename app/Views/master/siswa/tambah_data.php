<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<div class="post d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-xxl">
        <!--begin::Row-->
        <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title flex-column">
                    <h3 class="fw-bolder mb-1"><?= $page_title ?></h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <div class="card-body pt-0">
                <div class="container mt-4">

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