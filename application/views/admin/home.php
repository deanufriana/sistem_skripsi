<head>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#tabel_jrsn_admin").load('<?php echo base_url('admin/tabel_jrsn_admin'); ?>');	
			$("#nav_mhs").load('<?php echo base_url('admin/nav_mhs'); ?>');
			$("#nav_dsn").load('<?php echo base_url('admin/nav_dsn'); ?>');	
			$("#pengaturan").load('<?php echo base_url('admin/pengaturan'); ?>');	
			
			$("#btn_jrsn").click(function(event) {
				$("#form_konsentrasi").fadeOut('slow', function() {
					$("#form_jurusan").fadeIn('fast');			
				});
			});

			$("#btn_konsentrasi").click(function(event) {
				$("#form_jurusan").fadeOut('slow', function() {
					$("#form_konsentrasi").fadeIn('fast');	
				});
			});
			
			$("#form_konsentrasi").load('<?php echo base_url('admin/form_konsentrasi'); ?>');
			$("#form_jurusan").load('<?php echo base_url('admin/form_jurusan'); ?>');	
		});	
	</script>
</head>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2 menu small">
			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-university"></i> Beranda </a> 
				<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fas fa-graduation-cap"></i> Mahasiswa</a>
				<a class="nav-link" id="v-pills-dosen-tab" data-toggle="pill" href="#v-pills-dosen" role="tab" aria-controls="v-pills-dosen" aria-selected="false"><i class="fas fa-briefcase"></i> Dosen </a>
				<a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fas fa-wrench"></i> Pengaturan</a>
				<br>
				<br>
			</div>
		</div>
		
		<div class="col-md">
			<div class="tab-content" id="v-pills-tabContent">
				
				<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
					<div class="row">
						<div>
							<a class="nav-link btn-menu" href="#"><i class="fas fa-bars"></i></a>	
						</div>
						<div class="col-md col text-right">
							<h5 class="nav-link"> BERANDA </h5>
						</div>
					</div>
					<hr>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<div class="form-row">
								<div class="form-group col-md">
									<button id="btn_jrsn" class="btn btn-sm btn-primary col text-left"> <i class="fas fa-user-plus"></i> Jurusan </button>								
								</div>

								<div id="form_jurusan" class="col-md-9" style="display: none">

								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md">
									<button id="btn_konsentrasi" class="btn btn-primary btn-sm col text-left"> <i class="fas fa-user-plus"></i> Konsentrasi </button>
								</div>

								<div class="col-md-9" id="form_konsentrasi" style="display: none">

								</div>									
							</div>

						</div>
						<div id="tabel_jrsn_admin">

						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
					<div class="row">
						<div class="float-left">
							<a class="nav-link btn-menu" href="#"><i class="fas fa-bars"></i></a>	
						</div>
						<div class="col col-md">
							<h5 class="text-right nav-link"> PENGATURAN </h5>
						</div>
					</div>
					<hr>
					<div id="pengaturan">		
					</div>
				</div>
				
				<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
					<div class="row">

						<div class="float-left">
							<a class="nav-link btn-menu" href="#"><i class="fas fa-bars"></i></a>	
						</div>
						<div class="col-md col text-right">
							<h5 class="nav-link"> DATA MAHASISWA </h5>
						</div>
					</div>
					<hr>
					<div id="nav_mhs">

					</div> 
				</div>

				<div class="tab-pane fade" id="v-pills-dosen" role="tabpanel" aria-labelledby="v-pills-dosen-tab">
					<div class="row">
						<div class="float-left">
							<a class="nav-link btn-menu" href="#"><i class="fas fa-bars"></i></a>	
						</div>
						<div class="col-md col text-right">
							<h5 class="nav-link"> DATA DOSEN </h5>
						</div>
					</div>
					<hr>
					<div id="nav_dsn">

					</div> 
				</div>

			</div>
		</div>
	</div>
</div>