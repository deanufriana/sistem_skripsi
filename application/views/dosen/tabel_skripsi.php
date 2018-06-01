	<div style="height: 26rem">			
		<table class="table table-bordered">
			<thead>
				<tr class="text-center">
					<th>NIM</th>
					<th>Nama</th>
					<th>Status Proposal</th>
					<th>Status Skripsi</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($pembimbing->result() as $u) {
					?>
					<tr>
						<td><?php echo $u->nim;?></td>
						<td><?php echo $u->nama_mhs;?></td>
						<td class="text-center"><?php if ($u->status_proposal === 'Disetujui') {
							echo "<i class='fas fa-check-square'></i>";
						} else {
							echo "<i class='fas fa-square'></i>";
						} ?></td>
						<td class="text-center"><?php if ($u->status_skripsi === 'Disetujui') {
							echo "<i class='fas fa-check-square'></i>";
						} else {
							echo "<i class='fas fa-square'></i>";
						} ?></td>
						<td class="text-center"><?php echo $u->level;?></td>
					</tr>
					<tr>
						<th>Judul Skripsi</th>
						<td colspan="4"><?php echo anchor('Dosen/mhs_profil/'.$u->id_pmb, $u->judul_skripsi);?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>