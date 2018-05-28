<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<title></title>

	<script src="<?php echo base_url('assets/js/fontawesome-all.js');?>"></script> 
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/clockpicker.css');?>">
	
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>

	
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.tabledit.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/sweetalert.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/clockpicker.js');?>"></script>

	<script type="text/javascript">

		$("#slide").animate({width:'toggle'},350);

		function checkPasswordMatch() {
			var password = $("#password").val();
			var confirmPassword = $("#ulangpassword").val();

			if (password != confirmPassword)
				$("#divCheckPasswordMatch").html("Passwords do not match!");
			else
				$("#divCheckPasswordMatch").html("Passwords match.");

		}

		$(document).ready(function(){
			
			$(".btn-menu").click(function(event) {
				$(".menu").toggle('slow');
			});


			$(".hapus").click(function(e) {
				e.preventDefault();
				var form = $(this);
				var formdata = false;
				if (window.FormData) {
					formdata = new FormData(form[0]);
				}	
				swal({
					title: "Apa Kau Yakin Ingin Mengapusnya?",
					text: "Sekali dihapus, kau tidak akan bisa mengembalikannya kembali!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
						$.ajax({
							type: 'POST',
							url: form.attr('href'),
							data: formdata ? formdata: form.serialize(),
							contentType: false,
							processData: false,
							cache: false,
							success: function() {
								location.reload();
							}
						});
					} else {
						swal("Tidak Jadi Di Hapus!");
					}
				});
			});

			$("#jurusan").change(function(){ 
				$("#konsentrasi").hide();
				$.ajax({
					type: "POST", 
					url: "<?php echo base_url("home/konsentrasi"); ?>", 
					data: {id_fakultas : $("#jurusan").val()}, 
					dataType: "json",
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


			
			<?php if ($this->uri->segment('1') == "Kaprodi") {
				echo "var status = $('#status').val();
				$('#beranda').load('".base_url()."'+status);";
			} ?>

			

			$("#status").change(function(){ 
				var status = $("#status").val();
				$('#beranda').load('<?php echo base_url();?>'+status);					

			});
		});

		$(document).ready(function () {
			$("#txtConfirmPassword").keyup(checkPasswordMatch);
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
		overflow: scroll;
		height: 25rem;
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
</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg mb-3 border-bottom-1 border">
		<div class="container-fluid">
			<div class="navbar-brand navbar-nav m-1">
				<h5><i class="fas fa-book"></i> SISTEM SKRIPSI ONLINE</h5>
			</div>
			<div class="navbar-collapse collapse">
				<span class="text-right col"><i class="fas fa-calendar-alt"> </i>   
					<?php echo longdate_indo(date('Y-m-d'));?> </span>	
				</div>
				<div <?php if ($this->uri->segment('1') != 'Kaprodi') {
					echo "style='display: none'";
				}?>>
				<select class="custom-select" id="status">
					<option value="kaprodi/beranda">Kaprodi</option>
					<option value="dosen/beranda">Dosen</option>
				</select>
			</div>
			<div class="m-1 float-right">
				<a href="<?php echo base_url('Home/Logout');?>" class="btn btn-outline-primary"><i class="fas fa-sign-out-alt"></i> Keluar </a>
			</div>
		</div>
	</nav>
	<div id="beranda" <?php if ($this->uri->segment(3) != '') {
		echo "style='display: none'";
	} 
	?> >

</div>
</body>
</html>