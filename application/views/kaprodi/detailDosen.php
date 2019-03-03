<?php $no = '1';
foreach ($dosen->result() as $d) {
	?>
	<div class="container-fluid">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-1 mr-auto">
						<?php if ($d->Foto === null) {
							$image = 'assets/web/user.png';
						} else {
							$image = 'assets/images/users/'.$d->Foto;
						} 
						?>						
						<img class="card-img-top" src="<?= base_url($image) ;?>">
					</div>
					<div class="col">
						<div class="form-row">
							<div class="form-group col-5">
								<h5 class="card-title text-left"><?php echo $d->Nama;?> / <?php echo $d->ID;?></h5>
								<div class="card-subtitle text-muted"> <i class="fas fa-envelope fa-xs"></i> <?php echo $d->Email;?> </div>
								<div> <i class="fas fa-phone fa-xs"></i>
									No. HP : <?php echo $d->NoHP;?> 
								</div>
							</div>						
						</div>
					</div>
				</div>
			<?php } ?> <hr>
			<div>
				<div>
					<div class="form-row">
						<div class="form-group col-9">
							<h6> <i class="fas fa-pencil-alt fa-xs"></i> Skripsi Yang di Bimbing </h6>	
						</div>
					</div>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>Mahasiswa</th>
								<th>Status Proposal</th>
								<th>Status Skripsi</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($pembimbing->result() as $p) {
								?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $p->Nama;?></td>
									
									<td class="text-center"><?php if ($p->StatusProposal) {
										echo "<i class='fas fa-check-square'></i>";
									} else {
										echo "<i class='fas fa-square'></i>";
									} ?></td>
									<td class="text-center"><?php if ($p->StatusSkripsi) {
										echo "<i class='fas fa-check-square'></i>";
									} else {
										echo "<i class='fas fa-square'></i>";
									} ?></td>
									<td><?= $p->StatusPembimbing?></td>
								</tr>
								<tr>
									<th>Judul Skripsi</th>
									<td colspan="4"><?php echo $p->JudulSkripsi;?></td>
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