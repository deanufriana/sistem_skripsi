<head>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#ide_skripsi').load('<?php echo base_url('Mahasiswa/ide_skripsi');?>');
			$('#form_ide').load('<?php echo base_url('Mahasiswa/form_ide');?>');
			$('#myprofil').load('<?php echo base_url('Mahasiswa/myprofil');?>');
			$('#Pemberitahuan').load('<?php echo base_url('Mahasiswa/Pemberitahuan');?>');
			$('#konsultasi').load('<?php echo base_url('Mahasiswa/konsultasi');?>');
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
				<div class="nav nav-pills mb-3 nav-justified flex-column flex-sm-row" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					<a href="#" class="btn-menu nav-link"><i class="fas fa-bars"></i></a>
					<a class="nav-item nav-link active" id="v-pills-home-tab" data-toggle="tab" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-envelope fa-sm"></i> Pemberitahuan </a>
					<?php foreach ($mahasiswa as $m) {
						?>
						<a <?php if ($m->id_skripsi_mhs != '0') {
							echo "style='display: none;'";
						} ?> class="nav-item nav-link" id="v-pills-profile-tab" data-toggle="tab" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"> <i class="fas fa-file-alt fa-sm"></i> Ide Skripsi </a>
						<a  <?php if ($m->id_skripsi_mhs === '0') {
							echo "style='display: none;'";
						} } ?> class="nav-item nav-link" id="v-pills-messages-tab" data-toggle="tab" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fas fa-pencil-alt"></i> Skripsi </a>
					</div>

					<div class="row">
						<div class="col-md-3 mb-3" id="mhs_profil">
							<div class="card" id="myprofil">
							</div>
						</div>

						<div class="col-md mb-3">
							<div class="tab-content" id="v-pills-tabContent">
								<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
									<div class="border-primary card">
										<div id="Pemberitahuan" class="scroll">

										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
									<div class="card border-primary">
										<div class="card-body">
											<div class="row">
												<div <?php if ($this->session->userdata('id_skripsi_mhs') != '0') {
													echo "style='display: none;'"; } ?> class="col-md-5 mb-3" id="form_ide">
												</div>

												<div id="ide_skripsi" class="col-md scroll">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
									<div class="card border-primary" id="konsultasi">
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