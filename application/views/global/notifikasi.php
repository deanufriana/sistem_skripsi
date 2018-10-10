<head>
	<script type="text/javascript" src="<?php echo base_url('assets/js/myscript.js');?>">
	</script>
</head>

<?php foreach ($Notifikasi->result() as $p) {
	?>
	<div class="tabel<?php echo $p->IDNotifikasi;?>" id="container">
		<div class="card mb-3">
			<div class="card-body">
				<div class="form-row">
					<div class="form-group col-2 col-md-1">
						<img class="card-img-top" src="<?php echo base_url('assets/images/User/'.$p->Foto);?>" alt="Card image">
					</div>
					<div class="form-group col">
						<h6 class="card-title"> <?php echo $p->Notifikasi ?> <?php if ($p->StatusNotifikasi === 'Diterima') { ?>
							<span class="badge badge-success"> Diterima </span>
						<?php } elseif ($p->StatusNotifikasi === 'Ditolak') { ?>
							<span class="badge badge-danger"> Ditolak </span>
						<?php } else { ?>
							<span class="badge badge-info"> Informasi </span>
							<?php }	?> <a id="<?php echo $p->IDNotifikasi;?>" class="hapus" href="<?php echo base_url('ControllerGlobal/deleteNotifikasi/'.$p->IDNotifikasi);?>"><i class="fas fa-trash-alt fa-sm"></i></a> <h6 class="card-title">  </h6>

							<div class="form-group">
								<h6 class="card-subtitle text-muted"> <i class="fas fa-calendar fa-sm"></i> <?php echo longdate_indo($p->TanggalNotifikasi);?> <i class="fas fa-users fa-sm"></i> <?php echo $p->Nama;?> </h6>
							</div>
						</div>

						<div class="form-group col-md">
							<ul class="nav flex-column">
								<div><h6>Catatan</h6></div>
								<li class="nav-item">
									<?php echo $p->Catatan;?>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php } ?>