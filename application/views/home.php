<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/images/fix/book.ico');?>" />
	
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

			$('#tabelformDaftar').load('<?= base_url('Home/formDaftar');?>');

			$(function() {
				$("#login").click(function() {
					$('#success').toggle('fast').delay(9000);
				});
			})

			$("#Daftar").on('click', function() {
				$('#tabelformDaftar').toggle('fast');
				$('#informasi').toggle('fast');
			});

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
							$('#loading').fadeOut('slow');
							if (result <= 4) {
								$("#success").fadeIn('fast');	
							} else {
								$("#failed").fadeIn('fast').delay(2000).fadeOut('fast');
							}
							var user;
							switch (result) {
								case '1': 
								user = 'Dosen';
								break;
								case '2':
								user = 'Mahasiswa';
								break;
								case '3':
								user = 'Kaprodi';
								break;
								case '4':
								user = 'Admin';
								break;
								default:
								return false;
							}
							setTimeout(function() {
								window.location = "<?= base_url();?>"+user
							}, 1000);

						}
					});
					return false;
				}
			});


		});
	</script>
</head>
<body class="m-3">
	<div class="container-fluid">
		<div class="row"> 
			<div id="deskripsi" class="col-md text-justify">
				<div> 
					<div>
						<div class="row">
							<div class="col-md">
								<h5><i class="fas fa-book fa-sm"></i> SISTEM INFORMASI SKRIPSI ONLINE </h5>
								Proses skripsi menjadi lebih teratur dan cepat yang dilakukan secara online yang bisa diakses dimana saja melalui browser dengan bertujuan menghemat waktu, tenaga dan memudahkan mendapatkan informasi proses skripsi secara Online.
							</div>
							<div class="col-md-5">
								<form id="form-login" method="POST" action="<?= base_url('Home/session');?>">
									<div class="form-row mt-3">
										<div class="form-group col-md">
											<input type="text" placeholder="NIM / Email" class="form-control" id="nim" name="nim">
										</div>
										<div class="form-group col-md">
											<input type="Password" id="password" placeholder="Password" name="password" class="form-control">
										</div>
									</div>
									<div class="text-center">
										<button type="submit" class="btn btn-primary float-right ml-3" id="btn-login"> <i class="fas fa-sign-in-alt"></i> Login</button>
									</div>
									<small class="form-text text-muted"> Belum Punya Akun? Silahkan <a id="Daftar" href="#" class="daftar text-primary"> Daftar </a> & Tunggu Konfirmasi Dari Fakultas </small>
								</form>
							</div>
						</div>
						<hr>
					</div>
				</div>
			</div>
		</div>
		<div class="row m-1" id="informasi">
			<div class="col-md-6">
				<div class="form-row">
					<div class="form-group col-md-2 col-2 m-1">
						<img class="img-fluid" src="<?= base_url('assets/images/fix/book.png');?>">
					</div>

					<div class="form-group col small">
						<h6>Data Tersimpan Rapi</h6>
						Data skripsi mahasiswa akan tersimpan di dalam sistem yang memudahkan kepala program pendidikan atau admin dalam mencari data skripsi lama yang mungkin dibutuhkan untuk refrensi saat mahasiswa tingkat selanjutnya membutuhkan refrensi skripsi atau sekedar membandingkan dengan skripsi sebelumnya
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-row">
					<div class="form-group col-md-2 col-2 m-1">
						<img class="img-fluid" src="<?= base_url('assets/images/fix/kartu.png');?>">
					</div>

					<div class="form-group col small">
						<h6>Tidak Akan Ada Lagi Kehilangan Kartu Bimbingan</h6>
						Kartu bimbingan merupakan hal wajib bagi setiap mahasiswa untuk melakukan bimbingan dengan dosen pembimbing, oleh karena itu kartu bimbingan dibuat online dimana dosen pembimbing bisa memberi catatan pada mahasiswa yang bisa dicetak saat dibutuhkan, yang dilengkapi dengan fitur QR_Code bisa dipastikan keaslian kartu bimbingan dan dosen maupun kaprodi bisa melihat perkembangan skripsi mahasiswa.
					</div>
				</div>

			</div>
			<div class="col-md-6">
				<div class="form-row">
					<div class="form-group col-md-2 col-2 m-1">
						<img class="img-fluid" src="<?= base_url('assets/images/fix/waktu.png');?>">
					</div>

					<div class="form-group col small">
						<h6>Efisien Waktu & Tenaga</h6>
						Pengajuan judul mahasiswa merupakan proses yang membutuhkan banyak waktu dan tenaga dimana mahasiswa harus datang ke kampus untuk melakukan pengajuan judul skripsi yang ingin diajukan dimana belum tentu skripsi tersebut akan disetujui oleh kaprodi, pengajuan secara online menghemat waktu dan tenaga mahasiswa dimana mahasiswa juga akan mendapatkan informasi diterima tidaknya judul yang diajukan
					</div>
				</div>

			</div>
			<div class="col-md-6">
				<div class="form-row">
					<div class="form-group col-md-2 col-2 m-1">
						<img class="img-fluid" src="<?= base_url('assets/images/fix/pemberitahuan.png');?>">
					</div>

					<div class="form-group col small">
						<h6> Pemberitahuan </h6>
						Terkadang kaprodi kesulitan memberikan informasi kepada mahasiswa maupun dosen pembimbing terkait jadwal seminar / sidang, pengajuan judul yang diterima dikarenakan banyaknya mahasiswa maupun dosen yang harus dihubungi belum lagi jika kaprodi tidak memiliki nomer yang bisa dihubungi, dengan memanfaatkan fitur ini mahasiswa akan mendapatkan pemberitahuan tentang jadwal maupun ide skripsi yang diajukan.
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div>
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
					<div id="tabelformDaftar" style="display: none;">
					</div>
					<div id="log" style="display: none;">
						<small class="form-text text-muted" id="text-login"> Sudah Punya Akun? Silahkan <a href="#" class="daftar text-primary"> Login </a>  
						</small>	
					</div>
				</div>
			</div>
		</div>
	</div>	
</body>
</html>