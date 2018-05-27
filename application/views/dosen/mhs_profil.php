<head> 
	<script type="text/javascript">

		$(document).ready(function(){

			$(".status").on('submit',
				function(e) {
					e.preventDefault();
					var form = $(this);
					var formdata = false;
					var id = $(this).attr("id");
					var nama = $(this).attr('nama');


					if (window.FormData) {
						formdata = new FormData(form[0]);
					}	
					swal({
						title: nama+" Akan Di ACC",
						text: "Sekali Di ACC Tidak Akan Bisa Diubah!",
						icon: "warning",
						buttons: true,
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
								beforeSend: function() {
									$('.loading').show();
								},
								success: function() {
									$('.loading').fadeOut('slow');
									$(".btn" + id).prop("disabled",true);
									$("#Skripsi").fadeIn("slow");
								}
							});
						} else {
							swal("Skripsi Batal di ACC");
						}
					});
				});
		});

		$(document).ready(function(){
			$(".catatan").on('submit',
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
						beforeSend: function() {
							$('.loading').show();
						},
						success: function() {
							location.reload();
						}
					});
				});
		});

	</script></head>
	<?php foreach ($pembimbing->result() as $u) {
		?>
		<div class="modal fade" id="Ubah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<form method="POST" action="" id="sh">
							<div class="alert alert-primary" role="alert" id="success" style="display: none;">
								This is a primary alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
							</div>
							<div class="form-group">
								<label for="recipient-name" class="col-form-label">Catatan Untuk Mahasiswa</label>
								<textarea name="catatan" class="form-control"></textarea>
								<small>Boleh di Kosongkan</small>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
						<button type="button" class="btn btn-primary" type="submit"> <i class="fas fa-sign-in-alt"></i> Submit</button>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-2 mr-auto">
							<img class="card-img-top" src="<?php echo base_url('assets/images/'.$u->foto_mhs) ;?>">
						</div>
						<div class="col-md">
							<div class="form-row">
								<div class="form-group col-md-5">
									<h3 class="card-title text-left"><?php echo $u->nama_mhs;?></h3>
									<div class="card-subtitle text-muted"> <?php echo $u->nim;?> / <?php echo $u->email_mhs;?> </div>
									<div>
										No. HP : <?php echo $u->nohp_mhs;?> 
									</div>
								</div>						
								<div class="form-group col-md text-right">
									<div><h5><?php echo $u->judul_skripsi;?></h5></div>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<label> Proposal </label>
									<div class="form-row">
										<div class="form-group col-md">
											<form class="status" id="<?php echo $u->id_pmb;?>" nama="Proposal" method="POST" action="<?php echo base_url('Dosen/acc_proposal/'.$u->id_pmb);?>">
												<input type="submit" class="btn<?php echo $u->id_pmb;?> btn btn-outline-primary" value="Accept" <?php if ($u->status_proposal === 'Disetujui') {
													echo 'disabled';
												} ?>>
											</form>
										</div> 
									</div>
								</div>	
								<i class="fas fa-spinner fa-pulse loading" style="display: none"> </i> 

								<div class="col text-right">

									<label>Skripsi</label>
									<div id="Skripsi" class="form-row" <?php if ($u->status_proposal === 'Belum Disetujui') {
										echo 'style="display: none"';
									} ?>>
									<div class="form-group col-md"> 
										<form id="<?php echo $u->id_pmb;?>" class="status" nama="Skripsi" method="POST" action="<?php echo base_url('Dosen/acc_skripsi/'.$u->id_pmb);?>">
											<input type="submit" class="btn<?php echo $u->id_pmb;?> btn btn-outline-primary" value="Accept" <?php if ($u->status_skripsi === 'Disetujui') {
												echo 'disabled';
											} ?>>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<form method="POST" action="<?php echo base_url('dosen/catatan');?>" class="catatan">
					<div class="form-group">
						<h6 class="text-right"> Catatan Bimbingan </h6>
						<textarea class="form-control" name="note"></textarea>
						<input type="hidden" name="mhs" value="<?php echo $u->nim ;?>">
					</div>
					<div class="form-group">
						<input class="btn btn-primary" type="submit" name="submit">
					</div>
				</form>
			<?php } ?>
			<hr>
			<div class="form-row">
				<div class="form-group col-9">
					<h4> <i class="fas fa-pencil-alt"></i> Kartu Bimbingan </h4>	
				</div>
				<?php foreach ($pembimbing->result() as $p) { ?>
					<div class="form-group text-right col">
						<a href="<?php echo base_url('Cetak/kartu/'.$p->nim);?>"> <button class="btn btn-outline-primary mb-2"> <i class="fas fa-print"></i> Cetak Kartu</button>		</a>
					</div>
				<?php } ?>
			</div>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>Catatan</th>
							<th>Pembimbing</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1 ?>
						<?php foreach ($konsultasi as $k) { ?>
							<tr>
								<td><?php echo $no++;?></td>
								<td><?php echo longdate_indo($k->tanggal);?></td>
								<td><?php echo $k->catatan;?></td>
								<td><?php echo $k->pembimbing;?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>

		</div>
	</div>
</div>