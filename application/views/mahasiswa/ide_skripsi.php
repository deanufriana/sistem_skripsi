<?php foreach ($ide_skripsi->result() as $u) {	?>
	<div class="mb-2">
		<h5 class="card-title"> <i class="fas fa-book fa-sm"></i> <?php echo $u->judul;?></h5>
		<h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-calendar-alt fa-sm"></i> <?php echo $u->tanggal;?></h6>
	</div>
	<p class="card-text text-justify"><?php echo $u->deskripsi;?></p>
	<hr>
	<?php } ?>