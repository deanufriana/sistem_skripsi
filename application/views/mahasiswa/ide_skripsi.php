<?php foreach ($ide_skripsi->result() as $u) {
	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md">
				<h5 class="card-title"> <i class="fas fa-book"></i> <?php echo $u->judul;?></h5>
			</div>
			<h6 class="card-subtitle mb-2 text-muted float-right"><i class="fas fa-calendar-alt"></i> <?php echo $u->tanggal;?></h6>
		</div>

		<br>
		
		
		<p class="card-text"><?php echo $u->deskripsi;?></p>
	</div>
	<hr>
	<?php } ?>