<script type="text/javascript">
	
	function searchMahasiswa(page_num) {
		page_num = page_num?page_num:0;
		var keywords = $('#keywords').val();
		var sortBy = $('#sortBy').val();
		var search = $('#search').val();
		user = 'Mahasiswa';
		
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>Admin/tabelNavigasi/'+page_num+'/'+user,
			data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&search='+search+'&user='+user,
			beforeSend: function () {
				$('.loading').show();
			},
			success: function (html) {
				$('#tabelMahasiswa').html(html);
				$('.loading').fadeOut("slow");
			}
		});
	}

	$("#tabelMahasiswa").load('<?= base_url('admin/tabelNavigasi/0/Mahasiswa'); ?>');

	$("#dataPendaftar").on('click', function() {
		$("#tabel_daftar_admin").load('<?= base_url('admin/tabelNavigasi/0/Daftar'); ?>');
	});

</script>

<ul class="nav nav-pills text-center" id="pills-tab" role="tablist">
	<li class="nav-item btn-sm" id="dataMahasiswa">
		<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Data</a>
	</li>
	<li class="nav-item btn-sm" id="dataPendaftar">
		<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#tabel_daftar_admin" role="tab" aria-controls="pills-profile" aria-selected="false"> Pendaftar </a>
	</li>
</ul>

<hr>

<div class="tab-content">
	<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
	<?php if ($users) { ?>
			<div class="form-row">
				<div class="form-group col-md">
					<input class="form-control form-control-sm" id="keywords" type="text" placeholder="Cari Mahasiswa" onkeyup="searchMahasiswa()"/>
				</div>
				<div class="form-group col-md-2">
					<select class="form-control form-control-sm" id="search" name="cari_mhs" onchange="searchMahasiswa()">
						<option value="ID">NIM</option>
						<option value="Nama">Nama</option>
						<option value="Jurusan">Jurusan</option>
					</select>
				</div>
				<div class="form-group col-md-2">
					<select class="form-control form-control-sm " id="sortBy" onchange="searchMahasiswa()">
						<option value="asc">Ascending</option>
						<option value="desc">Descending</option>
					</select>
				</div>
				<div class="form-group col-md-1 m-1 loading" style="display: none">
					<i class="fas fa-spinner fa-pulse"></i>
				</div>
			</div>
			
		<?php	} ?>
		<div class="tabel table-responsive" id="tabelMahasiswa" nama="mahasiswa">
		</div>
	</div>		



	<div class="tab-pane fade" id="tabel_daftar_admin" role="tabpanel" aria-labelledby="pills-profile-tab"></div>
</div>