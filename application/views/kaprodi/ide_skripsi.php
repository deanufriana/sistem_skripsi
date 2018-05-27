<head>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".ide_skripsi").on('submit',
				function(e) {
					e.preventDefault();
					var form = $(this);
					var formdata = false;
					if (window.FormData) {
						formdata = new FormData(form[0]);
					}	
					swal({
						text: "Terima Pengajuan Skripsi?",
						icon: "warning",
						buttons: ["Tolak", true],
						dangerMode: true,
					})
					.then((willDelete) => {
						if (willDelete) {
							$.ajax({
								type: 'POST',
								url: form.attr('action'),
								data: formdata ? formdata: form.serialize(),
								contentType: false,
								processData: false,
								cache: false,
								success: function() {
									location.reload();
								}
							});
						} else {
							$.ajax({
								type: 'POST',
								url: form.attr('href'),
								data: formdata ? formdata: form.serialize(),
								contentType: false,
								processData: false,
								cache: false,
								success: function() {
									location.reload();
								}
							});
						}
					});
				});
		});

		$(document).ready(function(){
			$("#pmb1").change(function(){ 
				$("#pmb2").hide();
				$.ajax({
					type: "POST", 
					url: "<?php echo base_url("Kaprodi/pmb"); ?>", 
					data: {pmb1 : $("#pmb1").val()}, 
					dataType: "json",
					success: function(response){ 
						$("#pmb").show('fast', function() {
							$("#pmb2").html(response.list).show();	
						});
						
					},
				});
			});
		});
	</script>
</head>

<?php foreach ($ide_skripsi->result() as $u) {
	?>
	<div id="judul" class="form-row">
		<div class="form-group col-1" >
			<img class="card-img-top" src="<?php echo base_url('assets/images/'.$u->foto_mhs);?>" alt="Card image">
		</div>
		<div class="form-group col-4">
			<h5> </i> <?php echo $u->nama_mhs;?> </h5>
			<h6 class="card-subtitle mb-2 text-muted"> <i class="fas fa-calendar-alt"></i> <?php echo $u->tanggal;?> </h6>
		</div>
		<div class="form-group col">
			<h5 class="text-right text-primary"><?php echo $u->judul;?>  </h5>
		</div>
		<hr>
	</div>
	<p class="card-text text-justify"> <i class="fas fa-sticky-note"></i> <?php echo $u->deskripsi;?> </p>
	<br>
	<form method="POST" href="<?php echo base_url('Kaprodi/rejected/'.$u->id_ide);?>" action="<?php echo base_url('Kaprodi/aksi_skripsi/'.$u->id_ide);?>" class="ide_skripsi">
		<div class="form-group">
			<textarea class="form-control" name="catatan" placeholder="Catatan Untuk Mahasiswa" required></textarea>
		</div>
		<label>Dosen Pembimbing</label>
		<div class="form-row">
			<div class="form-group col">
				<select name="pmb1" id="pmb1" class="form-control form-control-sm">
					<option value="">Pilih</option>
					<?php
					foreach($dosen as $data) {
						echo "<option value='".$data->nik."'>".$data->nama_dosen."</option>";
					}
					?>
				</select>
				<small>Dosen Pembimbing 1</small>
			</div>
			<div class="form-group col" id="pmb" style="display: none">
				<select name="pmb2" id="pmb2" class="form-control form-control-sm">
					<option value="">Pilih</option>
				</select>
				<small>Dosen Pembimbing 2</small>
			</div>
			<input type="text" name="halaman" value="$u->nim_mhs" hidden>
			<div class="form-group col-1">
				<button class="btn btn-sm btn-primary" type="submit">Action</button>
			</div>
		</div>
	</form>				
	<hr>
	<?php } ?>