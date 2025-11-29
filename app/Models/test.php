<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="">
    <title><?= $page_title ?></title>
    <meta charset="utf-8" />
    <meta name="description" content="Sistem Akademik" />
    <meta name="keywords" content="Sistem, akademik, Informasi, Aplikasi, Website, sekolah, sd, smp, sma, mi, mts, ma" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?= $page_title ?>" />
    <meta property="og:url" content="https://digitalinsource.web.id/" />
    <meta property="og:site_name" content="Sistem Akademik Sekolah | SIAKAD" />
    <meta property="og:image" content="<?= base_url() ?>assets/media/logos/hjglogoov.jpg" />
    <link rel="manifest" href="/manifest.json">
    <link rel="canonical" href="https://digitalinsource.web.id/" />
    <link rel="shortcut icon" href="<?= base_url() ?>assets/media/logos/hjglogo-150x150.png" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="<?= base_url() ?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <style>
        /* PERUBAHAN 1: Menghapus display flex di body agar tidak bentrok dengan layout kolom */
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            width: 100%;
            /* Warna Dasar Dongker */
            background-color: #0f172a;

            /* Membuat Gradasi Biru ke Dongker */
            background-image:
                linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%),
                /* Pola Grid Tipis */
                linear-gradient(#2563eb 1px, transparent 1px),
                linear-gradient(90deg, #2563eb 1px, transparent 1px);

            /* Mengatur ukuran dan blend pola */
            background-size: 100% 100%, 40px 40px, 40px 40px;
            background-blend-mode: normal, overlay, overlay;

            /* HAPUS baris display: flex; align-items... dst disini agar layout Metronic bekerja */
            overflow-x: hidden;
        }

        /* Responsive: Sembunyikan logo footer di layar HP kecil agar tidak menutupi form */
        @media (max-height: 600px) {
            .footer-logo {
                display: none;
            }
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="bg-body">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Signup Free Trial-->
        <div class="d-flex flex-column flex-xl-row flex-column-fluid">

            <!--begin::Aside (BAGIAN KIRI - SELAMAT DATANG)-->
            <!-- PERUBAHAN 2: Menambahkan justify-content-center dan w-xl-50 -->
            <div class="d-flex flex-column flex-lg-row-fluid w-xl-50 justify-content-center align-items-center">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-center p-10 w-100">
                    <!--begin::Content-->
                    <div class="d-flex flex-column flex-center text-center">

                        <!--begin::Title-->
                        <h2 class="text-white fs-1 mb-3">Selamat datang di Sistem Akademik</h2>
                        <h1 class="text-white fs-2hx mb-5">Digital inSource</h1>
                        <!--end::Title-->

                        <!--begin::Logo-->
                        <a href="<?= base_url() ?>" class="mb-5">
                            <img alt="Logo" src="<?= base_url() ?>assets/media/logos/logodigi.png" class="w-200px w-lg-300px" />
                        </a>
                        <!--end::Logo-->

                        <!--begin::Description-->
                        <div class="fw-bold fs-4 text-gray-400">
                            Terima kasih atas kontribusi Anda yang berharga.<br>
                            Keberhasilan kita semua bergantung pada kerja keras dan dedikasi Anda.
                        </div>
                        <!--end::Description-->

                        <!--begin::Illustration (Dipindah kesini agar satu grup vertikal)-->

                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Aside-->

            <!--begin::Content (BAGIAN KANAN - FORM LOGIN)-->
            <div class="flex-row-fluid d-flex flex-center justfiy-content-xl-first p-10 w-xl-50">
                <!--begin::Wrapper-->
                <div class="d-flex flex-center bg-body p-15 shadow rounded w-100 w-md-550px mx-auto">
                    <!--begin::Form-->
                    <form class="form w-100" id="formLogin">
                        <?php if (isset($_GET["ref"])): ?>
                            <input type="hidden" name="ref" value="<?= $_GET["ref"] ?>" />
                        <?php endif; ?>
                        <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Masuk</h1>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <div class="text-gray-400 fs-5">Masuk menggunakan Username dan Password</div>
                            <!--end::Link-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <label for="nuk" class="form-label fw-bolder text-dark fs-6">Username</label>
                            <input class="form-control form-control-solid" type="text" name="username" autocomplete="off" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-7 fv-row" data-kt-password-meter="true">
                            <!--begin::Wrapper-->
                            <div class="mb-1">
                                <!--begin::Label-->
                                <label class="form-label fw-bolder text-dark fs-6">Password</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input class="form-control form-control-solid" type="password" placeholder="" name="password" autocomplete="off" />
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                        <i class="bi bi-eye-slash fs-2"></i>
                                        <i class="bi bi-eye fs-2 d-none"></i>
                                    </span>
                                </div>
                                <!--end::Input wrapper-->
                                <!--begin::Meter-->
                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                </div>
                                <!--end::Meter-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Row-->
                        <div class="fv-row">
                            <label class="form-check form-check-custom form-check-solid form-check-inline mb-5">
                                <input class="form-check-input" type="checkbox" name="toc" value="1" />
                                <span class="form-check-label fw-bold text-gray-400">Ingat Saya.
                                    <a href="#" class="link-primary ms-1">Lupa Password?</a>
                                </span>
                            </label>
                        </div>
                        <!--end::Row-->
                        <div class="fv-plugins-message-container invalid-feedback" id="error-login"></div>
                        <!--begin::Row-->
                        <div class="text-center pb-lg-0 pb-8 mt-10">
                            <button type="submit" id="btnLogin" class="btn btn-lg btn-danger fw-bolder">
                                <span class="indicator-label">Masuk</span>
                                <span class="indicator-progress">Mohon tunggu...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Row-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Right Content-->

            <!-- Logo Platform (Kanan Bawah) -->
            <div class="footer-logo" style="position: absolute; bottom: 30px; right: 40px; z-index: 10; text-align: right;">
                <!-- GANTI src dibawah ini dengan path logo DigitalInsource kamu -->
                <img src="<?= base_url() ?>assets/media/logos/logodigi.png" onerror="this.style.display='none'" alt="DigitalInsource" style="height: 40px; width: auto; margin-bottom: 5px;">
                <div class="text-white-50 fs-8">Powered by <span class="text-white fw-bolder">DigitalInsource</span></div>
            </div>
        </div>
        <!--end::Authentication - Signup Free Trial-->
    </div>
    <!--end::Main-->
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="<?= base_url() ?>assets/plugins/global/plugins.bundle.js"></script>
    <!-- <script src="<?= base_url() ?>assets/js/indexeddb-helper.js"></script> -->
    <!--end::Global Javascript Bundle-->
    <!--end::Javascript-->

    <script type="text/javascript">
        $(document).ready(async function() {

            $('#formLogin').on('submit', function(evt) {
                evt.preventDefault();
                $("#error-login").hide();
                $('#btnLogin .indicator-label').hide();
                $('#btnLogin .indicator-progress').show();
                var formdata = new FormData($('#formLogin')[0]);
                $.ajax({
                    url: '<?= base_url() ?>auth/login',
                    type: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: async function(result) {
                        $('#btnLogin .indicator-label').show();
                        $('#btnLogin .indicator-progress').hide();
                        if (result.error) {
                            $("#error-login").html(result.error).show();
                        } else {
                            // Simpan user ke IndexedDB
                            await putDB("user", {
                                id: "main",
                                result
                            });
                            // Redirect sesuai server
                            window.location.href = result.redirect;
                        }
                    },
                    error: function(result) {
                        $('#btnLogin .indicator-label').show();
                        $('#btnLogin .indicator-progress').hide();
                        alert("Koneksi tidak stabil, harap periksa internet Anda.");
                    }
                });
            });
        });
    </script>
</body>
<!--end::Body-->

</html>