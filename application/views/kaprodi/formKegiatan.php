<head>
	
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/clockpicker.css');?>">
	<script src="<?= base_url('assets/js/clockpicker.js');?>"></script>

	<script type="text/javascript">
		$(document).ready(function () {

			$('.clockpicker').clockpicker({
				placement: 'bottom',
				align: 'left',
				donetext: 'Done'
			});

			$("#save_kegiatan").on('submit',
				function (e) {
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
						data: formdata ? formdata : form.serialize(),
						contentType: false,
						processData: false,
						cache: false,
						success: function (result) {
							swal("Pemberitahuan Kegiatan Berhasil Dikirim", "success");
						}
					});
				});

			var regex = /^(.+?)(\d+)$/i;
			var cloneIndex = $(".clonedInput").length;

			function clone(e) {
				var value = $(this).children('option');
				if (value.length > 2) {
					$(this).parents(".clonedInput").clone()
						.appendTo("#nama")
						.attr("id", "clonedInput" + cloneIndex)
						.find("*")
						.each(function (ee) {
							var id = this.id || "";
							var match = id.match(regex) || [];
							if (match.length == 3) {
								this.id = match[1] + (cloneIndex);
							}
						})
						.on('change', 'select.clone', clone)
						.children(`option[value=${$(this).children('option:selected').val()}]`)
						.remove()

					cloneIndex++;
				}
			}

			$("select.clone").on("change", clone);

		});

	</script>

</head>

<?php if (!$users) {?>
<div class="row align-items-center">
	<div class="col-md mb-5">
		<h2> Mahasiswa Belum Ada </h2>
		Mahasiswa Saat Ini Belum Ada !! Anda Belum Bisa Mengirim Notifikasi Agenda Kegiatan Skripsi
	</div>
	<div class="col-md-3">
		<img src="<?=base_url('assets/web/sad.jpg')?>">
	</div>
</div>
<?php } else {?>
<form method="POST" id="save_kegiatan" action="<?php echo base_url('Kaprodi/aksiKegiatan'); ?>">
	<div class="form-group">
		<label> Tempat Kegiatan :</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="fas fa-map-marker"></i></span>
			</div>
			<input type="text" name="tempat" class="form-control" required>
		</div>
	</div>

	<div class="form-row">
		<div class="form-group col-md-8">
			<label>Tanggal Kegiatan</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" id="kalender"><i class="fas fa-calendar"></i></span>
				</div>
				<input aria-describedby="kalender" aria-label="Small" type="date" name="tanggal" class="form-control" required>
			</div>
		</div>
		<div class="form-group col-md clockpicker">
			<label>Jam Kegiatan</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-clock"></i></span>
				</div>
				<input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="jam"
				 required>
			</div>
		</div>
	</div>

	<fieldset class="form-group">
		<div class="row">
			<div class="col-md">
				<legend class="col-form-label col-md-sm-2 pt-0">Jenis Kegiatan</legend>
			</div>
			<div class="col-md">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="kegiatan" id="gridRadios1" value="Seminar Proposal" checked>
					<label class="form-check-label" for="gridRadios1">
						Seminar
					</label>
				</div>
			</div>
			<div class="col-md">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="kegiatan" id="gridRadios2" value="Sidang Skripsi">
					<label class="form-check-label" for="gridRadios2">
						Sidang Skripsi
					</label>
				</div>
			</div>
		</div>
	</fieldset>

	<label>Nama Mahasiswa</label>
	<div id='nama' class="form-row">
		<div class="clonedInput form-inline mb-3" id='clonedInput1'>
			<div class="form-group mr-1">
				<select class="custom-select clone" name="penerima[]">
					<option selected>Pilih</option>
					<?php foreach ($users->result() as $m) {?>
					<option value="<?php echo $m->ID; ?>">
						<?php echo $m->Nama; ?>
					</option>
					<?php }?>
				</select>
			</div>
		</div>
	</div>


	<div class="form-group text-right mt-3">
		<button class="btn btn-primary" type='submit'> Submit </button>
	</div>
</form>
<?php }?>
