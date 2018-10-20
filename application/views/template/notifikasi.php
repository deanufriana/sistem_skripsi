<head>
	<script type="text/javascript" src="<?php echo base_url('assets/js/myscript.js');?>">
	</script>
</head>

<div class="card card-outline-secondary">
	<?php if (!$Notifikasi) { ?>
		<div class='row align-items-center m-5'>
			<div class='col-md'>
				<?php if ($_SESSION['Status'] === 'Dosen') { ?>
					<h2>Selamat Datang, <?= $_SESSION['Nama']?>.</h2>
					Pemberitahuan masih kosong, ini halaman dimana bapak sebagai pembimbing menerima notifikasi dari kaprodi mengenai skripsi dan mahasiswa yang bapak bimbing untuk melihat mahasiswa siapa yang bapak bimbing. bapak bisa melihat di navigasi Skripsi.
				<?php } elseif ($_SESSION['Status'] === 'Skripsi') { ?>
					<h2>Selamat Datang, <?= $_SESSION['Nama']?>. Sang Pejuang Skripsi.</h2>
					Selamat ya karena menempuh semester akhir dimana setiap mahasiswa S1 pasti akan mengalami yang namanya Fase pengerjaan Skripsi. Saat ini Pemberitahuanmu Kosong. di Navigasi Ide Skripsi Kamu Bisa mengajukan ide skripsi yang mungkin kamu punya. jadi bersiap siaplah jika sering di <b>TOLAK</b>. Semangat untuk skripsimu !!!
				<?php } elseif ($_SESSION['Status'] === 'Mahasiswa') { ?>
					<h2>Selamat Datang, <?= $_SESSION['Nama']?>. Mahasiswa Baru Ya.</h2>
					Saat ini sistem hanya bisa melakukan login ! sistem ini akan bisa di gunakan jika admin telah menerima dan memvalidasimu jika kau sudah mulai melakukan skripsi ! tetep semangat ya menjalani kehidupanmu di kampus !!!
					jika kamu sudah memasuki semester akhir dan masih belum bisa mengakses ide skripsi. silahkan tanyakan ke fakultas yah.
				<?php } ?>
			</div>
			<div class='col-md-3'>
				<img class="card-img-top" src="<?= base_url('assets/images/fix/jelaskan.jpg')?>">
			</div>
		</div>
	<?php } else { 
		foreach ($Notifikasi->result() as $p) {
			?>
			<div class="tabel<?php echo $p->IDNotifikasi;?>" id="container">
				<div>
					<div class="card-body">
						<div class="form-row">
							<div class="form-group mr-3" style="height: 10rem; width: 7rem">
								<?php if (file_exists('assets/images/User/'.$p->Foto)) {
									$base_url = base_url('assets/images/User/'.$p->Foto); 
								} else {
									$base_url = base_url('assets/images/fix/user.png');
								} 
								?>
								<img class="card-img-top" src="<?= $base_url;?>" alt="Card image">
							</div>
							<div class="form-group col">
								<h5 class="card-title"> <?php echo $p->Notifikasi ?> <?php if ($p->StatusNotifikasi === 'Diterima') { ?>
									<span class="badge badge-success"> Diterima </span>
								<?php } elseif ($p->StatusNotifikasi === 'Ditolak') { ?>
									<span class="badge badge-danger"> Ditolak </span>
								<?php } else { ?>
									<span class="badge badge-info"> Informasi </span>
									<?php }	?> <a id="<?php echo $p->IDNotifikasi;?>" class="hapus" href="<?php echo base_url('ControllerGlobal/deleteNotifikasi/'.$p->IDNotifikasi);?>"><i class="fas fa-trash-alt fa-sm"></i></a> <h6 class="card-title">  </h6>

									<div class="form-group">
										<h6 class="card-subtitle text-muted"> <i class="fas fa-calendar fa-sm"></i> <?php echo longdate_indo($p->TanggalNotifikasi);?> <i class="fas fa-users fa-sm"></i> <?php echo $p->Nama;?> </h6>
									</div>
									<div>
										<h6>Catatan</h6>
										<?php echo $p->Catatan;?>
									</div>
								</div>

								<div class="form-group col-md-auto">
									<ul class="nav flex-column">
										
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

			<?php } } ?>
		</div>