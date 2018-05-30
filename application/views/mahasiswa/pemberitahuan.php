<head>
	<script type="text/javascript" src="<?= base_url('assets/js/myscript.js');?>">
	</script>
</head>
<?php foreach ($pemberitahuan->result() as $p) {
	?>
	<div class="tabel<?= $p->id;?>" id="container">
		<div class="card-body">
			<div class="form-row">
				<div class="form-group col-2 col-md-1">
					<img class="card-img-top img-rounded img-fluid" src="<?= base_url('assets/images/'.$p->foto_dsn);?>" alt="Card image">
				</div>
				<div class="form-group col">
					<h6 class="card-title"> <?= $p->pemberitahuan;?>  <?= $p->status;?> </h6>
					<h6 class="card-subtitle text-muted"> <i class="fas fa-calendar"></i> <?= longdate_indo($p->tanggal);?> <i class="fas fa-users"></i> <?= $p->nama_dosen;?></h6>
				</div>
				
				<div class="form-group col-1 text-right">
					<a id="<?= $p->id;?>" class="hapus" name="<?= $p->pemberitahuan;?>" href="<?= base_url('Mahasiswa/hapus/'.$p->id);?>"><i class="fas fa-trash-alt"></i></a>
				</div>
				<br>
				<div class="form-group col-md-3">
					<ul class="nav flex-column">
						<div><h6>Deskripsi</h6></div>
						<li class="nav-item">
							<?= $p->catatan;?>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<hr>
	</div>
	<?php } ?>