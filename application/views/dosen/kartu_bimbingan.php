<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Catatan</th>
				<th>Pembimbing</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1 ?>
			<?php foreach ($konsultasi->result() as $k) { ?>
				<tr class="tabel_catatan<?php echo $k->id_konsultasi;?>">
					<td><?php echo $no++;?></td>
					<td><?php echo longdate_indo($k->tanggal);?></td>
					<td><?php echo $k->catatan;?></td>
					<td><?php echo $k->pembimbing;?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>