<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
	<base href="">
	<title><?= $page_title ?></title>
	<meta charset="utf-8" />
	<meta name="description" content="HRIS Harapan Jaya Goup" />
	<meta name="keywords" content="HRIS, hrd Sistem, Informasi, Aplikasi, Website, Bengkel, Harapan Jaya" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?= $page_title ?>" />
	<meta property="og:url" content="https://hjgroup.co.id/" />
	<meta property="og:site_name" content="PT. Harapan Jaya Globalindo| Bengkel Harapan Jaya" />
	<meta property="og:image" content="<?= base_url() ?>assets/media/logos/hjglogoov.jpg" />
	<link rel="manifest" href="/manifest.json">
	<link rel="canonical" href="https://hjgroup.co.id/" />
	<link rel="shortcut icon" href="<?= base_url() ?>assets/media/logos/hjglogo-150x150.png" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Global Stylesheets Bundle(used by all pages)-->
	<link href="<?= base_url() ?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Stylesheets Bundle-->
	<style>
		html,
		body {
			margin: 0;
			padding: 0;
			/* overflow: hidden; */
			/* opsional kalau emang mau strict tidak bisa scroll */
			height: 100%;
		}
	</style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="bg-body">
	<!--begin::Main-->

	<div class="d-flex justify-content-center align-items-center vh-100 position-relative"
		style="background-image: url(<?= base_url() ?>assets/media/images/hjdrone.webp);  
            background-attachment: fixed; 
            background-size: cover; 
            background-position: center center;">

		<!-- Overlay hitam transparan -->
		<div style="position: absolute; top:0; bottom:0; left:0; right:0; background: rgba(0,0,0,0.5);"></div>

		<!-- Konten Form -->
		<div class="row p-9 w-100" style="max-width: 600px; z-index: 1;">
			<div class="col-12">
				<div class="d-flex flex-center p-15 shadow bg-body rounded w-100">
					<!--begin::Form-->
					<form class="form" id="formLogin">
						<?php if (isset($_GET["ref"])): ?>
							<input type="hidden" name="ref" value="<?= $_GET["ref"] ?>" />
						<?php endif; ?>
						<!-- Heading -->
						<div class="text-center mb-5">
							<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-50px min-h-xl-100px mb-xl-3" style="background-image: url(<?= base_url() ?>assets/media/logos/logo-hjg.webp)"></div>
							<h1 class="text-dark mb-3">Masuk HRIS</h1>
							<div class="text-gray-400 fw-bold fs-4">Masuk menggunakan NUK dan Password</div>
						</div>

						<!-- Input group -->
						<div class="fv-row mb-5">
							<label for="nuk" class="form-label fw-bolder text-dark fs-6">NUK</label>
							<input class="form-control form-control-solid" type="text" name="nuk" autocomplete="off" />
						</div>

						<div class="mb-7 fv-row" data-kt-password-meter="true">
							<div class="mb-1">
								<label class="form-label fw-bolder text-dark fs-6">Password</label>
								<div class="position-relative mb-3">
									<input class="form-control form-control-solid" type="password" name="password" autocomplete="off" />
									<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
										<i class="bi bi-eye-slash fs-2"></i>
										<i class="bi bi-eye fs-2 d-none"></i>
									</span>
								</div>
								<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
									<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
									<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
									<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
									<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
								</div>
							</div>
						</div>
						<!-- Remember Me -->
						<div class="fv-row">
							<label class="form-check form-check-custom form-check-solid form-check-inline mb-5">
								<input class="form-check-input" type="checkbox" name="toc" value="1" />
								<span class="form-check-label fw-bold text-gray-700">Ingat Saya.
									<a href="#" class="link-primary ms-1">Lupa Password</a>
								</span>
							</label>
						</div>
						<!-- Error Message -->
						<div class="fv-plugins-message-container invalid-feedback" id="error-login"></div>
						<!-- Submit Button -->
						<div class="text-center pb-lg-0 pb-8">
							<button type="submit" id="btnLogin" class="btn btn-lg btn-danger fw-bolder">
								<span class="indicator-label">Masuk</span>
								<span class="indicator-progress">Mohon tunggu...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>
						</div>
					</form>
					<!--end::Form-->
				</div>
				<!--end::Wrapper-->
			</div>
		</div>
	</div>

	<!--end::Main-->
	<!--begin::Javascript-->
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="<?= base_url() ?>assets/plugins/global/plugins.bundle.js"></script>
	<script src="<?= base_url() ?>assets/js/scripts.bundle.js"></script>
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

		$(document).ready(function() {
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
					success: function(result) {
						if (result.error) {
							$("#error-login").html(result.error);
							$("#error-login").show();
							$('#btnLogin .indicator-label').show();
							$('#btnLogin .indicator-progress').hide();
						} else {
							$('#btnLogin .indicator-label').show();
							$('#btnLogin .indicator-progress').hide();
							if (result.ref) {
								window.location.href = result.ref;
							} else {
								window.location.href = "<?= base_url() ?>dashboard";
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
</body>
<!--end::Body-->

</html>