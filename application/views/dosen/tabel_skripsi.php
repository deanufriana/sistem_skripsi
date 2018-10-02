	<div style="height: 26rem">			
		<table class="table table-bordered">
			<thead>
				<tr class="text-center">
					<th>NIM</th>
					<th>Nama</th>
					<th colspan="2">Proposal</th>
					<th colspan="2">Skripsi</th>
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
						<td class="text-center"><a 
							<?php if (empty($u->file_proposal)) {
							echo "";
						} else {
							echo "href=".base_url("ControllerGlobal/downloadFile/".$u->file_proposal);
						} ?>> <i class="fa fa-download"></i> </a></td> 		
						<td class="text-center"><?php if ($u->status_skripsi === 'Disetujui') {
							echo "<i class='fas fa-check-square'></i>";
						} else {
							echo "<i class='fas fa-square'></i>";
						} ?></td>

						
						<td class="text-center"> <a 
							<?php if (empty($u->file_skripsi)) {
							echo "";
						} else {
							echo "href=".base_url("ControllerGlobal/downloadFile/".$u->file_skripsi);
						} ?>> <i class="fa fa-download"></i> </a> </td>
						<td class="text-center"><?php echo $u->level;?></td>
					</tr>
					<tr>
						<th>Judul Skripsi</th>
						<td colspan="6"><?php echo anchor('Dosen/mhs_profil/'.$u->id_pmb, $u->judul_skripsi);?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>