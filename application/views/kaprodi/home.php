<head>
	<script type="text/javascript">
		function searchmhs(page_num) {
			page_num = page_num?page_num:0;
			var keywords = $('#keywords_mhs').val();
			var cari_mhs = $('#cari_mhs').val();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>Kaprodi/tabel_mhs_kaprodi/'+page_num,
				data:'page='+page_num+'&keywords='+keywords+'&cari_mhs='+cari_mhs,
				beforeSend: function () {
					$('.loading').show();
				},
				success: function (html) {
					$('#tabel_mhs_kaprodi').html(html);
					$('.loading').fadeOut("slow");
				}
			});
		}

		$(function(){

			$(document).ajaxStart(function () {
				$(".loader").css("display", "block");
			});

			$(document).ajaxComplete(function () {
				$(".loader").css("display", "none");
			})

			$('#ide_skripsi').load('<?php echo base_url('kaprodi/ide_skripsi');?>');
			$('#tabel_mhs_kaprodi').load('<?php echo base_url('kaprodi/tabel_mhs_kaprodi');?>');
			$('#form_kegiatan').load('<?php echo base_url('kaprodi/form_kegiatan');?>');
			$('#profil').load('<?php echo base_url('dosen/profil');?>');
			$("#dosen_button").on('click', function() {
				$("#data_dosen").toggle('fast');
				$("#form_dosen").toggle('slow');
			});
			$("#myprofil").on('click', function() {
				$("#profil").toggle('slow');
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
						<div class="nav nav-pills mb-2 flex-column flex-sm-row" id="list-tab" role="tablist">
							<a class="nav-link" href="#" id="myprofil"><i class="fas fa-bars"></i></a>
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
									<div style="height: 17rem" id="container">
										<div class="form-row">

											<div class="form-group col-md">
												<input type="text" name="" id="keywords_mhs" class="form-control" onkeyup="searchmhs()">
											</div>
											<div class="form-group col-md-2">
												<select class="form-control" id="cari_mhs" onchange="searchmhs()">
													<option value="nim"> NIM </option>
													<option value="nama_mhs"> Nama </option>
													<option value="jurusan"> Jurusan </option>
												</select>
											</div>
											<div class="form-group col-1 m-1 loading" style="display: none">
												<i class="fas fa-spinner fa-pulse" ></i>
											</div>
										</div>
										<div id="tabel_mhs_kaprodi">

										</div>
										<?php echo $this->ajax_pagination->create_links(); ?>	
										<div class="SHpembimbing " style="display: none">
											<div id="SHpembimbing">
											</div>	
										</div>
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