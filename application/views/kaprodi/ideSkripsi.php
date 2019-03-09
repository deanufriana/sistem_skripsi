<head>
	<script type="text/javascript">
		$(document).ready(function () {
			$(".ideSkripsi").on('submit',
				function (e) {
					e.preventDefault();
					var form = $(this);
					var formdata = false;
					var id = $(this).attr('id');
					var name = $(this).attr('name');

					if (window.FormData) {
						formdata = new FormData(form[0]);
					}

					swal({
							title: "Ide Skripsi",
							text: "Terima Judul Skripsi Ini",
							type: "warning",
							showCancelButton: true,
							showConfirmButton: true,
							buttons: {
								cancel: true,
								confirm: "Tolak",
								false: 'OK'
							},
							dangerMode: true,
						})
						.then((willDelete) => {
							console.log(willDelete)
							if (willDelete != null) {
								$.ajax({
									type: 'POST',
									url: form.attr('action') + id + '/' + willDelete,
									data: formdata ? formdata : form.serialize(),
									contentType: false,
									processData: false,
									cache: false,
									success: function (result) {
										$('#ideskripsi').load("<?php echo base_url('kaprodi/ideskripsi'); ?>");
									}
								});
							}
						});
				});

			$("select").change(function () {
				var set = $(this).parent().next('div');
				var result = set.children('select').hide();
				var val = $(this).val();

				$.ajax({
					type: "POST",
					url: "<?=base_url('kaprodi/filterPembimbing');?>",
					data: {
						pmb1: val
					},
					dataType: "json",
					success: function (response) {
						$(set).show('fast', function () {
							$(set.children('select')).html(response.list).show();
						});

					},
				});
			});

		});

	</script>
</head>

<div class="card card-outline-secondary container">
	<?php if (!$ideskripsi) {?>
	<div class="row align-items-center m-5">
		<div class="col-md mb-5">
			<h2> Tidak Ada Mahasiswa yang Mengajukan Skripsi </h2>
			Maaf saat ini tidak ada yang mengajukan ide skripsi.
		</div>
		<div class="col-md-3">
			<img src="<?=base_url('assets/web/sad.jpg')?>">
		</div>
	</div>
	<?php } else {
    foreach ($ideskripsi->result() as $u) {
        ?>
	<div class="card-body">
		<div id="judul" class="form-row">
			<div class="form-group col-md-1 col-2">
				<img class="card-img-top" src="<?=base_url($u->Foto === NULL ? 'assets/web/user.png' :'assets/images/users/'.$u->Foto);?>" alt="Card image">
			</div>
			<div class="form-group col-md col-10 mb-2">
				<h4>
					<?php echo $u->Nama; ?>
				</h4>
				<h6 class="card-subtitle text-muted"> <i class="fas fa-calendar-alt fa-sm"></i>
					<?php echo $u->TanggalIde; ?>
				</h6>
			</div>
			<div class="form-group col-md-auto text-right">
				<h4 class="text-primary">
					<?php echo $u->JudulIde; ?>
				</h4>
			</div>
			<p class="card-text text-justify mt-3"> <i class="fas fa-sticky-note"></i>
				<?php echo $u->DeskripsiIde; ?>
			</p>
		</div>
		<hr>

		<form id="<?=$u->IDIde;?>" method="POST" name="<?=$u->ID;?>" action="<?=base_url('Kaprodi/acceptSkripsi/');?>" class="ideSkripsi">
			<div class="form-group">
				<textarea class="form-control" name="catatan" placeholder="Catatan Untuk Mahasiswa" required></textarea>
			</div>
			<label>Dosen Pembimbing</label>
			<div class="form-row">
				<div class="form-group col-md">
					<select name="pmb1" class="form-control form-control-sm" required>
						<option value="">Pilih</option>
						<?php
					foreach ($dosen->result() as $data) {
								echo "<option value='" . $data->ID . "'>" . $data->Nama . "</option>";
							}
							?>
					</select>
					<small>Dosen Pembimbing 1</small>
				</div>
				<div class="form-group col-md" style="display: none">
					<select name="pmb2" class="form-control form-control-sm" required>
						<option value="">Pilih</option>
					</select>
					<small>Dosen Pembimbing 2</small>
				</div>
				<div class="form-group">
					<button class="btn btn-sm btn-primary float-right" type="submit">Action</button>
				</div>
			</div>
		</form>

	</div>
	<?php }}?>
</div>
