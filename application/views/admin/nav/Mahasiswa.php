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


	<?php if ($users) {?>

<div class='row mb-3 ml-2'>
<input class="form-control form-control-sm col-md col ml-1" id="keywords" type="text" name="tabel_dsn_admin/"
					placeholder="Cari Mahasiswa" onkeyup="searchMahasiswa()" />

			<select class="form-control form-control-sm sortBy col-md-1 col-2 ml-1" id="search" name="cari_dsn" onchange="searchMahasiswa()">
					<option value="ID">NIK</option>
					<option value="Nama">Nama</option>
					<option value="Jurusan">Jurusan</option>
				</select>

			<select class="form-control form-control-sm sortBy col-md-1 col-2 ml-1" id="sortBy" onchange="searchMahasiswa()">
					<option value="">Sort By</option>
					<option value="asc">Ascending</option>
					<option value="desc">Descending</option>
				</select>

			<div class="col-md-1 col-1">
				<i class="fas fa-spinner fa-pulse" style='display:none'></i>
			</div>
			<hr>
</div>

		<?php }?>


<div class="tab-content">
	<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
		<div class="tabel" id="tabelMahasiswa" nama="mahasiswa">
		</div>
	</div>		



	<div class="tab-pane fade" id="tabel_daftar_admin" role="tabpanel" aria-labelledby="pills-profile-tab"></div>
</div>