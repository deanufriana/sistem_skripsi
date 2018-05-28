<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title> Sistem Informasi Skripsi</title>
	<script src="<?= base_url('assets/js/fontawesome-all.js');?>"></script>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css');?>">
	<script type="text/javascript" src="<?= base_url('assets/js/jquery.js');?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js');?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/sweetalert.min.js');?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/jquery.validate.min.js');?>"></script>
	
	<script type="text/javascript">

		$(document).ready(function(){
			$("#form-lupa").on('submit',
				function(e) {
					e.preventDefault();
					var form = $(this);
					var formdata = false;
					if (window.FormData) {
						formdata = new FormData(form[0]);
					}

					var formAction = form.attr('action');

					$.ajax({
						type: 'POST',
						url: formAction,
						data: formdata ? formdata: form.serialize(),
						contentType: false,
						processData: false,
						cache: false,
						beforeSend: function() {
							$('#form-lupa').hide('slow');
							$('#loading').show();
						},
						success: function(result) {
							if (result == 1) {
								swal("Pengaturan Ulang Password Telah Di Kirim Ke Email Anda!", "Silahkan masuk ke email", "success");
								$('#loading').hide();
								$('#form-login').fadeIn('slow');
							} else {
								swal("Gagal!", "Silahkan Cek Internet Anda / Coba Lagi Nanti", "error");
								$('#loading').hide();
								$('#form-lupa').show('fast');
							}
						}
					});
				});

			$(".daftar").click(function(event) {
				$("#umus").toggle('fast', function () {
					$("#form_daftar").toggle('slow');
					$("#form-login").toggle('slow');
					$("#log").toggle('fast');
				});
			});

			$("#btn-forget").click(function(event) {
				$("#form-forget").toggle('slow');
				$("#form-login").toggle('fast');
			});


			$('#form_daftar').load('<?= base_url('home/pendaftaran');?>');

			$(function() {
				$("#login").click(function() {
					$('#success').toggle('fast').delay(9000);
				});
			})



			$("#btn-login").click(function(){
				var formAction = $("#form-login").attr('action');
				var datalogin = {
					nim: $("#nim").val(),
					password: $("#password").val()
				};

				if (!$("#nim").val() || !$("#password").val()) {
					$("#warning").fadeIn('fast').delay(2000).fadeOut('fast');
					return false;
				} else {
					$.ajax({
						type: "POST",
						url: formAction,
						data: datalogin,
						beforeSend: function() {
							$('#loading').fadeIn();
						},
						success: function(result) {
							if(result == 1) {
								$('#loading').fadeOut('slow');
								$("#success").fadeIn('fast');
								setTimeout(function() {
									window.location = '<?= base_url('Dosen');?>'
								}, 1000);
							} else {
								if (result == 2) {
									$('#loading').fadeOut('slow');
									$("#success").show('fast');
									setTimeout(function() {
										window.location = '<?= base_url('Mahasiswa');?>'
									}, 1000);
								} else {
									if (result == 3) {
										$('#loading').fadeOut('slow');
										$("#success").fadeIn('fast');
										setTimeout(function() {
											window.location = '<?= base_url('Kaprodi');?>'
										}, 1000);
									} else {
										if (result == 4) {
											$('#loading').fadeOut('slow');
											$("#success").fadeIn('fast');
											setTimeout(function() {
												window.location = '<?= base_url('Admin');?>'
											}, 1000);
										} else {
											if (result == 0) {
												$('#loading').fadeOut('slow');
												$("#not").fadeIn('fast').delay(2000).fadeOut('fast');
												return false;	
											} else {
												$('#loading').fadeOut('slow');
												$("#failed").fadeIn('fast').delay(2000).fadeOut('fast');
												return false;	
											}
											
										}
										
									}
								} 
							} 
						}
					});
					return false;
				}
			});
		});

	</script>

	<style type="text/css">
	
	.bs-docs-footer {
		padding-top: 3rem;
		padding-bottom: 5.5rem;
		margin-top: 6rem;
		color: #99979c;
		text-align: left;
		background-color: #2a2730;
	}

	.hr {
		display: block;
		padding: .5rem 1rem;
	}
</style>
</head>
<body class="m-3">
	<div class="container-fluid">
		<div class="col-md">
			<h4><i class="fas fa-book"></i> SISTEM SKRIPSI ONLINE</h4>
		</div>
		<hr>
		<div class="row"> 
			<div id="umus" class="col-md text-justify">
				<div> 
					<header>Alur Skripsi Online</header>
					<p> 
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</p>
				</div>
				<br>
			</div>

			<div class="col-md">
				<div class="modal-content">
					<div class="modal-body">
						<div id="loading" class="modal" style="display:none;">
							<div class="modal-dialog modal-dialog-centered ">
								<div class="alert alert-info alert-white rounded modal-content">
									<strong> <i class="fas fa-spinner fa-pulse"> </i> Sedang Memproses </strong>
								</div>
							</div>
						</div>


						<div id="success" class="modal" style="display:none;">
							<div class="modal-dialog modal-dialog-centered ">
								<div class="alert alert-success alert-white rounded modal-content">
									<strong> <i class="fas fa-check"></i> Login Success !</strong>
									Halaman akan dialihkan dalam waktu 3 detik! 
								</div>
							</div>
						</div>

						
						<div id="warning" class="modal" style="display:none;">
							<div class="modal-dialog modal-dialog-centered ">
								<div class="alert alert-warning alert-white rounded modal-content">
									<strong> <i class="fas fa-exclamation"></i> Peringatan !</strong>
									Nama akun dan/atau kata sandi tidak boleh kosong!
								</div>
							</div>
						</div>

						<div id="failed" class="modal" style="display:none;">
							<div class="modal-dialog modal-dialog-centered ">
								<div class="alert alert-failed alert-white rounded modal-content">
									<strong><i class="fas fa-user-times"></i> Login gagal !</strong>
									Nama akun dan/atau kata sandi salah!
								</div>
							</div>
						</div>

						<div id="not" class="modal" style="display:none;">
							<div class="modal-dialog modal-dialog-centered ">
								<div class="alert alert-failed alert-white rounded modal-content">
									<strong><i class="fas fa-user-times"></i> Pendaftaran Belum Di Konfirmasi / Anda Belum Skripsi !</strong>
									Silahkan Cek Ke Fakultas Untuk Informasi Lebih Lanjut!
								</div>
							</div>
						</div>				


						<form id="form-login" method="POST" action="<?= base_url('Home/session');?>">
							
							<div class="form-group">
								<input type="text" placeholder="NIM / Email" class="form-control" id="nim" name="nim">
							</div>
							<div class="form-row">
								<div class="form-group col-md">
									<input type="Password" id="password" placeholder="Password" name="password" class="form-control">
									<small class="form-text text-muted"> Belum Punya Akun? Silahkan <a href="#" class="daftar"> Daftar </a> & Tunggu Konfirmasi Dari Fakultas <br> Atau malah lupa passwordnya? <a href="#" id="btn-forget">Reset Password</a> </small>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary float-right" id="btn-login"> <i class="fas fa-sign-in-alt"></i> Login</button>
								</div>
							</div>
						</form>

						<form id="form_forget" action="<?= base_url('home/lupa');?>" style="display: none">
							<div id="lupa" class="row">
								<div class="form-group col-md">
									<input class="form-control" type="email" name="email" placeholder="Masukan Email">
									<small>Silahkan Masukan Email Untuk Mereset Password</small>
								</div>
								<div class="form-group col-3">
									<input class="btn btn-primary" type="submit" name="btnSubmit" value="Submit" />								
								</div>

							</div>
						</form>   

						<div id="form_daftar" style="display: none;">
						</div>
						<div id="log" style="display: none;">
							<small class="form-text text-muted" id="text-login"> Sudah Punya Akun? Silahkan <a href="#" class="daftar" > Login </a>  </small>	
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-md">
				<div class="form-row">
					<div class="form-group col-md-2">
						<img class="img-thumbnail" src="<?= base_url('assets/images/avatar.png');?>">
					</div>

					<div class="form-group col">
						<h6>Header</h6>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation 
					</div>
				</div>

			</div>
			<div class="col-md">
				<div class="form-row">
					<div class="form-group col-md-2">
						<img class="img-thumbnail" src="<?= base_url('assets/images/avatar.png');?>">
					</div>
					
					<div class="form-group col">
						<h6>Header</h6>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation 
					</div>
				</div>
				
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-md">
				<div class="form-row">
					<div class="form-group col-md-2">
						<img class="img-thumbnail" src="<?= base_url('assets/images/avatar.png');?>">
					</div>

					<div class="form-group col">
						<h6>Header</h6>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation 
					</div>
				</div>

			</div>
			<div class="col-md">
				<div class="form-row">
					<div class="form-group col-md-2">
						<img class="img-thumbnail" src="<?= base_url('assets/images/avatar.png');?>">
					</div>
					<div class="form-group col">
						<h6>Header</h6>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation 
					</div>
				</div>	
			</div>
		</div>
	</div>	
</body>
<br>
</html>