	<div style="height: 26rem">			
		<table class="table table-bordered">
			<thead>
				<tr class="text-center">
					<th>NIM</th>
					<th>Nama</th>
					<th>Judul</th>
					<th>Status Proposal</th>
					<th>Status Skripsi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($pembimbing->result() as $u) {
					?>
					<tr>
						<td><?php echo $u->nim;?></td>
						<td><?php echo $u->nama_mhs;?></td>
						<td><?php echo anchor('Dosen/mhs_profil/'.$u->id_pmb, $u->judul_skripsi);?></td></a>
						<td><?php echo $u->status_proposal;?></td>
						<td><?php echo $u->status_skripsi;?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		</div>