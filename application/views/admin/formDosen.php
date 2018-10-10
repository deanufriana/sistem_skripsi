<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#form_dsn_jrsn").change(function(){ 
				$("#form_dsn_ksn").hide();
				$.ajax({
					type: "POST", 
					url: "<?php echo base_url("Home/filterKonsentrasi"); ?>", 
					data: {IDJurusan : $("#form_dsn_jrsn").val()}, 
					dataType: "json",
					success: function(response){ 
						$("#div_ksn_dsn").show('fast', function() {
							$("#form_dsn_ksn").html(response.list).show();	
						});
						
					},
				});
			});

			$(".formSimpan").on('submit',
				function(e) {
					e.preventDefault();
					var form = $(this);
					var formdata = false;

					if (window.FormData) {
						formdata = new FormData(form[0]);
					}

					var formAction = form.attr('action');
					var users = form.attr('id');

					$.ajax({
						type: 'POST',
						url: formAction,
						data: formdata ? formdata: form.serialize(),
						contentType: false,
						processData: false,
						cache: false,
						beforeSend: function() {
							$('#loading').fadeIn();
						},
						success: function(result) {
							if (result == 1) {
								swal(users + " Berhasil Di Tambahkan", "Pesan Password Telah Terkirim Ke Email "+users, "success");
								$('#tabel_'+users+'_admin').load('<?php echo base_url('Admin/navigasiUsers/0/');?>'+users);	
								$('#loading').fadeOut();
							} else {
								swal("Dosen Tidak Berhasil Ditambahkan", result, "error");	
								$('#loading').fadeOut();
							}
						}
					});
				});
		}); 
	</script>
</head>
<div class="modal-body">
	<div id="loading" class="modal" style="display:none;">
		<div class="modal-dialog modal-dialog-centered ">
			<div class="alert alert-info alert-white rounded modal-content">
				<strong> <i class="fas fa-spinner fa-pulse"> </i> Sedang Memproses </strong>
			</div>
		</div>
	</div>
</div>

<form method="post" id="Dosen" action="<?php echo base_url('Admin/saveDosen');?>" class="formSimpan" enctype="multipart/form-data">
	<?php echo validation_errors(); ?>
	<div class="form-row">
		<div class="form-group col-md">
			<label>NIK</label>
			<input type="number" id="nik" name="nik" class="form-control" required>
		</div>
		<div class="form-group col-md">
			<label>Nama</label>
			<input id="nama" type="text" name="nama_dosen" class="form-control" required>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span id="nohp" class="input-group-text"><i class="fas fa-phone"></i></span>
				</div>
				<div class="custom-file">
					<input name="nohp" type="number" class="form-control" required>
				</div>
			</div>
		</div>
		<div class="form-group col">
			<select name="id_jurusan" id="form_dsn_jrsn" class="custom-select">
				<option selected>Jurusan</option>
				<?php foreach ($jurusan->result() as $j) { ?>  
					<option value="<?php echo $j->IDJurusan;?>"><?php echo $j->Jurusan;?></option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group col" id="div_ksn_dsn" style="display: none">
			<select name="konsentrasi" id="form_dsn_ksn"  class="custom-select">
			</select>
		</div>

		<div class="form-group col-md">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text"> <i class="fas fa-envelope m-1"></i></span>
				</div>
				<div class="custom-file">
					<input id="email" name="email" type="email" class="form-control" required>
				</div>
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-10">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text">Upload</span>
				</div>
				<div class="custom-file">
					<input id="foto" name="foto" type="file" class="custom-file-input" required>
					<label for="foto" class="custom-file-label" for="inputGroupFile01">Choose file</label>
				</div>
			</div>
		</div>
		<div class="form-group col-md">
			<button class="btn btn-primary" type="submit" id="daftar"> Simpan </button>					
		</div>
	</div>

</form>
</html>