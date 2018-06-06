<script type="text/javascript">
		function cari_dsn(page_num) {
			page_num = page_num?page_num:0;
			var keywords_dsn = $('#keywords_dsn').val();
			var sortBy_dsn = $('#sortBy_dsn').val();
			var cari_dsn = $('#cari_dsn').val();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>Admin/tabel_dsn_admin/'+page_num,
				data:'page='+page_num+'&keywords_dsn='+keywords_dsn+'&sortBy_dsn='+sortBy_dsn+'&cari_dsn='+cari_dsn,
				beforeSend: function () {
					$('.loading').show();
				},
				
				success: function (html) {
					$('#tabel_dsn_admin').html(html);
					$('.loading').fadeOut("slow");
				}
			});
		}
		$("#form_dosen").load('<?php echo base_url('admin/form_dosen'); ?>');
		$("#tabel_dsn_admin").load('<?php echo base_url('admin/tabel_dsn_admin'); ?>');
	</script>
	<ul class="nav nav-pills text-center" id="pills-tab" role="tablist">
		<li class="nav-item col-md btn-sm">
			<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-dosen" role="tab" aria-controls="pills-home" aria-selected="true">Data</a>
		</li>
		<li class="nav-item col-md  btn-sm">
			<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#form_dosen" role="tab" aria-controls="pills-profile" aria-selected="false">Masukan Dosen</a>
		</li>
	</ul>
	<hr>
	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade show active" id="pills-dosen" role="tabpanel" aria-labelledby="pills-home-tab">
			<div class="form-row">
				<div class="form-group col-md">
					<input class="form-control form-control-sm" id="keywords_dsn" type="text" name="tabel_dsn_admin/" placeholder="Cari Dosen" onkeyup="cari_dsn()"/>
				</div>
				<div class="form-group col-md-2">
					<select class="form-control form-control-sm sortBy" id="cari_dsn" name="cari_dsn" onchange="cari_dsn()">
						<option value="nik">NIK</option>
						<option value="nama_dosen">Nama</option>
						<option value="jurusan">Jurusan</option>
					</select>
				</div>
				<div class="form-group col-md-2">
					<select class="form-control form-control-sm sortBy" id="sortBy_dsn" onchange="cari_dsn()">
						<option value="">Sort By</option>
						<option value="asc">Ascending</option>
						<option value="desc">Descending</option>
					</select>
				</div>
				<div class="form-group col-md-1 m-1 loading" style="display: none">
					<i class="fas fa-spinner fa-pulse"></i>
				</div>
			</div>

			<div class="tabel table-responsive" id="tabel_dsn_admin" nama="dosen" >

			</div>
		</div>
		<div class="tab-pane fade" id="form_dosen" role="tabpanel" aria-labelledby="pills-profile-tab"></div>
		<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
	</div>

