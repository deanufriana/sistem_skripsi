<head>
	<script type="text/javascript" src="<?= base_url('assets/js/myscript.js');?>">
	</script>
</head>
<div id="container" class="row">
	<div class="col-md table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">ID Fakultas</th>
					<th scope="col">Fakultas</th>
					<th><i class="fas fa-spinner fa-pulse loading" style="display: none"> </i> 
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($jurusan->result() as $j) {
					?>
					<tr class="tabel<?= $j->IDJurusan?>">
						<th scope="row"> <?= $j->IDJurusan;?></th>
						<td> <a id="jurusan" class="btn_view" href="<?= base_url('Admin/tabelKonsentrasiAdmin/').$j->IDJurusan;?>"> <?= $j->Jurusan?> </a> </td>
						<td><a id="<?= $j->IDJurusan;?>" href="<?= base_url('Admin/delete_jurusan/').$j->IDJurusan;?>" class="float-right hapus"><i class="fas fa-trash"> </i></a></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="col-md-8 SHjurusan" style="display: none">
		<div id="SHjurusan">

		</div>
	</div>
</div>