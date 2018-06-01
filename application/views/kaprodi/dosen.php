<table class="table">
	<thead>
		<tr class="text-center">
			<th>NIK</th>
			<th>Nama Dosen</th>
			<th>Proposal</th>
			<th>Skripsi</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($pembimbing as $d) {
			?>
			<tr>
				<td><?php echo $d->nik;?></td>
				<td><?php echo anchor('Kaprodi/Profildosen/'.$d->nik, $d->nama_dosen);?></td>
				<td class="text-center"><?php if ($d->status_proposal === 'Disetujui') {
					echo "<i class='fas fa-check-square'></i>";
				} else {
					echo "<i class='fas fa-square'></i>";
				} ?></td>
				<td class="text-center"><?php if ($d->status_skripsi === 'Disetujui') {
					echo "<i class='fas fa-check-square'></i>";
				} else {
					echo "<i class='fas fa-square'></i>";
				} ?></td>
				<td class="text-center"><?php echo $d->level;?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>