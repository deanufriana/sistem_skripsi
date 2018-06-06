<table class="table small">
	<thead>
		<tr>
			<th scope="col">NIM</th>
			<th scope="col">Nama</th>
			<th scope="col">Jurusan</th>
			<th scope="col">Konsentrasi</th>
			<th scope="col">Email</th>
			<th scope="col">No HP</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($mhs)): foreach ($mhs as $m): ?>
			<tr class="list-item">
				<td><?= $m->nim;?></td>
				<td><?= $m->nama_mhs;?></td>
				<td><?= $m->jurusan;?></td>
				<td><?= $m->konsentrasi;?></td>
				<td><?= $m->email_mhs;?></td>
				<td><?= $m->nohp_mhs;?></td>
				<td><?php if ($m->status === 'Mahasiswa') {	?>
					<a class="href-mhs" id="<?= $m->nim;?>" href="<?= base_url('Admin/status/'.$m->nim);?>">
						<?php echo $m->status;?>
					</a>
				<?php } 
				else {
					echo $m->status; } 	?>
				</td>
			</tr>	
		<?php endforeach; else: ?>
		<p>Belum Ada Data.</p>
	<?php endif; ?>
</tbody>
</table>
<?php echo $this->ajax_pagination->create_links(); ?>