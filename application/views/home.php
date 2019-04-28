
<head>
	<link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/web/icon.ico');?>" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title> Sistem Informasi Skripsi</title>
	<script src="<?=base_url('assets/js/fontawesome-all.js');?>">
	</script>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.min.css');?>">
	
	<script type="text/javascript" src="<?=base_url('assets/js/jquery.js');?>">
	</script>
	
	<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js');?>">
	</script>
	
	<script type="text/javascript" src="<?=base_url('assets/js/sweetalert.min.js');?>">
	</script>

	<script type="text/javascript" src="<?=base_url('assets/js/jquery.validate.min.js');?>">
	</script>

	<script type="text/javascript">
		$(document).ready(function () {

			$("#btn-login").click(function () {
				var formAction = $("#form-login").attr('action');
				var datalogin = {
					nim: $("#nim").val(),
					password: $("#password").val()
				};

				if (!$("#nim").val() || !$("#password").val()) {
					swal({text: 'Username atau password tidak boleh kosong', button: false})
					return false;
				} else {
					$.ajax({
						type: "POST",
						url: formAction,
						data: datalogin,
						beforeSend: function () {
							$('#loading').fadeIn();
						},
						success: function (result) {
							$('#loading').fadeOut('slow');
							if (result <= 4) {
								swal({title: 'Login Berhasil !',text: 'Anda akan diahlihkan selama 3 detik', button: false});
							} else {
								swal({title: 'Login Gagal !',text: 'Username atau password salah !', button: false, icon: 'error', timer: 2000})
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
							setTimeout(function () {
								window.location = "<?=base_url();?>" + user
							}, 1000);

						}
					});
					return false;
				}
			});

		});

	</script>
</head>

<body style="background-image: url('https://cdn.csu.edu.au/__data/assets/image/0006/2875965/M_Inclusive_Education_Banner_01.jpg'); background-size: cover"
 class="align-items-center">
	<div class="container col-md-3 col-11 col-sm-7" style="height: 100%; display: table;">
		<form id="form-login" action="<?=base_url('Home/session');?>" method="POST" style="vertical-align: middle; display: table-cell; ">
			<div class="card card-body">
				<h6> Sistem Skripsi Online</h6>
				<input name="nim" id="nim" type="text" class="form-control form-group" placeholder="username">
				<input name="password" id="password" type="password" class="form-control form-group" placeholder="password">
				
					<small class="form-text text-muted mb-3"> username dan password diberikan melalui email masing masing yang telah diisi mahasiswa silahkan ajukan form ke fakultas  </small>
				<button id='btn-login' type="submit" class="btn btn-primary">Login</button>
			</div>
		</form>
	</div>
</body>

<div id="loading" class="modal" style="display:none; background-color:rgba(0, 0, 0, 0.5);">
	<div class="modal-dialog modal-dialog-centered ">
		<div class="alert alert-info alert-white rounded modal-content">
			<strong> <i class="fas fa-spinner fa-pulse"> </i> Sedang Memproses </strong>
		</div>
	</div>
</div>
<div id="success" class="modal" style="display:none; background-color:rgba(0, 0, 0, 0.5);">
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

<form id="form_forget" action="<?=base_url('home/lupa');?>" style="display: none">
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
	<small class="form-text text-muted" id="text-login"> Sudah Punya Akun? Silahkan <a href="#" class="daftar text-primary">
			Login </a>
	</small>
</div>