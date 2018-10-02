<head>
	<script type="text/javascript" src="<?php echo base_url('assets/js/myscript.js');?>">
	</script>
</head>

<?php foreach ($pemberitahuan->result() as $p) {
	?>
	<div class="tabel<?php echo $p->id;?>">
		<div class="card mb-3">
			<div class="card-body">
				<div class="form-row">
					<div class="form-group col-2 col-md-1">
						<img class="card-img-top" src="<?php echo base_url('assets/images/'.$p->foto_dsn);?>" alt="Card image">
					</div>
					<div class="form-group col">
						<h6 class="card-title"> <?php echo $p->pemberitahuan ;?> <a id="<?php echo $p->id;?>" class="hapus" href="<?php echo base_url('ControllerGlobal/deleteNotifikasi/'.$p->id);?>"><i class="fas fa-trash-alt fa-sm"></i></a> <?php echo $p->status ?></h6>

						<div class="form-group">
							<h6 class="card-subtitle text-muted"> <i class="fas fa-calendar fa-sm"></i> <?php echo longdate_indo($p->tanggal);?> <i class="fas fa-users fa-sm"></i> <?php echo $p->nama_dosen;?> </h6>
						</div>
					</div>

					<div class="form-group col-md">
						<ul class="nav flex-column">
							<div><h6>Catatan</h6></div>
							<li class="nav-item">
								<?php echo $p->catatan;?>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php } ?>