<?php foreach ($dosen->result() as $d) {
	?>
	<div class="container-fluid">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-1 mr-auto">
						<img class="card-img-top" src="<?php echo base_url('assets/images/'.$d->foto_dsn) ;?>">
					</div>
					<div class="col">
						<div class="form-row">
							<div class="form-group col-5">
								<h5 class="card-title text-left"><?php echo $d->nama_dosen;?></h5>
								<div class="card-subtitle text-muted"> <?php echo $d->nik;?> / <?php echo $d->email_dsn;?> </div>
								<div>
									No. HP : <?php echo $d->nohp_dsn;?> 
								</div>
							</div>						
						</div>


					</div>
				</div>
				<?php } ?>
				<hr>
				<div>
					<div>
						<div class="form-row">
							<div class="form-group col-9">
								<h4> <i class="fas fa-pencil-alt"></i> Skripsi Yang di Bimbing </h4>	
							</div>
						</div>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Judul Skripsi</th>
									<th>Status Proposal</th>
									<th>Status Skripsi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($pembimbing as $p) {
									?>
									<tr>
										<th scope="row"><?php echo $p->judul_skripsi;?></th>
										<td><?php echo $p->status_proposal;?></td>
										<td><?php echo $p->status_skripsi;?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>