<?php if ($ide_skripsi) { ?>
	<div style="height: 30rem; overflow: auto">
		<?php foreach ($ide_skripsi->result() as $u) {	?>

			<h6 class="card-title"> <i class="fas fa-book fa-xs"></i> <?php echo $u->JudulIde;?></h6>
			<h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-calendar-alt fa-xs"></i> <?php echo $u->TanggalIde;?></h6>

			<p class="card-text text-justify"><?php echo $u->DeskripsiIde;?></p>
			<hr>

		<?php } ?>
	</div> 
<?php } else { ?>
	<div class='row align-items-center'>
		<div class='col-md'>
			<h2>Ide Skripsi Tidak Ditemukan</h2>
			Hi, Teman !!! Saat ini tidak ada ide skripsimu yang sedang dalam proses !! silahkan ajukan ide skripsimu selengkap dan sebagus mungkin ya !! isi form di sebelah kiri untuk mengajukan ide skripsi yang ingin kamu ajukan ! kamu bisa mengajukan ide skripsi sebanyak mungkin ! tetap semangat ya teman. 
		</div>
		<div class='col-md-5'>
			<img class="card-img-top" src="<?= base_url('assets/web/ide.jpg')?>">
		</div>
	</div>
<?php } ?>

