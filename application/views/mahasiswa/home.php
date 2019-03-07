<head>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#tabelideSkripsi').load('<?php echo base_url('Mahasiswa/ideSkripsi');?>');
			$('#form_ide').load('<?php echo base_url('Mahasiswa/form_ide');?>');
			$('#navSkripsi').click(function() {
				$('#tabelMySkripsi').load('<?php echo base_url('Mahasiswa/mySkripsi');?>');
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
			<div class="col-md">
				<div class="row">
					<div class="col-md">
						<div class="nav nav-pills mb-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
							<a href="#" class="btn-menu nav-link"><i class="fas fa-bars"></i></a>
							<a class="nav-item nav-link active" id="v-pills-home-tab" data-toggle="tab" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-envelope fa-sm"></i> Pemberitahuan 
							</a>
							<?php if (!$skripsi) { ?>
								<a class="nav-item nav-link <?= $_SESSION['Status'] == 'Skripsi' ? '' : 'disabled'?>" id="navIdeskripsi" data-toggle="tab" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"> <i class="fas fa-file-alt fa-sm" ></i> Ide Skripsi 
								</a>
							<?php } else { 
								?>
								<a class="nav-item nav-link" id="navSkripsi" data-toggle="tab" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false" ><i class="fas fa-pencil-alt"></i> Skripsi </a>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-auto">
						<span class="text-right"> 
							<?php $status = $_SESSION['Kaprodi'] === 1 ? 'Kaprodi' : $_SESSION['Status'];
							echo $status.' '.$users->row()->Jurusan.' '.$_SESSION['Konsentrasi'] ?>
							<h5>
								<?= $_SESSION['Nama'] ?> 
							</h5>
						</span>
					</div>
				</div>
			</div>
			<div class="row m-2">
				<div class="col-md-2" id="mhs_profil" style="display: none">
					<div id="myprofil">
					</div>
				</div>

				<div class="col-md mb-3">
					<div class="tab-content" id="v-pills-tabContent">
						<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
								<div id="Pemberitahuan"></div>
						</div>
						<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
							<div class="card border-primary">
								<div class="card-body">
									<div class="row">
										<div class="col-md-5 mb-1" id="form_ide">
										</div>

										<div id="tabelideSkripsi" class="col-md">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
							<div class="mb-3 card container" id="tabelMySkripsi">
							</div>
						</div>		
					</div>
				</div>
			</div>
		</div>
	</div>
</body>