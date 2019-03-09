<?php if ($users) { ?>
<table class="table">
	<thead>
		<tr>
			<td>Nama</td>
			<td>Judul Skripsi</td>
			<td>Proposal</td>
			<td>Skripsi</td>
			<td>Nilai</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($users->result() as $u) { ?>
            <td><?= $u->Nama ?></td>
            <td><?= $u->JudulSkripsi  ?></td>
            <td><?= anchor('ControllerGlobal/downloadFile/Proposal/'.$u->FileProposal, '<i class="fas fa-download"></i>') ?></td> 
            <td><?= anchor('ControllerGlobal/downloadFile/Skripsi/'.$u->FileSkripsi, '<i class="fas fa-download"></i>') ?></td> 
            <td><?= $u->Nilai ?></td> 
        <?php } ?>
	</tbody>
</table>
<?php } else { ?>
	<div class='row align-items-center'>
		<div class='col-md'>
			<h2>Dokumentasi Skripsi Tidak ditemukan</h2>
		</div>
		<div class='col-md-5'>
			<img class="card-img-top" src="<?= base_url('assets/web/ide.jpg')?>">
		</div>
	</div>
<?php } ?>