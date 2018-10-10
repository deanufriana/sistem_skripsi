<head>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".ide_skripsi").on('submit',
				function(e) {
					e.preventDefault();
					var form = $(this);
					var formdata = false;
					var id = $(this).attr('id');
					var ID = $(this).attr('name');

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
						$.ajax({
							type: 'POST',
							url: form.attr('action')+id+'/'+willDelete,
							data: formdata ? formdata: form.serialize(),
							contentType: false,
							processData: false,
							cache: false,
							success: function(result) {
								if (result === 1) {
									$(".pengajuan"+ID).fadeOut("slow");	
								} else {
									$("#pengajuan"+id).fadeOut("slow");
								}
								
							}
						});
					});
				});
		});
	</script>
</head>

<?php foreach ($ideskripsi->result() as $u) {
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#pmb1<?= $u->IDIde;?>").change(function(){ 
				$("#pmb2<?= $u->IDIde;?>").hide();
				$.ajax({
					type: "POST", 
					url: "<?php echo base_url("kaprodi/filterPembimbing"); ?>", 
					data: {pmb1 : $("#pmb1<?= $u->IDIde?>").val()}, 
					dataType: "json",
					success: function(response){ 
						$("#pmb<?= $u->IDIde;?>").show('fast', function() {
							$("#pmb2<?= $u->IDIde;?>").html(response.list).show();	
						});
						
					},
				});
			});
		});
	</script>
	<div id="pengajuan<?= $u->IDIde;?>" class="pengajuan<?= $u->ID;?>">
		<div id="judul" class="form-row">
			<div class="form-group col-md-1 col-2">
				<img class="card-img-top" src="<?php echo base_url('assets/images/User/'.$u->Foto);?>" alt="Card image">
			</div>
			<div class="form-group col-md-4 col-10 mb-2">
				<h6> <?php echo $u->Nama;?> </h6>
				<h6 class="card-subtitle text-muted"> <i class="fas fa-calendar-alt fa-sm"></i> <?php echo $u->TanggalIde;?> </h6>
			</div>
			<div class="form-group col-md">
				<h6 class="text-primary"><?php echo $u->JudulIde;?>  </h6>
			</div>
			<hr>
		</div>
		<p class="card-text text-justify"> <i class="fas fa-sticky-note"></i> <?php echo $u->DeskripsiIde;?> </p>
		<form id="<?= $u->IDIde;?>" method="POST" name="<?= $u->ID;?>" action="<?php echo base_url('Kaprodi/acceptSkripsi/');?>" class="ide_skripsi">
			<div class="form-group">
				<textarea class="form-control" name="catatan" placeholder="Catatan Untuk Mahasiswa" required></textarea>
			</div>
			<label>Dosen Pembimbing</label>
			<div class="form-row">
				<div class="form-group col-md">
					<select name="pmb1" id="pmb1<?= $u->IDIde;?>" class="form-control form-control-sm" required>
						<option value="">Pilih</option>
						<?php
						foreach($dosen->result() as $data) {
							echo "<option value='".$data->ID."'>".$data->Nama."</option>";
						}
						?>
					</select>
					<small>Dosen Pembimbing 1</small>
				</div>
				<div class="form-group col-md" id="pmb<?= $u->IDIde;?>" style="display: none">
					<select name="pmb2" id="pmb2<?= $u->IDIde;?>" class="form-control form-control-sm" required>
						<option value="">Pilih</option>
					</select>
					<small>Dosen Pembimbing 2</small>
				</div>
				<div class="form-group">
					<button class="btn btn-sm btn-primary float-right" type="submit">Action</button>
				</div>
			</div>
		</form>				
		<hr>	
	</div>
	
	<?php } ?>