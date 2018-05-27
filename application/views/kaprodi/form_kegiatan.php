<script type="text/javascript">
	$('.clockpicker').clockpicker({
		placement: 'bottom',
		align: 'left',
		donetext: 'Done'
	});
	$(document).ready(function(){
		$("#save_kegiatan").on('submit',
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
						swal("", "Pemberitahuan Kegiatan Berhasil Dikirim", "success");
					}
				});
			});
	}); 
</script>
<form method="POST" id="save_kegiatan" action="<?php echo base_url('Kaprodi/aksi_kegiatan');?>">
	<div>
		<div class="form-row">
			<div class="form-group col">
				<label>Nama :</label>
				<select class="custom-select" id="inputGroupSelect01" name="penerima">
					<option selected>Pilih</option>
					<?php foreach ($mahasiswa as $m) {
						?>
						<option value="<?php echo $m->nim;?>"><?php echo $m->nama_mhs;?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group col">
					<label> Tempat Kegiatan :</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-map-marker"></i></span>
						</div>
						<input type="text" name="tempat" class="form-control" required>
					</div>
				</div>

			</div>
			<div class="form-row">
				<div class="form-group col-8">
					<label>Tanggal Kegiatan</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="kalender"><i class="fas fa-calendar"></i></span>
						</div>
						<input aria-describedby="kalender" aria-label="Small" type="date" name="tanggal" class="form-control" required>
					</div>

				</div>
				<div class="form-group col clockpicker">
					<label>Jam Kegiatan</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-clock"></i></span>
						</div>
						<input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="jam" required>
					</div>
				</div>
			</div>

			<fieldset class="form-group">
				<div class="row">
					<legend class="col-form-label col-sm-2 pt-0">Jenis Kegiatan</legend>
					<div class="col">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="kegiatan" id="gridRadios1" value="Seminar Proposal" checked>
							<label class="form-check-label" for="gridRadios1">
								Seminar
							</label>
						</div>
					</div>
					<div class="col">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="kegiatan" id="gridRadios2" value="Sidang Skripsi">
							<label class="form-check-label" for="gridRadios2">
								Sidang Skripsi
							</label>
						</div>
					</div>
					<div class="col text-right">
						<button class="btn btn-primary"> Submit </button>
					</div>
				</div>
			</fieldset>

		</div>
	</form>