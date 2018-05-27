<head>
	<script type="text/javascript">
		$(document).ready(function(){

			$('#ide_skripsi').load('<?php echo base_url('kaprodi/ide_skripsi');?>');
			$('#mahasiswa').load('<?php echo base_url('kaprodi/mahasiswa');?>');
			$('#form_kegiatan').load('<?php echo base_url('kaprodi/form_kegiatan');?>');
			// $('#daftar').load('<?php echo base_url('kaprodi/daftar');?>');
			$('#profil').load('<?php echo base_url('dosen/profil');?>');

			$("#dosen_button").click(function(event) {
				$("#data_dosen").toggle('fast');
				$("#form_dosen").toggle('slow');
			});


			$("#percobaan").click(function(event) {
				$("#profil").toggle('slow');
			});

			$(".btn-login").click(function(){
				var formAction = $(".ubah_pass").attr('action');
				var datalogin = {
					pass_lama: $(".pass_lama").val(),
					pass_baru: $(".pass_baru").val()
				};

				if (!$(".pass_lama").val() || !$(".pass_baru").val()) {
					$(".warning").show('fast').delay(2000).hide('fast');
					return false;
				} else {
					$.ajax({
						type: "POST",
						url: formAction,
						data: datalogin,
						success: function(result) {
							if(result == 1) {
								$(".success").show('fast').delay(2000).hide('slow', function() {
									$("#Ubah").modal('toggle');						
								});;
							}
							else {
								$(".failed").show('fast').delay(2000).hide('fast');
								$('.pass_lama').val('');
								$('.pass_baru').val('');
								return false;
							}
						}
					});
					return false;
				}
			});    

			$(".acc").on('submit',

				function(e) {
					e.preventDefault();
					var form = $(this);
					var formdata = false;

					if (window.FormData) {
						formdata = new FormData(form[0]);
					}

					var formAction = form.attr('action');

					$.ajax({
						type: 'POST',
						url: formAction,
						data: formdata ? formdata: form.serialize(),
						contentType: false,
						processData: false,
						cache: false,
						success: function() {
							swal("Ide Skripsi Berhasil Diajukan!", "Silahkan Tunggu Konfirmasi Dari Fakultas", "success")
							$('#data_skripsi').load('<?php echo base_url('Mahasiswa/ide_skripsi');?>');
						}
					});
				});
		});
	</script>
</head>
<body>
	<div class="container-fluid mb-2">
		<div class="row">
			<div class="col-md">
				<div>
					<div>
						<div class="nav nav-pills mb-2 nav-justified" id="list-tab" role="tablist">
							<a class="nav-link" href="#" id="percobaan"><i class="fas fa-bars"></i></a>
							<a class="nav-item nav-link active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home"> <i class="fas fa-envelope"></i> Ide Skripsi </a>
							<a class="nav-item nav-link" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile"> <i class="fas fa-users"></i>  Skripsi </a>
							<a class="nav-link nav-item" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings"> <i class="fas fa-calendar-alt"></i> Kegiatan </a>
							<!-- <a class="nav-link nav-item" id="list-daftar-list" data-toggle="list" href="#list-daftar" role="tab" aria-controls="daftar"> <i class="fas fa-list-alt"></i> Pendaftaran </a> -->
						</div>
					</div>
				</div>
				<hr>

				<div class="row">
					<div class="col-md-3" id="profil">
					</div>
					<div class="col-md">
						<div class="tab-content" id="v-pills-tabContent">
							<div class="tab-content" id="nav-tabContent">
								<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
									<div class="card border-primary scroll">
										<div class="card-body" >
											<div id="ide_skripsi"></div>
										</div>
									</div>
								</div>

								<div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
									<div id="mahasiswa">

									</div>

								</div>
								
								<div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="
								list-messages-list">
								<table id="data_dosen" class="table table-bordered">
									<thead>
										<tr class="text-center">
											<th>NIK</th>
											<th>Nama</th>
											<th>No. Telp</th>
											<th>Email</th>
										</tr>
									</thead>
									<tbody id="dosen">
									</tbody>
								</table>
								<div id="form_dosen" style="display: none;"></div>
								<button class="btn btn-outline-primary" id="dosen_button"> <i class="fas fa-user-plus"></i> Tambah Dosen </button>
							</div>
							<div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-messages-list"> 
								<div class="form-row">
									<div id="form_kegiatan" class="form-group col-md">

									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="list-daftar" role="tabpanel" aria-labelledby="list-daftar-list">
								<div id="daftar">

								</div>
							</div>

						</div>
					</div>	
				</div>

			</div>
		</div>
	</body>