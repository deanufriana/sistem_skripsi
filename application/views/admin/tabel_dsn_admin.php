<head>
</head>
<table class="table">
	<thead>
		<tr>
			<th scope="col">NIK</th>
			<th scope="col">Nama</th>
			<th scope="col">Jurusan</th>
			<th scope="col">Email</th>
			<th scope="col">No HP</th>
		</tr>
	</thead>
	<tbody id="dsn">
		<?php if (!empty($dosen)): foreach ($dosen as $d): ?>
			<tr>
				<td><?= $d->nik;?></td>
				<td><?= $d->nama_dosen;?></td>
				<td><?= $d->jurusan;?></td>
				<td><?= $d->email_dsn;?></td>
				<td><?= $d->nohp_dsn;?></td>
			</tr>	
		<?php endforeach; else: ?>
		<p>Data tidak ditemukan.</p>
	<?php endif; ?>
</tbody>
</table>
<?= $this->ajax_pagination->create_links(); ?>