<head>
	<script type="text/javascript" src="<?php echo base_url('assets/js/myscript.js');?>">
	</script>
</head>

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
				<td scope="row"> <?php echo $k->id;?></td>
				<td> <?php echo $k->konsentrasi;?> </td>
				<td> <?php if (empty($k->nama_dosen)) {
					?>
					<form method="POST" action="<?php echo base_url('Admin/ubah_kaprodi/'.$k->id);?>" id="kaprodi">
						<div class="form-row align-items-center">
							<div class="col-md mb-4">
								<select name="kaprodi" class="custom-select mr-sm-2">
									<option selected>Menetapkan Kaprodi <?php echo $k->konsentrasi;?></option>
									<?php foreach ($dosen as $j) {
										?>
										<option value="<?php echo $j->nik;?>"><?php echo $j->nama_dosen;?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-auto">
									<button type="submit" class="btn btn-primary mb-4">Submit</button>
								</div>
							</div>
						</form>
						<?php 
					} else { ?>
						<a id='kaprodi' class='btn_view' href="<?php echo base_url('Admin/form_kaprodi/').$k->id; ?>"><?php echo $k->nama_dosen ?> </a>

						<?php } ?>
					</td>
				</tr>		
			</tbody>
			<?php } ?>
		</table>

		<div class="SHkaprodi" style="display: none">
			<div id="SHkaprodi">

			</div>
		</div>