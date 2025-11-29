<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
	<base href="">
	<title><?= $page_title ?></title>
	<meta charset="utf-8" />
	<meta name="description" content="Smart CRM PT. Harapan Jaya Anugrah." />
	<meta name="keywords" content="CRM, Customer Relation Manager, Sistem, Informasi, Aplikasi, Website, Bengkel, Harapan Jaya" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?= $page_title ?>" />
	<meta property="og:url" content="https://hjgroup.co.id/" />
	<meta property="og:site_name" content="Harapan Jaya | Bengkel Harapan Jaya" />
	<link rel="canonical" href="https://hjgroup.co.id/" />
	<link rel="shortcut icon" href="<?= base_url() ?>assets/media/logos/android-chrome-512x512.png" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Global Stylesheets Bundle(used by all pages)-->
	<link href="<?= base_url() ?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/css/style.bundle.css?v=<?= time() ?>" rel="stylesheet" />
	<script src="<?= base_url() ?>assets/js/scripts.bundle.js?v=<?= time() ?>"></script>

	<!--end::Global Stylesheets Bundle-->

	<link rel="manifest" href="<?= base_url() ?>manifest.json">
	<link rel="apple-touch-icon" href="<?= base_url() ?>pwa/apple-touch-icon.png">
	<meta name="theme-color" content="#f1416c">

</head>
<!--end::Head-->
<!--begin::Body-->

<body class="bg-body">
	<!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Authentication - Signup Free Trial-->
		<div class="d-flex flex-column flex-xl-row flex-column-fluid">
			<!--begin::Aside-->
			<div class="d-flex flex-column flex-lg-row-fluid">
				<!--begin::Wrapper-->
				<div class="d-flex flex-row-fluid flex-center p-10">
					<!--begin::Content-->
					<div class="d-flex flex-column flex-center text-center">
						<!--begin::Title-->
						<h2 class="text-dark fs-1 mb-3">Selamat datang di</h2>
						<h2 class="text-dark fs-1 mb-3">Sistem Informasi Akademik Sekolah</h2>
						<h1 class="text-dark fs-2hx mb-5">(SISKA)</h1>
						<!--end::Title-->
						<!--begin::Logo-->
						<a href="<?= base_url() ?>" class="mb-5">
							<img alt="Logo" src="<?= base_url() ?>assets/media/logos/logo-siska.png" class="w-200px w-lg-300px" />
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
			<!--begin::Aside-->
			<!--begin::Content-->
			<div class="flex-row-fluid d-flex flex-center justfiy-content-xl-first p-10">
				<!--begin::Wrapper-->
				<div class="d-flex flex-center bg-body p-15 shadow rounded w-100 w-md-550px mx-auto ms-xl-20">
					<!--begin::Form-->
					<form class="form" id="formLogin">
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
							<label for="username" class="form-label fw-bolder text-dark fs-6">Username</label>
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
									<!-- <a href="#" class="link-primary ms-1">Lupa Password?</a> -->
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
		</div>
		<!--end::Authentication - Signup Free Trial-->
	</div>
	<!--end::Main-->
	<!--begin::Javascript-->
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="<?= base_url() ?>assets/plugins/global/plugins.bundle.js"></script>
	<script src="<?= base_url() ?>assets/js/indexeddb-helper.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/eruda"></script>
  <script>
    eruda.init();
  </script> -->
	<!--end::Global Javascript Bundle-->
	<!--end::Javascript-->

	<script type="text/javascript">
		if ('serviceWorker' in navigator) {
			window.addEventListener('load', function() {
				navigator.serviceWorker.register('/service-worker.js')
					.then(function(registration) {
						console.log('Service Worker registered with scope:', registration.scope);
					}, function(err) {
						console.log('Service Worker registration failed:', err);
					});
			});
		}

		// fungsi cek user dari IndexedDB
		async function checkCachedUser() {
			const cached = await getAllFromDB("user");
			const mainUser = cached.find(item => item.id === "main");
			if (mainUser && mainUser.result) {
				console.log("User available (cached)");
				window.location.href = "<?= base_url("dashboard") ?>";
			} else {
				console.log("User unavailable (cached)");
			}
		}

		$(document).ready(async function() {
			// kalau OFFLINE
			if (!navigator.onLine) {
				console.log("Offline mode detected");
				await checkCachedUser();
			} else if (navigator.connection && ["slow-2g", "2g", "3g"].includes(navigator.connection.effectiveType)) {
				// kalau ONLINE tapi lambat
				console.log("Slow connection detected:", navigator.connection.effectiveType);
				await checkCachedUser();
			}

			// event listener kalau status online/offline berubah
			window.addEventListener("offline", checkCachedUser);

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