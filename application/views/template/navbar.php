<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>Sistem Skripsi Online</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/web/icon.ico');?>" />

	<script src="<?php echo base_url('assets/js/fontawesome-all.js'); ?>"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">

	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/sweetalert.min.js'); ?>"></script>

	<!-- <link rel="stylesheet" href="<?= base_url('assets/css/orionicons.css')?>"> -->
    <!-- theme stylesheet-->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/style.default.css')?>" id="theme-stylesheet"> -->
    <!-- Custom stylesheet - for your changes-->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/custom.css')?>"> -->

	<script type="text/javascript">
		$("#slide").animate({
			width: 'toggle'
		}, 350);
		$(document).ready(function () {
			$("#ubahPassword").on('submit', function () {
				var form = $(this);
				var formdata = false;
				if (window.FormData) {
					formdata = new FormData(form[0]);
				}
				var formAction = $(this).attr('action');

				if (!$("input").val()) {

					$("#warning").show('fast').delay(2000).hide('fast');
					return false;

				} else {
					$.ajax({
						type: "POST",
						url: formAction,
						data: formdata ? formdata : form.serialize(),
						contentType: false,
						processData: false,
						cache: false,
						success: function (result) {
							if (result == 1) {
								$("#success").show('fast').delay(1000).hide('slow', function () {
									$("#Ubah").modal('toggle');
								});;
							} else {
								$("#failed").show('fast').delay(1000).hide('fast');
								$('input').val('');
								return false;
							}
						}
					});
					return false;
				}

			});

		});

	</script>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/myStyle.css');?>">

</head>
<?php if ($_SESSION['Status'] != 'Admin') {?>
<div class="modal fade ubah" id="Ubah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<form id="ubahPassword" method="POST" action="<?=base_url('ControllerGlobal/ubahPassword/' . $_SESSION['ID'] . '/users');?>">
					<div class="content">
						<div id="success" class="alert alert-success alert-white rounded" style="display:none;">
							<strong><i class="fas fa-check"></i> Password Berhasil di Ubah !</strong>
						</div>
						<div id="warning" class="alert alert-warning alert-white rounded" style="display:none;">
							<strong> <i class="fas fa-exclamation"></i> Peringatan !</strong>
							<br>Kata Sandi Tidak Boleh Kosong
						</div>
						<div id="failed" class="alert alert-danger alert-white rounded" style="display:none;">
							<strong><i class="fas fa-user-times"></i> Password Salah !</strong>
							<br>Kata Sandi Lama Salah!
						</div>
					</div>

					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Password Lama</label>
						<input type="password" class="form-control pass_lama" name="pass_lama">
					</div>
					<div class="form-group">
						<label for="message-text" class="col-form-label">Password Baru</label>
						<input type="Password" name="pass_baru" class="form-control pass_baru">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
						<button type="submit" class="btn btn-primary" id="buttonPassword"> <i class="fas fa-sign-in-alt"></i> Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php }?>

<body>
	<nav class="navbar navbar-expand-lg mb-4 border-bottom-4 navbar-light bg-light">
		<div class="navbar-brand col-md-5 col-7">
			<img class='mr-3' style='width: 5%; height:5%' src="<?= base_url('assets/web/Master.png')?>">
			 Sistem Skripsi Online
		</div>
		<div class="navbar-collapse collapse">
			<div class="mr-auto" style="color: white; align: text-left">
			</div>
			<span class="mr-3">
				<i class="fas fa-calendar-alt"> </i>
				<?= longdate_indo(date('Y-m-d')); ?>
			</span>
			<a <?=$_SESSION['Status']==='Admin' ? "style='display: none'" : '' ?> href="#" data-target="#Ubah" data-toggle="modal" class="btn btn-outline-primary btn-sm mr-3"><i class="fas fa-edit fa-xs"></i> Ganti Password </a>
		</div>
		<a href="<?= base_url('Home/Logout'); ?>" class="btn btn-dark btn-sm col-md-1 col-3"><i class="fas fa-sign-out-alt"></i>
			Keluar </a>
	</nav>

	<div id="beranda"></div>
</body>

</html>
