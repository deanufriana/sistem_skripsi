<head>
	<script type="text/javascript">
		function searchmhs(page_num) {
			page_num = page_num ? page_num : 0;
			var keywords = $('#keywords').val();
			var search = $('#search').val();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>Dosen/tabelSkripsi/' + page_num,
				data: 'page=' + page_num + '&keywords=' + keywords + '&search=' + search,
				beforeSend: function () {
					$('.loading').show();
				},
				success: function (html) {
					console.log(html)
					$('#tabelUser').html(html);
					$('.loading').fadeOut("slow");
				}
			});
		}

	</script>
</head>

<?php if ($users) {?>
<div id="tabelUser">
<table class="table table-bordered">
	<thead>
		<tr class="text-center">
			<th>Nama / NIM</th>
			<th colspan="2">Pembimbing</th>
			<th>Proposal</th>
			<th>Skripsi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users->result() as $u) {?>
		<tr>
			<td style="vertical-align : middle;text-align:center;" rowspan="2">
				<a href="<?php echo base_url('Dosen/detailMahasiswa/' . $u->IDMahasiswaSkripsi); ?>">
					<?=$u->Nama . ' / ' . $u->ID?></a> </td>
			<?php foreach ($pembimbing->result() as $p) { ?>
			<?php if ($u->IDSkripsi === $p->IDSkripsiPmb) {  ?>
			<td>
				<?php echo anchor('Dosen/detailDosen/' . $p->IDDosenPmb, $p->Nama); ?>
			</td>
			<td>
				<?=$p->StatusPembimbing?>
			</td>

			<td class="text-center">
				<?php if ($p->StatusProposal) {  echo "<i class='fas fa-check-square'></i>"; } else { echo "<i class='fas fa-square'></i>"; }?>
			</td>

			<td class="text-center">
				<?php if ($p->StatusSkripsi) {   echo "<i class='fas fa-check-square'></i>"; } else { echo "<i class='fas fa-square'></i>"; }?>
			</td>
		</tr>
		<?php }}?>
		<tr>
			<th>Judul Skripsi</th>
			<td colspan="2">
				<?php echo anchor('Dosen/detailMahasiswa/' . $u->ID, $u->JudulSkripsi); ?>
			</td>
			<td class="text-center"><a <?php if (empty($u->FileProposal)) {  echo ""; } else { echo "href=" . base_url("ControllerGlobal/downloadFile/" . $u->FileProposal);}?>> <i class="fa fa-download"></i> </a>
			</td>
			<td class="text-center"> <a <?php if (empty($u->FileSkripsi)) { echo ""; } else { echo "href=" . base_url("ControllerGlobal/downloadFile/" . $u->FileSkripsi); }?>> <i class="fa fa-download"></i> </a> 
			</td>
		</tr>

		<?php }?>
	</tbody>
</table>
</div>

<?php echo $this->ajax_pagination->create_links(); ?>
<?php } else {?>
<div class="container">
	<div class="row align-items-center m-5">
		<div class="col-md mb-5">
			<?php if ($_SESSION['Kaprodi']) {?>
			<h2>Tidak ada Mahasiswa Jurusan</h2>
			Saat ini tidak ada mahasiswa yang sedang melakukan bimbingan skripsi
			<?php } else {?>
			<h2> Mahasiswa yang Dibimbing Tidak Ditemukan </h2>
			Saat ini belum ada mahasiswa yang harus dibimbing silahkan tunggu kaprodi menentukan anda sebagai dosen pembimbing.
			<?php }?>
		</div>
		<div class="col-md-3">
			<img src="<?=base_url('assets/web/sad.jpg')?>">
		</div>
	</div>

</div>
<?php }?>
