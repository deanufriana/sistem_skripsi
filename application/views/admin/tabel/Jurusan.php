	<script type="text/javascript" src="<?= base_url('assets/js/myscript.js');?>"></script>
	<div class='container-fluid'>
	<?php if (!$jurusan) {?>

			<div class="row align-items-center">
				<div class="col-md">
					<h2>Selamat data admin</h2>
					Sistem skripsi online berbasis web disini merupakan data jurusan dan konsentrasi silahkan masukan data jurusan melalui form jurusan di atas. 
				</div>
				<div class="col-md-3">
					<img src="<?= base_url('assets/web/welcome.png');?>">
				</div>
			</div>

	<?php } else { ?>
		<div id="container" class="row">
			<div class="table-responsive mr-3 col-md-3 col">
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
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<div class="SHjurusan col-md-auto" style="display: none">
				<div id="SHjurusan"></div>
			</div>
		</div>
		<?php } ?>

		</div>