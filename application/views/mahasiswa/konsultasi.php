<div class="card-body">
	<div class="form-row">
		<div class="form-group col-md-9">
			<h5> <i class="fas fa-book fa-sm"></i> <?php foreach ($skripsi as $s) {
				echo $s->judul_skripsi; ?> </h5>	
			<small><?= character_limiter($s->deskripsi, '200'); } ?></small>
		</div>
		<div class="form-group col-md text-right">
			<a href="<?php echo base_url('Cetak/kartu/').$this->session->userdata('nim');?>"> <button class="btn btn-outline-primary"> <i class="fas fa-print"></i> Cetak Kartu</button> </a>		
		</div>
	</div>

	<div class="form-row table-responsive" id="skripsi">		
		<table class="table table-borderless table-sm">
			<thead class="small">
				<tr>
					<th> Nama </th>
					<th class="text-center"> Proposal </th>
					<th class="text-center">Skripsi</th>
					<th >Level</th>
				</tr>
			</thead>
			<?php foreach ($pembimbing as $p) { ?>
				<tbody class="small"> 
					<td><?php echo $p->nama_dosen; ?></td>
					<td class="text-center"><?php if ($p->status_proposal === 'Disetujui') {
						echo "<i class='fas fa-check-square'></i>";
					} else {
						echo "<i class='fas fa-square'></i>";
					} ?></td>
					<td class="text-center"><?php if ($p->status_skripsi === 'Disetujui') {
						echo "<i class='fas fa-check-square'></i>";
					} else {
						echo "<i class='fas fa-square'></i>";
					} ?></td>
					<td><?php echo $p->level; ?></td>
				</tbody>
			<?php } ?>
		</table>
	</div>
	<div id="table-wrapper">
		<div class="mt-2" style="overflow:auto;">
			<table class="table table-sm small">
				<thead>
					<tr>
						<th>No</th>
						<th style="width: 12rem">Tanggal</th>
						<th>Catatan</th>
						<th>Pembimbing</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = '1'; ?>
					<?php foreach ($konsultasi as $k) {	?>
						<tr>
							<th><?php echo $no++;?></th>
							<th><?php echo longdate_indo($k->tanggal);?></th>
							<th><?php echo $k->catatan;?></th>
							<th style="width: 10rem"><?php echo $k->pembimbing;?></th>
						</tr>
					<?php } ?>
				</tbody>	
			</table>

		</div>

	</div>
</div>