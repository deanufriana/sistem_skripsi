<?php if ($konsultasi) {?>
	<div class="card card-outline-secondary">
		<div class="row align-items-center m-5">
			<div class="col-md mb-5">
				<h2>Belum Ada Catatan Bimbingan</h2>
				Catatan bimbingan belum di isi oleh pembimbing, jika anda pembimbing silahkan isi catatan bimbingan mahasiswa ini dengan memasukan form catatan di atas. tanggal bimbingan akan secara otomatis masuk saat anda memasukan catatan saat itu juga.
			</div>
			<div class="col-md-auto">
				<img src="<?= base_url('assets/web/sad.jpg') ?>" >	
			</div>
		</div>

	</div>
<?php } else { ?>
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
<?php } ?>