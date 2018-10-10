<head>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#ide_skripsi').load('<?php echo base_url('Mahasiswa/ideSkripsi');?>');
			$('#form_ide').load('<?php echo base_url('Mahasiswa/form_ide');?>');
			$('#navSkripsi').click(function(event) {
				$('#konsultasi').load('<?php echo base_url('Mahasiswa/konsultasi');?>');
			});
			$('#myprofil').load('<?php echo base_url('controllerGlobal/myProfil');?>');
			$('#Pemberitahuan').load('<?php echo base_url('controllerGlobal/notifikasi');?>');
			
			$(".btn-menu").click(function() {
				$("#mhs_profil").toggle('slow');
			});
		});
	</script>
</head>
<body>
	<div class="container-fluid">
		<div>
			<div>
				<div class="nav nav-pills mb-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					<a href="#" class="btn-menu nav-link"><i class="fas fa-bars"></i></a>
					<a class="nav-item nav-link active" id="v-pills-home-tab" data-toggle="tab" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-envelope fa-sm"></i> Pemberitahuan 
					</a>
					<?php if ($skripsi->num_rows() === 0) { ?>
						<a class="nav-item nav-link <?= $_SESSION['Status'] == 'Skripsi' ? '' : 'disabled'?>" id="navIdeskripsi" data-toggle="tab" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"> <i class="fas fa-file-alt fa-sm" ></i> Ide Skripsi 
						</a>
					<?php } else { 
						?>
						<a class="nav-item nav-link" id="navSkripsi" data-toggle="tab" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false" ><i class="fas fa-pencil-alt"></i> Skripsi </a>
					<?php } ?>
				</div>

				<div class="row">
					<div class="col-md-3 mb-3" id="mhs_profil">
						<div class="card " id="myprofil">
						</div>
					</div>

					<div class="col-md mb-3">
						<div class="tab-content" id="v-pills-tabContent">
							<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
								<div class="scroll card border-primary" style="height: 37rem">
									<?php if ($pemberitahuan->num_rows() > 0) { ?>
										<div id="Pemberitahuan">

										</div>
										<?php	
									} else { ?>
										<div class="text-center">
											Tidak Ada Pemberitahuan	
										</div>
										
									<?php } ?>

								</div>
							</div>
							<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
								<div class="card border-primary">
									<div class="card-body">
										<div class="row">
											<div class="col-md-5 mb-1" id="form_ide">
											</div>

											<div id="ide_skripsi" class="col-md" style="overflow-y: auto; height: 35rem">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
								<div class="mb-3 card" id="konsultasi" style="height: 35rem">
								</div>
							</div>		
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>