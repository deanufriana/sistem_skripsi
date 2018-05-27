<head>
	<script type="text/javascript" src="<?php echo base_url('assets/js/myscript.js');?>">
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
				<?php foreach ($jurusan as $j) {
					?>
					<tr class="tabel<?php echo $j->id_jurusan?>">
						<th scope="row"> <?php echo $j->id_jurusan;?></th>
						<td> <a id="jurusan" class="btn_view" href="<?php echo base_url('Admin/tabel_konsentrasi_admin/').$j->id_jurusan;?>"> <?php echo $j->jurusan?> </a> </td>
						<td><a id="<?php echo $j->id_jurusan;?>" href="<?php echo base_url('Admin/delete_jurusan/').$j->id_jurusan;?>" class="float-right hapus"><i class="fas fa-trash"> </i></a></td>
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