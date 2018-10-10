<head>
	<script type="text/javascript">
		function searchmhs(page_num) {
			page_num = page_num?page_num:0;
			var keywords = $('#keywords').val();
			var search = $('#search').val();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>Dosen/tabelSkripsi/'+page_num,
				data:'page='+page_num+'&keywords='+keywords+'&search='+search,
				beforeSend: function () {
					$('.loading').show();
				},
				success: function (html) {
					$('#tabelSkripsi').html(html);
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

			$("#navIdeSkripsi").click(function() {
				$('#ideskripsi').load('<?php echo base_url('kaprodi/ideskripsi');?>');

			});;
			
			$("#navKegiatan").click(function() {
				$('#formKegiatan').load('<?php echo base_url('kaprodi/formKegiatan');?>');
			});

			$('#tabelSkripsi').load('<?php echo base_url('Dosen/tabelSkripsi');?>');
			
			
			$('#profil').load('<?php echo base_url('ControllerGlobal/myProfil');?>');
			
			$("#dosen_button").on('click', function() {
				$("#data_dosen").toggle('fast');
				$("#form_dosen").toggle('slow');
			});
			
			$('#pemberitahuan').load('<?php echo base_url('controllerGlobal/notifikasi') ;?>')
			
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
							
							<a class="nav-item nav-link active" id="navPemberitahuan" data-toggle="list" href="#Notifikasi" role="tab" aria-controls="settings"> <i class="fas fa-envelope"></i> Pemberitahuan</a>

							<?php if ($_SESSION['Kaprodi']) { ?>
								<a class="nav-item nav-link" id="navIdeSkripsi" data-toggle="list" href="#list-home" role="tab" aria-controls="home"> <i class="fas fa-lightbulb"></i> Ide Skripsi </a>
							<?php } ?>
							
							<a class="nav-item nav-link" id="navSkripsi" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile"> <i class="fas fa-book"></i>  Skripsi </a>
							
							<?php if ($_SESSION['Kaprodi']) { ?>
								<a class="nav-link nav-item" id="navKegiatan" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings"> <i class="fas fa-calendar-alt"></i> Kegiatan </a>
							<?php } ?>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-sm-3 mb-3" id="profil">
					</div>
					<div class="col-md">
						<div class="tab-content" id="v-pills-tabContent">
							<div class="tab-content" id="nav-tabContent">
								<div class="tab-pane fade show active" id="Notifikasi" role="tabpanel" aria-labelledby="list-settings-list">
									<div class="scroll">
										<?php if ($Notifikasi->num_rows() > 0) {
											?>
											<div id="pemberitahuan">

											</div> 
											<?php 
										} else { 
											echo "<div class='mx-auto' style='width: 200px;'>
											Tidak Ada Pemberitahuan
											</div>";
										}?>

									</div>
								</div>

								<div class="tab-pane fade show" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
									<div class="card border-primary scroll">
										<div class="card-body" style="height: 35rem">
											<?php if ($ideskripsi->num_rows() === 0) {
												echo "<div id='ideskripsi'></div>";											
											} else {
												echo "Tidak Ada Mahasiswa Yang Mengajukan Judul";
											} ?>
										</div>
									</div>
								</div>

								<div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
									<div id="container">
										<div class="form-row">
											<div class="form-group col-md">
												<input type="text" name="" id="keywords" class="form-control" onkeyup="searchmhs()">
											</div>
											<div class="form-group col-md-2">
												<select class="form-control" id="search" onchange="searchmhs()">
													<option value="IDMahasiswaSkripsi"> NIM </option>
													<option value="Nama"> Nama </option>
												</select>
											</div>
											<div class="form-group col-1 m-1 loading" style="display: none">
												<i class="fas fa-spinner fa-pulse" ></i>
											</div>
										</div>
										<div id="tabelSkripsi">

										</div>
										<?php echo $this->ajax_pagination->create_links(); ?>	
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
								<button class="btn btn-outline-primary" id="dosen_button"> 
									<i class="fas fa-user-plus"></i> Tambah Dosen </button>
								</div>
								<div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-messages-list"> 
									<div class="form-row">
										<div id="formKegiatan" class="form-group col-md">

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