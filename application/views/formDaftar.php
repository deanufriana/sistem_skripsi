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
<body>
	<?php if ($konsentrasi) { ?>
		<form method="post" id="tabelDaftar" action="<?php echo base_url('Home/daftarMahasiswa');?>" enctype="multipart/form-data">
			<div class="row">

				<div class="col-md-2">
					<img class="card-img-top" id="blah" src="<?= base_url('assets/web/user.png');?>">	
				</div>

				<div class="col-md">
					<h3>Selamat Datang Mahasiswa Baru.</h3>
					Silahkan mengisi formulir pendaftaran mahasiswa dibawah ini dengan data yang valid. nanti data akan di validasi oleh Admin Password Akan dikirimkan lewat email jadi harus valid ya..
					<div class="form-row mt-2">
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
					</div>
					<div class="form-row">
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
						<div class="form-group col-md-auto">
							<div>
								<button class="btn btn-primary" type="submit" id="daftar"> <i class="fas fa-sign-in-alt"></i> Daftar </button>					
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	<?php } else { ?>
		<div class='container-fluid'>
			<div class='row align-items-center'>
				<div class='col-md'>
					<h2> Maaf Kawan. Kamu Belum Bisa Melakukan Pendaftaran </h2>
					Sistem Ini Mengharuskan Admin Untuk Memasukan Data Jurusan & Konsentrasi Untuk Bisa Digunakan. 
				</div>
				<div class='col-md-3'>
					<img src="<?= base_url('assets/web/sad.jpg')?>">
				</div>
			</div>
		</div>
	<?php } ?>

</body>
</html>