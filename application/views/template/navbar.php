<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<title>Sistem Skripsi Online</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/images/fix/book.ico');?>" />

	<script src="<?php echo base_url('assets/js/fontawesome-all.js');?>"></script> 
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/clockpicker.css');?>">
	
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/sweetalert.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/clockpicker.js');?>"></script>

	<script type="text/javascript">

		$("#slide").animate({width:'toggle'},350);

		$("#buttonPassword").click(function(){
			var formAction = $(".login").attr('action');
			var datalogin = {
				pass_lama: $(".pass_lama").val(),
				pass_baru: $(".pass_baru").val()
			};

			if (!$(".pass_lama").val() || !$(".pass_baru").val()) {
				$("#warning").show('fast').delay(2000).hide('fast');
				return false;
			} else {
				$.ajax({
					type: "POST",
					url: formAction,
					data: datalogin,
					success: function(result) {
						if(result == 1) {
							$("#success").show('fast').delay(1000).hide('slow', function() {
								$("#Ubah").modal('toggle');						
							});;
						}
						else {
							$("#failed").show('fast').delay(1000).hide('fast');
							$('#pass_lama').val('');
							$('#pass_baru').val('');
							return false;
						}
					}
				});
				return false;
			}
		});

		$(document).ready(function(){
			
			$(".btn-menu").click(function(event) {
				$(".menu").toggle('slow');
			});

			$("#jurusan").change(function(){ 
				$("#konsentrasi").hide();
				$.ajax({
					type: "POST", 
					url: "<?php echo base_url("home/konsentrasi"); ?>", 
					data: {id_fakultas : $("#jurusan").val()}, 
					dataType: "json",
					async:false,
					beforeSend: function(e) {
						if(e && e.overrideMimeType) {
							e.overrideMimeType("application/json;charset=UTF-8");
						}
					},
					success: function(response){ 
						$("#konsentrasi").html(response.list_kota).show();
					},
				});
			});
		});

	</script>

	<style type="text/css">

	h1 {
		font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif;
		font-size: 24px;
		font-style: normal;
		font-variant: normal;
		font-weight: 500;
		line-height: 26.4px;
	}
	h3 {
		font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif;
		font-size: 14px;
		font-style: normal;
		font-variant: normal;
		font-weight: 500;
		line-height: 15.4px;
	}
	p {
		font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif;
		font-size: 14px;
		font-style: normal;
		font-variant: normal;
		font-weight: 400;
		line-height: 20px;
	}
	blockquote {
		font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif;
		font-size: 21px;
		font-style: normal;
		font-variant: normal;
		font-weight: 400;
		line-height: 30px;
	}
	pre {
		font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif;
		font-size: 13px;
		font-style: normal;
		font-variant: normal;
		font-weight: 400;
		line-height: 18.5714px;
	}

	.bayang {
		border: none;
		/* top    */ border-top: 1px solid #ccc;
		/* middle */ background-color: #ddd; color: #ddd;
		/* bottom */ border-bottom: 1px solid #eee;
		height: 2px;
		*height: 3px; /* IE6+7 need the total height */
		/* the rest of your styling */
	}
	.scroll {
		overflow-y: auto;
	}

	.navigasi{
		box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2), 0 3px 10px 0 rgba(0, 0, 0, 0.19);
		background-color: #2a2730; 
		color: #dfe6e9;
	}

	#table-wrapper {
		position:relative;
	}

	#table-wrapper table {
		width:100%;

	}

	#table-wrapper table thead th .text {
		position:absolute;   
		top:-20px;
		z-index:2;
		height:10rem;
		width:35%;
	}

	.loader {
		border: 16px solid #f3f3f3;
		border-radius: 50%;
		border-top: 16px solid blue;
		border-right: 16px solid green;
		border-bottom: 16px solid red;
		width: 120px;
		height: 120px;
		-webkit-animation: spin 2s linear infinite;
		animation: spin 2s linear infinite;
		position: absolute;
		right: 50%;
		left: 50%;
		position: absolute;
		margin-left: auto;
		margin-right: auto;
	}

	@-webkit-keyframes spin {
		0% { -webkit-transform: rotate(0deg); }
		100% { -webkit-transform: rotate(360deg); }
	}

	@keyframes spin {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(360deg); }
	}

</style>
</head>
<div class="modal fade ubah" id="Ubah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<form class="login" method="POST" action="<?= base_url('ControllerGlobal/ubahPassword/'.$_SESSION['ID'].'/users');?>">
					<div class="content">
						<div id="success" class="alert alert-success alert-white rounded" style="display:none;">
							<strong><i class="fas fa-check"></i> Password Berhasil di Ubah !</strong>
						</div>
						<div id="warning" class="alert alert-warning alert-white rounded" style="display:none;">
							<strong> <i class="fas fa-exclamation"></i> Peringatan !</strong>
							<br>Kata Sandi Tidak Boleh Kosong
						</div>
						<div id="failed" class="alert alert-danger alert-white rounded"style="display:none;">
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
<body>
	<nav class="navbar navbar-expand-lg mb-3 border-bottom-1 border">
		
		<div class="navbar-brand navbar-nav m-1">
			<h5><i class="fas fa-book"></i> SISTEM SKRIPSI ONLINE</h5>
		</div>
		<div class="navbar-collapse collapse">
			<span class="text-right col"><i class="fas fa-calendar-alt"> </i>   
				<?php echo longdate_indo(date('Y-m-d'));?> </span>	
			</div>
			<div class="m-1 float-right">
				<a href="#" data-target="#Ubah" data-toggle="modal" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit fa-xs"></i> Ganti Password </a>	
				<a href="<?php echo base_url('Home/Logout');?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-sign-out-alt"></i> Keluar </a>
			</div>
		</nav>
		<div id="beranda">

		</div>
	</body>
	</html>