
<?php if ($ide_skripsi->num_rows() > 0) {
	foreach ($ide_skripsi->result() as $u) {	?>
		<div>
			<h6 class="card-title"> <i class="fas fa-book fa-xs"></i> <?php echo $u->JudulIde;?></h6>
			<h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-calendar-alt fa-xs"></i> <?php echo $u->TanggalIde;?></h6>
		</div>
		<p class="card-text text-justify"><?php echo $u->DeskripsiIde;?></p>
		<hr>
	<?php } 
} else {
	echo "Tidak Ada Ide Skripsi Yang Diajukan";
} ?>

