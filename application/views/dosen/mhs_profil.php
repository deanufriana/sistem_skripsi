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

	</script>
</head>

<?php if($this->uri->segment(1) === "Kaprodi") {
	foreach ($mahasiswa as $u); 
} else {
	foreach ($pembimbing->result() as $u);
} {
	?>
	<div class="container-fluid">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-2 mr-3">
						<img class="card-img-top" src="<?= base_url('assets/images/'.$u->foto_mhs) ;?>">
					</div>
					<div class="col-md">
						<div class="form-row">
							<div class="form-group col-md-5">
								<p class="h5"> <?= $u->nama_mhs;?> / <?= $u->nim;?>  </p>
								<p class="text-subtitle h6"><i class="fas fa-envelope fa-sm"></i> <?= $u->email_mhs;?> <br> 
									<i class="fas fa-phone fa-sm"></i> No. HP : <?= $u->nohp_mhs;?> 
								</p>
							</div>						
							<div class="form-group col-md">
								<div>
									<h4><?= $u->judul_skripsi;?></h4>
								</div>
							</div>
							<div class="form-group">
								<small><?= word_limiter($u->deskripsi, 200) ;?></small>
							</div>
						</div>
						<?php if ($this->uri->segment(1) != 'Kaprodi') { ?>
							
							<div class="form-row">
								<div class="form-group">
									<a class="btn-sm"
									<?php if (empty($u->file_proposal)) {
										echo "";
									} else {
										echo "href=".base_url("ControllerGlobal/downloadFile/".$u->file_proposal);
									} ?>> <i class="fa fa-download"></i> </a>
								</div>
								<div class="form-group ml-2">
									<form class="status" id="<?= $u->id_pmb;?>" nama="Proposal" method="POST" action="<?= base_url('Dosen/accUsers/'.$u->id_pmb.'/proposal');?>">
										<input type="submit" class="btn<?= $u->id_pmb;?> btn btn-outline-primary btn-sm" value="Menyetujui Proposal" <?php if ($u->status_proposal === 'Disetujui') {
											echo 'disabled';
										} ?>>
									</form>
								</div> 
								<div class="form-group ml-2">
									<a class="btn-sm"
									<?php if (empty($u->file_skripsi)) {
										echo "";
									} else {
										echo "href=".base_url("ControllerGlobal/downloadFile/".$u->file_skripsi);
									} ?>> <i class="fa fa-download"></i> </a>
								</div>
								<div class="form-group ml-2">
									<div id="Skripsi" class="form-row" <?php if ($u->status_proposal === 'Belum Disetujui') {
										echo 'style="display: none"';	} ?>>
										<div class="form-group col-md"> 
											<form id="<?= $u->id_pmb;?>" class="status" nama="Skripsi" method="POST" action="<?= base_url('Dosen/accUsers/'.$u->id_pmb.'/skripsi');?>">
												<input type="submit" class="btn<?= $u->id_pmb;?> btn btn-outline-primary btn-sm" value="Menyetujui Skripsi" 
												<?php if ($prop->num_rows() === 1) {
													echo 'disabled';
													$status = 'Proposal Telah diSetujui mohon tunggu acc dari pemmbimbing yang lain untuk dapat mengacc Skripsi';
												} else {
													if ($u->status_skripsi === 'Disetujui') {
														echo 'disabled';
														$status = '';
													} else {
														echo '';
														$status = '';
													}
												} ?>>
											</form>
										</div>
									</div>
								</div>
								<div class="form-group ml-5">
									<?= $status ?>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
				<?php if ($this->uri->segment(1) != 'Kaprodi') { ?>
					<form method="POST" action="<?= base_url('dosen/catatan');?>" class="catatan">
						<div class="form-group">
							<h6 class="text-right"> Catatan Bimbingan </h6>
							<textarea class="form-control" name="note"></textarea>
							<input type="hidden" name="mhs" value="<?= $u->nim ;?>">
						</div>
						<div class="form-group">
							<input class="btn btn-primary" type="submit" name="submit">
						</div>
					</form>
				<?php } } ?>
				<hr>
				<div class="form-row">
					<div class="form-group col-8">
						<h5> <i class="fas fa-pencil-alt fa-xs"></i> Kartu Bimbingan </h5>	
					</div>

					<?php if($this->uri->segment(1) === "Kaprodi") {
						foreach ($mahasiswa as $p); 
					} else {
						foreach ($pembimbing->result() as $p);
					} { ?>
						<div class="form-group col-4 text-right">
							<a href="<?= base_url('Cetak/kartu/'.$p->nim);?>"> <button class="btn btn-outline-primary btn-sm"> <i class="fas fa-print"></i> Cetak</button>		</a>
						</div>
					<?php } ?>
				</div>
				<div class="table-responsive">
					<table class="table small">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Pembimbing</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($konsultasi)): ?>
								<?php $no = 1 ?>
								<?php foreach ($konsultasi as $k) { ?>
									<tr>
										<td><?= $no++;?></td>
										<td><?= longdate_indo($k->tanggal);?></td>
										<td><?= $k->pembimbing;?></td>
									</tr>
									<tr>
										<th> Catatan </th>
										<td colspan="2"><?= $k->catatan;?></td>

									</tr>
								<?php } ?>	
							<?php endif ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>