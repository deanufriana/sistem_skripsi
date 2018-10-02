<div class="form-group col">
		<i class="fas fa-book"></i> <?php foreach ($skripsi as $s) {
			echo $s->judul_skripsi;
		} ?>
		</div>
		<div class="form-group float-right col-1">
			<i class="fas fa-trash"></i>
		</div>
		
			<table class="table table-borderless">
				<thead>
					<tr>
						<th> Nama Dosen </th>
						<th> Status Proposal </th>
						<th> Status Skripsi </th>
						<th> Level </th>
					</tr>
				</thead>
				<?php foreach ($pembimbing as $p) { ?>
				<tbody>
					<td><?php echo $p->nama_dosen; ?></td>
					<td><?php echo $p->status_proposal; ?></td>
					<td><?php echo $p->status_skripsi; ?></td>
					<td><?php echo $p->level; ?></td>
				</tbody>
				<?php } ?>
			</table>
		