<!DOCTYPE html>
<html>
<head>
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
		});

		function readUrl(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#blah').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		$("#foto").change(function() {
			readUrl(this);
		});
	</script>
</head>
<?php if (!$konsentrasi) {?>
	<div class='container-fluid mt-5'>
		<div class='row align-items-center'>
			<div class='col-md'>
				<h2>Maafkan Saya Admin</h2>
				Data Dosen Belum Bisa Dimasukan Sebelum Data Jurusan & Konsentrasi Dimasukan.
			</div>
			<div class='col-md-3'>
				<img src="<?=base_url('assets/web/sad.jpg')?>">
			</div>
		</div>
	</div>
<?php } else {?>
	<form method="post" id="Dosen" action="<?=base_url('Admin/saveUsers/' . $user);?>" class="formSimpan">
					<div class="form-row">
						<div class="form-group col-md">
							<input type="number" id="nik" name="id" class="form-control" placeholder="ID <?=$user?>" required>
						</div>
						<div class="form-group col-md">
							<input id="nama" type="text" name="name" class="form-control" placeholder='Nama' required>
						</div>
						<div class="form-group col-md">
							<select name="id_jurusan" id="form_dsn_jrsn" class="custom-select">
								<option selected>Jurusan</option>
								<?php foreach ($jurusan->result() as $j) {?>
									<option value="<?php echo $j->IDJurusan; ?>"><?php echo $j->Jurusan; ?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group col-md" id="div_ksn_dsn" style="display: none">
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
						<div class="form-group col-md-auto">
							<button class="btn btn-primary" type="submit" id="daftar"> <i class='fas fa-plus'></i> </button>
						</div>
					</div>
	</form>
<?php }?>

</html>