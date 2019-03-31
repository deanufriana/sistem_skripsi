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


	<div class="row mb-3 ml-2">

			<?php if ($users) {?>
			<input class="form-control form-control-sm col-md ml-1 col" id="keywords_dsn" type="text" name="tabel_dsn_admin/" placeholder="Cari Dosen" onkeyup="searchDosen()" />
			
			<select class="form-control form-control-sm sortBy col-md-1 ml-1 col-2" id="search_dsn" name="cari_dsn"
					onchange="searchDosen()">
					<option value="ID">NIK</option>
					<option value="Nama">Nama</option>
					<option value="Jurusan">Jurusan</option>
				</select>

			<select class="form-control form-control-sm sortBy col-md-1 ml-1 col-2" id="sortBy_dsn" onchange="searchDosen()">
					<option value="asc">Ascending</option>
					<option value="desc">Descending</option>
				</select>
				<div class='col-md-1 col-1'>

				<i class="fas fa-spinner fa-pulse loading" style='display: none'></i>

				</div>
		<?php }?>
		</ul>
	</div>


<div class="tab-content" id="pills-tabContent">
	<div class="tab-pane fade show active" id="pills-dosen" role="tabpanel" aria-labelledby="pills-home-tab">
		<div class="tabel" id="tabelDosen" nama="dosen"></div>
	</div>
</div>