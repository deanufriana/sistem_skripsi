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
					url: "<?php echo base_url("home/konsentrasi"); ?>", 
					data: {id_fakultas : $("#jurusan").val()}, 
					dataType: "json",
					success: function(response){ 
						$("#konsen").show('fast', function() {
							$("#konsentrasi").html(response.list).show();	
						});
						
					},
				});
			});
		});

/*		function validatePassword() {
			var validator = $("#myform").validate({
				rules: {
					pass: "required",
					confirmpassword: {
						equalTo: "#pass"
					}
				},
				messages: {
					pass: "Enter Password",
					confirmpassword: "<small>Masukan Password Yang Sama</small>"
				}
			});
			*/		/*	if (validator.form()) {
				*/
				$(document).ready(function(){
					$("#myform").on('submit',
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
								success: function() {
									swal("Pendaftaran Berhasil!", "Silahkan Konfirmasi Ke Fakultas Untuk Mendapatkan Validasi", "success");
									var formdata = '';
								}
							});
						});
				});
				
		// 	}
		// }
	</script>
</head>
<body>
	<div>
		<div>
			<div>
				<form method="post" id="myform" action="<?php echo base_url('Home/mendaftar');?>" enctype="multipart/form-data">
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
								foreach($jurusan as $data) {
									echo "<option value='".$data->id_jurusan."'>".$data->jurusan."</option>";
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
					<!-- <div class="form-row">
					
						<div class="form-group col-md">

							<input type="password" id="pass" name="password" placeholder="Password" class="form-control" required>
						</div>
						<div class="form-group col-md">
							<input name="confirmpassword" id="confirmpassword" placeholder="Ulang Password" type="password" class="form-control" required>
							<small></small>
						</div>
					</div>
				-->
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