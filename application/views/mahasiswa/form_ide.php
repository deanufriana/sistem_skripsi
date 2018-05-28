<head>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#pengajuan").on('submit',
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
							swal("Ide Skripsi Berhasil Diajukan!", "Silahkan Tunggu Konfirmasi Dari Fakultas", "success");
							$('#ide_skripsi').load('<?php echo base_url('Mahasiswa/ide_skripsi');?>');
							$('#judul').val('');
							$('#deskripsi').val('');
						}
					});
				});
		});
	</script>
</head>
<form id="pengajuan" method="POST" action="<?php echo base_url('Mahasiswa/pengajuan') ;?>">
	
	<div class="form-group">
		<textarea class="form-control" name="deskripsi" placeholder="Deskripsi" id="deskripsi" minlength="200" rows="13"></textarea>
		<small>Minimal 200 Kata</small>
	</div>
	<div class="form-row">
		<div class="form-group col-md">
			<input class="form-control" type="text" name="judul" id="judul" placeholder="Judul Skripsi">
		</div>

		<div class="form-group float-right">
			<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-paper-plane fa-sm"></i> Submit</button>
		</div>

	</div>
	
</form>	