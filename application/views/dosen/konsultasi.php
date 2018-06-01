<table class="table small">
	<thead>
		<tr>
			<th>No</th>
			<th>Tanggal</th>
			<th>Pembimbing</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1 ?>
		<?php foreach ($konsultasi as $k) { ?>
			<tr>
				<td><?= $no++;?></td>
				<td><?= longdate_indo($k->tanggal);?></td>
				<td><?= $k->pembimbing;?></td>
			</tr>
			<tr>
				<th> Catatan </th>
				<td colspan="2"><?= $k->catatan;?></td>

			</tr>
		<?php } ?>
	</tbody>
</table>