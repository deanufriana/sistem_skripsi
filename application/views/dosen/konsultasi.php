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
		<?php foreach ($konsultasi->result() as $k) { ?>
			<tr>
				<td><?= $no++;?></td>
				<td><?= longdate_indo($k->TanggalBimbingan);?></td>
				<td><?= $k->Nama;?></td>
			</tr>
			<tr>
				<th> Catatan </th>
				<td colspan="2"><?= $k->Catatan;?></td>

			</tr>
		<?php } ?>
	</tbody>
</table>