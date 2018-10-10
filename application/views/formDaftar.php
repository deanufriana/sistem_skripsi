<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#jurusan").change(function(){ 
				$("#konsentrasi").hide();
				$.ajax({
					type: "POST", 
					url: "<?= base_url("Home/filterKonsentrasi"); ?>", 
					data: {IDJurusan : $("#jurusan").val()}, 
					dataType: "json",
					success: function(response){ 
						$("#konsen").show('fast', function() {
							$("#konsentrasi").html(response.list).show();	
						});
					},
				});
			});

			$("#menDaftar").on('submit',
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
						success: function(result) {
							if (result != 0) {
								swal("Pendaftaran Berhasil!", "Silahkan Konfirmasi Ke Fakultas Untuk Mendapatkan Validasi", "success");				
							} else {
								swal("Pendaftaran Gagal!", "Silahkan Coba Lagi Nanti", "error");


							}
							
						}
					});
				});
		});

	</script>
</head>
<body>
	<div>
		<div>
			<div>
				<form method="post" id="menDaftar" action="<?php echo base_url('Home/daftarMahasiswa');?>" enctype="multipart/form-data">
					<div class="form-row">
						<div class="form-group col-md">
							<input minlength="11" type="number" id="nim" placeholder="NIM" name="nim" class="form-control" title="Mohon Masukan 11 Digit" required>
						</div>
						<div class="form-group col-md">
							<input id="nama" type="text" placeholder="Nama" name="nama" class="form-control" required>
						</div>
						<div class="form-group col-md">
							<select id="jurusan" name="jurusan" class="form-control">
								<option>Pilih Jurusan</option>
								<?php
								foreach($jurusan->result() as $data) {
									echo "<option value='".$data->IDJurusan."'>".$data->Jurusan."</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group col-md" style="display: none" id="konsen">
							<select style="display: none" id="konsentrasi" name="konsentrasi" class="form-control">
							</select>
						</div>
					</div>
					<div class="form-row">
					</div>  

					<div class="form-row">
						<div class="form-group col-md">
							<div class="input-group">
								<div class="input-group-prepend">
									<span id="nohp" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
								</div>
								<div class="custom-file">
									<input name="nohp" type="number" class="form-control" placeholder="No HP" required>
								</div>
							</div>
						</div>
						<div class="form-group col-md">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-envelope"></i></span>
								</div>
								<div class="custom-file">
									<input id="email" name="email" type="email" placeholder="Email" class="form-control"required>
								</div>
							</div>
						</div>
						<div class="form-group col-md">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-image"></i></span>
								</div>
								<div class="custom-file">
									<input id="foto" name="foto" type="file" class="custom-file-input" id="inputGroupFile01" value="$foto['file_name']" required>
									<label for="foto" class="custom-file-label" for="inputGroupFile01">Pilih Gambar</label>
								</div>
							</div>

						</div>
					</div>

					<div class="float-right">
						<button class="btn btn-primary" type="submit" id="daftar"> <i class="fas fa-sign-in-alt"></i> Daftar </button>					
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>