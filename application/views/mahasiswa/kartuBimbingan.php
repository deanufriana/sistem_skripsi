<div class="form-group col">
		<i class="fas fa-book"></i> <?php foreach ($skripsi->result() as $s) {
			echo $s->JudulSkripsi;
		} ?>
		</div>
		<div class="form-group float-right col-1">
			<i class="fas fa-trash"></i>
		</div>
		
			<table class="table table-borderless" style='width: auto !important;'>
				<thead>
					<tr>
						<th> Nama Dosen </th>
						<th> Status Proposal </th>
						<th> Status Skripsi </th>
						<th> Level </th>
					</tr>
				</thead>
				<?php foreach ($pembimbing->result() as $p) { ?>
				<tbody>
					<td><?php echo $p->Nama; ?></td>
					<td><?php echo $p->StatusProposal; ?></td>
					<td><?php echo $p->StatusSkripsi; ?></td>
					<td><?php echo $p->StatusPembimbing; ?></td>
				</tbody>
				<?php } ?>
			</table>
		