<div class="card-body">
	<div class="form-row">
		<div class="form-group col-md-11">

			<h6> <i class="fas fa-book fa-sm"></i> <?php foreach ($skripsi->result() as $s) {
				echo $s->JudulSkripsi; ?> 
			</h6>	

			<?= word_limiter($s->Deskripsi, 20); } ?>
			
			<div class="form-row mt-3">
				<div class="col-md m-3">
					<?php if ($pmb->num_rows() > 1) { 
						$file = $s->FileSkripsi;
						$sesi = 'Skripsi';
					} else { 
						$file = $s->FileProposal;
						$sesi = 'Proposal';
					} ;?>

					<?php 

					$proposal = $s->FileProposal;

					$skripsi = $s->FileSkripsi;
					
					if (empty($proposal)) {
						$disablep = 'disabled';
					} else {
						$disablep = '';
					}

					if (empty($skripsi)) {
						$disables = 'disabled';
					} else {
						$disables = '';
					} 
					?>

					<a class="card-body" <?php if (empty($proposal)) {
						echo "";
					} else {
						echo "href=".base_url("ControllerGlobal/downloadFile/".$proposal);
					} ?>> <i class="fa fa-download"></i> Proposal </a>
					
					<a class="card-body" <?php if (empty($skripsi)) {
						echo "";
					} else {
						echo "href=".base_url("ControllerGlobal/downloadFile/".$skripsi);
					} ?>> <i class="fa fa-download"></i> Skripsi </a>

				</div>
				<div class="col-md-5">
					<form method="post" id="mydata" action="<?php echo base_url('Mahasiswa/uploadData/'.$sesi.'/'.$s->IDSkripsi);?>" enctype="multipart/form-data">
						<div class="input-group">
							<div class="custom-file">
								<input type="file" name="<?= $sesi ?>" class="custom-file-input col custom-file-control" required>
								<label class="custom-file-label">Upload  <?= $sesi ?></label>					
							</div>
							<div class="input-group-append"> 
								<button class="btn btn-outline-primary" type="submit"> Upload </button>					
							</div>
						</div>
						<small> File harus berbentuk PDF </small>
					</form>		
				</div>
			</div>
			
		</div>
		<div class="form-group col-md-1">
			<div class="float-right">
				<a href="<?php echo base_url('Cetak/kartu/').$this->session->userdata('ID');?>"> <button class="btn btn-outline-primary"> <i class="fas fa-print"> </i> Cetak </button> </a>	
			</div>
		</div>
	</div>

	<div class="form-row table-responsive" id="skripsi">		
		<table class="table table-borderless table-sm">
			<thead class="small">
				<tr>
					<th> Nama </th>
					<th class="text-center"> Proposal </th>
					<th class="text-center">Skripsi</th>
					<th >Status Pembimbing</th>
				</tr>
			</thead>
			<?php foreach ($pembimbing->result() as $p) { ?>
				<tbody class="small"> 
					<td><?php echo $p->Nama; ?></td>
					<td class="text-center"><?php if ($p->StatusProposal) {
						echo "<i class='fas fa-check-square'></i>";
					} else {
						echo "<i class='fas fa-square'></i>";
					} ?></td>
					<td class="text-center"><?php if ($p->StatusSkripsi) {
						echo "<i class='fas fa-check-square'></i>";
					} else {
						echo "<i class='fas fa-square'></i>";
					} ?></td>
					<td><?php echo 'Pembimbing '.$p->StatusPembimbing; ?></td>
				</tbody>
			<?php } ?>
		</table>
	</div>
	<div id="table-wrapper">
		<div class="mt-2" style="overflow:auto; height: 15rem">
			<table class="table table-sm small">
				<thead>
					<tr>
						<th>No</th>
						<th style="width: 12rem">Tanggal</th>
						<th>Pembimbing</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($konsultasi)): ?>
						<?php $no = '1'; ?>
						<?php foreach ($konsultasi->result() as $k) {	?>
							<tr>
								<td><?php echo $no++;?></td>
								<td><?php echo longdate_indo($k->TanggalBimbingan);?></td>
								<td><?php echo $k->Nama;?></td>
							</tr>
							<tr>
								<th>Catatan</th>
								<td colspan="3"><?php echo $k->Catatan;?></td>
							</tr>
						<?php } ?>
					<?php endif ?>
				</tbody>	
			</table>
		</div>
	</div>
</div>