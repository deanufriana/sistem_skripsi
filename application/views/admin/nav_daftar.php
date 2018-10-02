<head>
	<script type="text/javascript" src="<?= base_url('assets/js/mySkrips.js');?>"></script>
</head>
<div class="form-row">

	<div class="form-group col-md">
		<input class="form-control" id="keywords_mhs" type="text" placeholder="Cari Mahasiswa" onkeyup="search_daftar()"/>
	</div>
	<div class="form-group col-md-2">
		<select class="form-control" id="cari_mhs" name="cari_mhs" onchange="search_daftar()">
			<option value="nim">NIM</option>
			<option value="nama_mhs">Nama</option>
			<option value="jurusan">Jurusan</option>
		</select>
	</div>
	<div class="form-group col-md-2">
		<select class="form-control " id="sortBy_mhs" onchange="search_daftar()">
			<option value="asc">Ascending</option>
			<option value="desc">Descending</option>
		</select>
	</div>
	<div class="form-group col-md-1 m-1 loading" style="display: none">
		<i class="fas fa-spinner fa-pulse"></i>
	</div>
</div>

<div class="tabel table-responsive" id="tabel_mhs_daftar" nama="mahasiswa">
	<table class="table">
		<thead>
			<tr>
				<th scope="col">NIM</th>
				<th scope="col">Nama</th>
				<th scope="col">Jurusan</th>
				<th scope="col">Konsentrasi</th>
				<th scope="col">No HP</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($mhs)): foreach ($mhs as $m): ?>
				<tr class="list-item tabel<?= $m->nim;?>">
					<td><?= $m->nim;?></td>
					<td><?= $m->nama_mhs;?></td>
					<td><?= $m->jurusan;?></td>
					<td><?= $m->konsentrasi;?></td>
					<td><?= $m->nohp_mhs;?></td>
					<td><a id="<?= $m->nim;?>" class="btn-action" action="<?= base_url('Admin/aksi_daftar/');?>"> <button class="btn-action btn-sm btn btn-outline-primary"> Aksi </button> </a></td>
				</tr>	
			<?php endforeach; else: ?>
			<p>Belum Ada Data.</p>
		<?php endif; ?>
		
	</tbody>

</table>
<?= $this->ajax_pagination->create_links(); ?>
</div>