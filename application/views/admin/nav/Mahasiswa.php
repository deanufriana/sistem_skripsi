<script type="text/javascript">
	
	function searchMahasiswa(page_num) {
		page_num = page_num?page_num:0;
		var keywords = $('#keywords').val();
		var sortBy = $('#sortBy').val();
		var search = $('#search').val();
		user = '<?= $nav ?>';
		
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>Admin/tabelNavigasi/'+page_num+'/'+user,
			data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&search='+search+'&user='+user,
			beforeSend: function () {
				$('.loading').show();
			},
			success: function (html) {
				$(`#tabel<?= $nav ?>`).html(html);
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
		<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Data Mahasiswa</a>
	</li>

	<?php if ($users) {?>
			<li class="nav-item nav-link">
			<input class="form-control form-control-sm" id="keywords" type="text" name="tabel_dsn_admin/"
					placeholder="Cari Mahasiswa" onkeyup="searchMahasiswa()" />
			</li>
			<li class="nav-item nav-link">
			<select class="form-control form-control-sm sortBy" id="search" name="cari_dsn" onchange="searchMahasiswa()">
					<option value="ID">NIK</option>
					<option value="Nama">Nama</option>
					<option value="Jurusan">Jurusan</option>
				</select>
			</li>
			<li class="nav-item nav-link">
			<select class="form-control form-control-sm sortBy" id="sortBy" onchange="searchMahasiswa()">
					<option value="">Sort By</option>
					<option value="asc">Ascending</option>
					<option value="desc">Descending</option>
				</select>
			</li>
			<li class="nav-item nav-link loading" style='display:none'>
				<i class="fas fa-spinner fa-pulse"></i>
			</li>
		<?php }?>
</ul>
<hr>

<div class="tab-content">
	<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
		<div class="tabel" id="tabelMahasiswa" nama="mahasiswa">
		</div>
	</div>		



	<div class="tab-pane fade" id="tabel_daftar_admin" role="tabpanel" aria-labelledby="pills-profile-tab"></div>
</div>