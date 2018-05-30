<head>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".ide_skripsi").on('submit',
				function(e) {
					e.preventDefault();
					var form = $(this);
					var formdata = false;
					var id = $(this).attr('id');
					var nim = $(this).attr('name');

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
									$("#pengajuan"+id).fadeOut("slow");
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
									$(".pengajuan"+nim).fadeOut("slow");
								}
							});
						}
					});
				});
		});
	</script>
</head>

<?php foreach ($ide_skripsi->result() as $u) {
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#pmb1<?= $u->id_ide;?>").change(function(){ 
				$("#pmb2<?= $u->id_ide;?>").hide();
				$.ajax({
					type: "POST", 
					url: "<?php echo base_url("Kaprodi/pmb"); ?>", 
					data: {pmb1 : $("#pmb1<?= $u->id_ide?>").val()}, 
					dataType: "json",
					success: function(response){ 
						$("#pmb<?= $u->id_ide;?>").show('fast', function() {
							$("#pmb2<?= $u->id_ide;?>").html(response.list).show();	
						});
						
					},
				});
			});
		});
	</script>
	<div id="pengajuan<?= $u->id_ide;?>" class="pengajuan<?= $u->nim;?>">
		<div id="judul" class="form-row">
			<div class="form-group col-md-1 col-2">
				<img class="card-img-top" src="<?php echo base_url('assets/images/'.$u->foto_mhs);?>" alt="Card image">
			</div>
			<div class="form-group col-md-4 col-10 mb-2">
				<h6> <?php echo $u->nama_mhs;?> </h6>
				<h6 class="card-subtitle text-muted"> <i class="fas fa-calendar-alt fa-sm"></i> <?php echo $u->tanggal;?> </h6>
			</div>
			<div class="form-group col-md">
				<h6 class="text-primary"><?php echo $u->judul;?>  </h6>
			</div>
			<hr>
		</div>
		<p class="card-text text-justify"> <i class="fas fa-sticky-note"></i> <?php echo $u->deskripsi;?> </p>
		<form id="<?= $u->id_ide;?>" method="POST" name="<?= $u->nim;?>" href="<?php echo base_url('Kaprodi/ditolak/'.$u->id_ide);?>" action="<?php echo base_url('Kaprodi/disetujui/'.$u->id_ide);?>" class="ide_skripsi">
			<div class="form-group">
				<textarea class="form-control" name="catatan" placeholder="Catatan Untuk Mahasiswa" required></textarea>
			</div>
			<label>Dosen Pembimbing</label>
			<div class="form-row">
				<div class="form-group col-md">
					<select name="pmb1" id="pmb1<?= $u->id_ide;?>" class="form-control form-control-sm" required>
						<option value="">Pilih</option>
						<?php
						foreach($dosen as $data) {
							echo "<option value='".$data->nik."'>".$data->nama_dosen."</option>";
						}
						?>
					</select>
					<small>Dosen Pembimbing 1</small>
				</div>
				<div class="form-group col-md" id="pmb<?= $u->id_ide;?>" style="display: none">
					<select name="pmb2" id="pmb2<?= $u->id_ide;?>" class="form-control form-control-sm" required>
						<option value="">Pilih</option>
					</select>
					<small>Dosen Pembimbing 2</small>
				</div>
				<input type="text" name="halaman" value="$u->nim_mhs" hidden>
				<div class="form-group">
					<button class="btn btn-sm btn-primary float-right" type="submit">Action</button>
				</div>
			</div>
		</form>				
		<hr>	
	</div>
	
	<?php } ?>