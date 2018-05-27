<head>
	<script type="text/javascript">
		$("#btn_pwd_dsn").click(function(){
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
							$("#success").show('fast').delay(2000).hide('slow', function() {
								$("#Ubah").modal('toggle');						
							});;
						}
						else {
							$("#failed").show('fast').delay(2000).hide('fast');
							$('#pass_lama').val('');
							$('#pass_baru').val('');
							return false;
						}
					}
				});
				return false;
			}
		});
	</script>
</head>
<div class="modal fade ubah" id="Ubah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<form class="login" method="POST" action="<?php echo base_url('Dosen/update_password');?>">
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
						<button type="submit" class="btn btn-primary" id="btn_pwd_dsn"> <i class="fas fa-sign-in-alt"></i> Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="card mb-1">
	<img class="card-img-top" src="<?php echo base_url('assets/images/').$this->session->userdata('foto');?>" alt="Card image">
	<div class="card-body">
		<?php echo $this->session->userdata('status')." ".$this->session->userdata('jurusan')." ".$this->session->userdata('konsentrasi');?>
		<h6 class="card-title"><?php echo $this->session->userdata('nama_dosen');?></h6>
		<hr>
		<a href="" data-target="#Ubah" data-toggle="modal" class="btn btn-outline-primary btn-sm float-right"><i class="fas fa-edit"></i> Password </a>
		<p class="card-text small"><?php echo $this->session->userdata('nik');?> <br> <?php echo $this->session->userdata('email_dsn'); ;?></p>
	</div>
</div>	