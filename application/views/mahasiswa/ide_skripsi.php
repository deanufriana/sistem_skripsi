<?php foreach ($ide_skripsi->result() as $u) {	?>
	<div>
		<h6 class="card-title"> <i class="fas fa-book fa-xs"></i> <?php echo $u->judul;?></h6>
		<h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-calendar-alt fa-xs"></i> <?php echo $u->tanggal;?></h6>
	</div>
	<p class="card-text text-justify"><?php echo $u->deskripsi;?></p>
	<hr>
	<?php } ?>