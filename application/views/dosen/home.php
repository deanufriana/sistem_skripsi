<head>
	<script type="text/javascript">    
		jQuery(document).ready(function($) {
			$('#tabel_skripsi').load('<?php echo base_url('dosen/tabel_skripsi') ;?>')	
			$('#pemberitahuan').load('<?php echo base_url('dosen/pemberitahuan') ;?>')
			$('#profil').load('<?php echo base_url('dosen/profil') ;?>')
			$('.bars').toggle('slow');	
			$(".btn-menu").click(function() {
				$("#profil").toggle('slow');
			});
		});
		
	</script>
</head>
<body>
	
	<div class="container-fluid">
		<div>
			<div class="nav nav-pills flex-column flex-sm-row" id="list-tab" role="tablist">
				<a href="#" class="nav-link btn-menu"> <i class="fas fa-bars"> </i> </a>
				<a class="nav-item nav-link active" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings"> <i class="fas fa-envelope"></i> Pemberitahuan</a>
				<a class="nav-item nav-link" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home"> <i class="fas fa-users"></i> Skripsi </a>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-3" id="profil">

				</div>
				<div class="col-md">
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
							<div class="scroll">
								<div id="pemberitahuan">

								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
							<div class="scroll">
								<div id="tabel_skripsi">

								</div>
							</div>
						</td>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
</body>