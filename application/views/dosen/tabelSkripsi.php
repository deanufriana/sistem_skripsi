<?php if (!empty($users)) { ?>
	<table class="table table-bordered">
		<thead>
			<tr class="text-center">
				<th>NIM</th>
				<th>Nama</th>
				<th colspan="2">Pembimbing</th>
				<th>Proposal</th>
				<th>Skripsi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($users->result() as $u) {
				?>
				<tr>
					<td style="vertical-align : middle;text-align:center;" rowspan="2"><?php echo $u->ID;?></td>
					<td style="vertical-align : middle;text-align:center;" rowspan="2"><a href="<?php echo base_url('Dosen/detailMahasiswa/'.$u->IDMahasiswaSkripsi);?>"><?php echo $u->Nama ?></a></td>
					<?php foreach ($pembimbing->result() as $p) { ?>
						<?php if ($u->IDSkripsi === $p->IDSkripsiPmb) {
							# code...
							?>
							<td><?php echo anchor('Dosen/detailDosen/'.$p->IDDosenPmb, $p->Nama);?></td>
							<td><?= $p->StatusPembimbing ?></td>

							<td class="text-center">
								<?php if ($p->StatusProposal) {
									echo "<i class='fas fa-check-square'></i>";
								} else {
									echo "<i class='fas fa-square'></i>";
								} ?>

							</td>

							<td class="text-center">
								<?php if ($p->StatusSkripsi) {
									echo "<i class='fas fa-check-square'></i>";
								} else {
									echo "<i class='fas fa-square'></i>";
								} ?></td>
							</tr>
						<?php }} ?>
						<tr>
							<th>Judul Skripsi</th>
							<td colspan="3"><?php echo anchor('Dosen/detailMahasiswa/'.$u->ID, $u->JudulSkripsi);?></td>
							<td class="text-center"><a 
								<?php if (empty($u->FileProposal)) {
									echo "";
								} else {
									echo "href=".base_url("ControllerGlobal/downloadFile/".$u->FileProposal);
								} ?>> <i class="fa fa-download"></i> </a></td> 	
								<td class="text-center"> <a 
									<?php if (empty($u->FileSkripsi)) {
										echo "";
									} else {
										echo "href=".base_url("ControllerGlobal/downloadFile/".$u->FileSkripsi);
									} ?>> <i class="fa fa-download"></i> </a> </td>
								</tr>

							<?php  } ?>
						</tbody>
					</table>
					<?php echo $this->ajax_pagination->create_links(); ?>
					<?php
				} else {
					echo "Tidak Ditemukan";
				}