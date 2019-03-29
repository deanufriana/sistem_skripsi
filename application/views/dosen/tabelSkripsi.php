<head>
	<script type="text/javascript">
		$(document).ready(function () {

			$(document).on("keydown", ".edit", function (e) {
				if (e.keyCode == 13) {
					var target = $(e.target);
					var value = target.val();
					var id = target.attr("data-id");
					var data = {
						id: id,
						value: value
					};
					if (target.is(".field-name")) {
						data.modul = "nilai";
					}

					$.ajax({
						type: "post",
						cache: false,
						dataType: "json",
						data: data,
						url: "<?php echo base_url('Kaprodi/nilai'); ?>",
						success: function (a) {
							target.hide();
							target.siblings("span[class~='caption']").html(value).fadeIn();
						}

					})

				}

			});
		});

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
			<?php foreach ($users->result() as $u) { ?>
			<tr>
				<td style="vertical-align : middle;text-align:center;" rowspan="2">
					<?= anchor('Dosen/detailMahasiswa/'.$u->IDMahasiswaSkripsi, $u->Nama.' / '.$u->ID);?>
				</td>

				<?php foreach ($pembimbing->result() as $p) { ?>
				<td>
					<?= anchor('Dosen/detailDosen/' . $p->IDDosenPmb, $p->Nama); ?>
				</td>
				<td style="vertical-align : middle;text-align:center;">
					<?=$p->StatusPembimbing?>
				</td>

				<td class="text-center">
					<?php if ($p->StatusProposal) {  echo "<i class='fas fa-check-square'></i>"; } else { echo "<i class='fas fa-square'></i>"; }?>
				</td>

				<td class="text-center">
					<?php if ($p->StatusSkripsi) {   echo "<i class='fas fa-check-square'></i>"; } else { echo "<i class='fas fa-square'></i>"; }?>
				</td>
			</tr>
			<?php }?>
			<tr>

				<th>Judul Skripsi</th>
				<td>
					<?= anchor('Dosen/detailMahasiswa/' . $u->ID, $u->JudulSkripsi); ?>
				</td>
				<td>
					<?php if ($finish) {
						if (($finish->num_rows() === 2) AND ($_SESSION['Kaprodi'])) {
						
						if ($u->Nilai === NULL) {
							echo "<input data-id=".$u->IDSkripsi." class='form-control form-control-sm field-name edit' type='number' name='nilai' min='0' max='100' value=".$u->Nilai.">";
						} else {
							echo "<span class='caption'>".$u->Nilai."</span>";
						}
					}} ?>
				</td>
				<td class="text-center"><a <?php if (empty($u->FileProposal)) { echo ""; } else { echo "href=" .
						base_url("ControllerGlobal/downloadFile/Proposal/" . $u->FileProposal);}?>> <i class="fa fa-download"></i> </a>
				</td>
				<td class="text-center"> <a <?php if (empty($u->FileSkripsi)) { echo ""; } else { echo "href=" .
						base_url("ControllerGlobal/downloadFile/Skripsi/" . $u->FileSkripsi); }?>> <i class="fa fa-download"></i> </a>
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
