<head>
	<script type="text/javascript" src="<?php echo base_url('assets/js/myscript.js');?>">
	</script>
	<script type="text/javascript">
		function searchmhs(page_num) {
			page_num = page_num?page_num:0;
			var keywords = $('#keywords_mhs').val();
			var cari_mhs = $('#cari_mhs').val();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>Kaprodi/page_mhs/'+page_num,
				data:'page='+page_num+'&keywords='+keywords+'&cari_mhs='+cari_mhs,
				beforeSend: function () {
					$('.loading').show();
				},
				success: function (html) {
					$('.tabel_mahasiswa').html(html);
					$('.loading').fadeOut("slow");
				}
			});
		}

		$('.tabel_mahasiswa')load('<?= base_url('Mahasiswa/page_mhs');?>');
	</script>
</head>
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
	<div class="table-responsive tabel_mahasiswa">
	</div>
<?php endforeach; else: ?>
<div class="col-md">
	<p>Belum Ada Data.</p>	
</div>

<?php endif; ?>

</div>


<hr>
<div class="SHpembimbing " style="display: none">
	<div id="SHpembimbing">
	</div>	
</div>