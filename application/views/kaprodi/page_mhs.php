<head>
	<script type="text/javascript" src="<?php echo base_url('assets/js/myscript.js');?>">
	-	</script>
</head>
<div class="table-responsive" id="container">
	<table class="table">
		<thead>
			<tr>
				<th scope="col">NIM</th>
				<th scope="col">Nama</th>
				<th scope="col">No HP</th>
				<th>Email</th>
				<th>Nilai</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($skripsi)): foreach ($skripsi as $u):
				?>
				<tr class="text-left list-item">
					<td><?php echo $u->nim;?></td>
					<td><a class="btn_view" id="pembimbing" href="<?php echo base_url('Kaprodi/pembimbing/'.$u->id_skripsi);?>"><?php echo $u->nama_mhs ?></a></td>
					<td><?= $u->nohp_mhs;?></td>
					<td><?= $u->email_mhs;?></td>
					<td> <?php if ($u->nilai === '0') {
						echo "<form method='post' action=".base_url('Kaprodi/nilai/'.$u->id_skripsi).">
						<input class='form-control form-control-sm' type='number' name='nilai' min='0' max='100'>
						</form>";
					} else {
						echo $u->nilai;
					} ?> 				</td>
				</tr>
				<tr class="list-item">
					<th scope="col">Judul</th>
					<td colspan="4"><?php echo $u->judul_skripsi;?></td>
				</tr>
			<?php endforeach; else: ?>
		</tbody>
	</table>
	<div class="col-md text-center">
		<p>Belum Ada Data.</p>	
	</div>

<div class="SHpembimbing " style="display: none">
	<div id="SHpembimbing">
	</div>	
</div>

<?php endif; ?>
</div>


<?php echo $this->ajax_pagination->create_links(); ?>	