<head>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#ide").on('submit',
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
							swal("Ide Skripsi Berhasil Diajukan!", "Silahkan Tunggu Konfirmasi Dari Fakultas", "success")
							$('#data_skripsi').load('<?php echo base_url('Mahasiswa/ide_skripsi');?>');
							return false;
						}
					});
				});
		});
	</script>
</head>
<form id="ide" method="POST" action="<?php echo base_url('Mahasiswa/pengajuan') ;?>">
	<div class="form-group">
		<label>Judul Skripsi</label>
		<input class="form-control" type="text" name="judul">
	</div>
	<div class="form-group">
		<label>Deskripsi Judul</label>
		<textarea class="form-control" name="deskripsi" minlength="200" rows="9"></textarea>
		<small>Minimal 200 Kata</small>
	</div>
	
</div>
<button id="kirim" type="submit" class="btn btn-outline-primary"><i class="fas fa-paper-plane"></i> Submit</button>
</form>	
</div>