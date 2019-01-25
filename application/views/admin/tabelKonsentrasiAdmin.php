<head>
	<script type="text/javascript" src="<?php echo base_url('assets/js/myscript.js');?>">
	</script>
</head>
<?php if ($konsentrasi) { ?>
	<div class="table-responsive">
		<table class="table">
			<thead>
				<th>ID</th>
				<th>Konsentrasi</th>
				<th>KaProdi</th>
			</thead>
			<?php foreach ($konsentrasi->result() as $k) {
				?>
				<tbody>
					<tr>
						<td scope="row"> <?php echo $k->IDKonsentrasi;?></td>
						<td> <?php echo $k->Konsentrasi;?> </td>
						<td> <?php if (empty($k->Nama)) { ?>
							<?php if ($users) { ?>
								<form method="POST" action="<?php echo base_url('Admin/submitKaprodi/'.$k->IDKonsentrasi);?>" id="kaprodi<?=$k->IDKonsentrasi;?>">
									<div class="form-row align-items-center">
										<div class="col-md mb-4">
											<select name="kaprodi" class="custom-select small mr-sm-2">
												<option selected>Menetapkan Kaprodi <?php echo $k->Konsentrasi;?></option>
												<?php foreach ($users->result() as $j) { ?>
													<option value="<?php echo $j->ID;?>"><?php echo $j->Nama;?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-auto">
											<button type="submit" class="btn btn-primary mb-4">Submit</button>
										</div>
									<?php } else {
										echo "Tetapkan Dosen Untuk Konsentrasi Ini Dulu Min, :(";
									} ?>
								</div>
							</form>
							<?php 
						} else { ?>
							<a id='kaprodi' class='btn_view' href="<?php echo base_url('Admin/formKaprodi/').$k->IDKonsentrasiUser; ?>"><?php echo $k->Nama ?> </a>
						<?php } ?>
					</td>
				</tr>		
			</tbody>
		<?php } ?>
	</table>
	<div class="SHkaprodi" style="overflow: hidden;" style="display: none">
		<div id="SHkaprodi">

		</div>
	</div>	

</div>
<?php } else { ?>
	<div class="col-md-auto text-center">
		<div class='container-fluid mt-5'>
			<div class='row align-items-center'>
				<div class='col-md'>
					<h2>Belum Ada Konsentrasi Untuk Fakultas Ini, Min.</h2>
					Silahkan Tambahkan Konsentrasi Fakultas Dengan Memasukannya Melalui Form Konsentrasi Di Atas. 
				</div>
				<div class='col-md-3'>
					<img src="<?= base_url('assets/images/fix/sad.jpg')?>">
				</div>
			</div>
		</div>
	</div>
	<?php } ?>