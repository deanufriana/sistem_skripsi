<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th scope="col">NIM</th>
				<th scope="col">Nama</th>
				<th scope="col">Judul</th>
				<th scope="col">No HP</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($skripsi)): foreach ($skripsi as $u):
				?>
				<tr class="text-left list-item">
					<td><?php echo $u->nim;?></td>
					<td><a class="btn_view" id="pembimbing" href="<?php echo base_url('Kaprodi/pembimbing/'.$u->id_skripsi);?>"><?php echo $u->nama_mhs ?></a></td>
					<td><?php echo $u->judul_skripsi;?></td>
					<td> <?php if ($u->nilai === '0') {
						echo "<form method='post' action=".base_url('Kaprodi/nilai/'.$u->id_skripsi).">
						<input class='form-control' type='number' name='nilai' min='0' max='100'>
						</form>";
					} else {
						echo $u->nilai;
					} ?> 				</td>
				</tr>
			<?php endforeach; else: ?>
		</tbody>
	</table>
	<div class="col-md text-center">
		<p>Belum Ada Data.</p>	
	</div>
<?php endif; ?>
</div>

<?php echo $this->ajax_pagination->create_links(); ?>	