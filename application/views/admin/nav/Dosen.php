<script type="text/javascript">
	function searchDosen(page_num) {
		page_num = page_num ? page_num : 0;
		var keywords = $('#keywords_dsn').val();
		var sortBy = $('#sortBy_dsn').val();
		var search = $('#search_dsn').val();
		user = 'Dosen';

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>Admin/tabelNavigasi/' + page_num + '/' + user,
			data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy + '&search=' + search + '&user=' + user,
			beforeSend: function () {
				$('.loading').show();
			},
			success: function (html) {
				$('#tabelDosen').html(html);
				$('.loading').fadeOut("slow");
			}
		});
	}

	$("#tabelDosen").load('<?=base_url('admin/tabelNavigasi/0/Dosen');?>');

</script>

<div class='row mb-2'>
	<div class="col-md-auto">
		<ul class="nav nav-pills text-center" id="pills-tab" role="tablist">
			<li class="nav-item btn-sm">
				<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-dosen" role="tab"
					aria-controls="pills-home" aria-selected="true">Data Dosen</a>
			</li>
			<?php if ($users) {?>
			<li class="nav-item nav-link">
			<input class="form-control form-control-sm" id="keywords_dsn" type="text" name="tabel_dsn_admin/"
					placeholder="Cari Dosen" onkeyup="searchDosen()" />
			</li>
			<li class="nav-item nav-link">
			<select class="form-control form-control-sm sortBy" id="search_dsn" name="cari_dsn"
					onchange="searchDosen()">
					<option value="ID">NIK</option>
					<option value="Nama">Nama</option>
					<option value="Jurusan">Jurusan</option>
				</select>
			</li>
			<li class="nav-item nav-link">
			<select class="form-control form-control-sm sortBy" id="sortBy_dsn" onchange="searchDosen()">
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
	</div>
</div>

<div class="tab-content" id="pills-tabContent">
	<div class="tab-pane fade show active" id="pills-dosen" role="tabpanel" aria-labelledby="pills-home-tab">
		<div class="tabel" id="tabelDosen" nama="dosen"></div>
	</div>
</div>