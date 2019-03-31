<head>
	<script type="text/javascript" src="<?php echo base_url('assets/js/myscript.js');?>">
	</script>
</head>
<?php if ($konsentrasi) { ?>
	<div>
		<table class="table w-auto">
			<thead>
				<th>ID</th>
				<th>Konsentrasi</th>
				<th>KaProdi</th>
			</thead>
			<?php foreach ($konsentrasi->result() as $k) { ?>
				<tbody>
					<tr>
						<td scope="row"> <?php echo $k->IDKonsentrasi;?></td>
						<td> <?php echo $k->Konsentrasi;?> </td>
						<td> <?php if (empty($k->Nama)) { ?>
							<?php if ($users) { ?>
								<form class='mb-2' method="POST" action="<?php echo base_url('Admin/submitKaprodi/'.$k->IDKonsentrasi);?>" id="kaprodi<?=$k->IDKonsentrasi;?>">
									<div class="form-row">
										<div class="col">
											<select name="kaprodi" class="custom-select form-control-sm small">
												<option selected>Menetapkan Kaprodi <?php echo $k->Konsentrasi;?></option>
												<?php foreach ($users->result() as $j) { ?>
												<?php if ($j->IDKonsentrasiUser === $k->IDKonsentrasi) { ?>
													<option value="<?php echo $j->ID;?>"><?php echo $j->Nama;?></option>
												<?php } ?>
												<?php } ?>
											</select>
										</div>
										<div class="col-auto">
											<button type="submit" class="btn btn-sm btn-primary"> <i class='fas fa-paper-plane'></i> </button>
										</div>
									<?php } else {
										echo "mohon masukan data dosen untuk konsentrasi ini";
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
					<h2>Konsentrasi untuk fakultas ini tidak ditemukan.</h2>
					Silahkan tambahkan konsentrasi fakultas dengan memasukannya melalui form konsentrasi di atas. 
				</div>
				<div class='col-md-3'>
					<img src="<?= base_url('assets/web/sad.jpg')?>">
				</div>
			</div>
		</div>
	</div>
	<?php } ?>