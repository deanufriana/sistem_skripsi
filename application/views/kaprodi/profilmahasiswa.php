<head> <script type="text/javascript">

	$(document).ready(function(){

		$(".form_action").on('submit',
			function(e) {
				e.preventDefault();
				var form = $(this);
				var formdata = false;
				if (window.FormData) {
					formdata = new FormData(form[0]);
				}	
				swal({
					title: "Are you sure?",
					text: "Once deleted, you will not be able to recover this imaginary file!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
						$.ajax({
							type: 'POST',
							url: form.attr('action'),
							data: formdata ? formdata: form.serialize(),
							contentType: false,
							processData: false,
							cache: false,
							success: function() {
								location.reload();
							}
						});
					} else {
						swal("Your imaginary file is safe!");
					}
				});
			});
	});
	$(document).ready(function(){
		$("#proposal").on('submit',
			function(e) {
				e.preventDefault();
				var form = $(this);
				var formdata = false;
				if (window.FormData) {
					formdata = new FormData(form[0]);
				}	
				swal({
					title: "Are you sure?",
					text: "Once deleted, you will not be able to recover this imaginary file!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
						$.ajax({
							type: 'POST',
							url: form.attr('action'),
							data: formdata ? formdata: form.serialize(),
							contentType: false,
							processData: false,
							cache: false,
							success: function() {
								location.reload();
							}
						});
					} else {
						swal("Your imaginary file is safe!");
					}
				});
			});
	});
	$(document).ready(function(){
		$("#nilai_proposal").on('submit',
			function(e) {
				e.preventDefault();
				var form = $(this);
				var formdata = false;
				if (window.FormData) {
					formdata = new FormData(form[0]);
				}	
				swal({
					title: "Are you sure?",
					text: "Once deleted, you will not be able to recover this imaginary file!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
						$.ajax({
							type: 'POST',
							url: form.attr('action'),
							data: formdata ? formdata: form.serialize(),
							contentType: false,
							processData: false,
							cache: false,
							success: function() {
								location.reload();
							}
						});
					} else {
						swal("Your imaginary file is safe!");
					}
				});
			});
	});
	$(document).ready(function(){
		$("#nilai_skripsi").on('submit',
			function(e) {
				e.preventDefault();
				var form = $(this);
				var formdata = false;
				if (window.FormData) {
					formdata = new FormData(form[0]);
				}	
				swal({
					title: "Are you sure?",
					text: "Once deleted, you will not be able to recover this imaginary file!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
						$.ajax({
							type: 'POST',
							url: form.attr('action'),
							data: formdata ? formdata: form.serialize(),
							contentType: false,
							processData: false,
							cache: false,
							success: function() {
								location.reload();
							}
						});
					} else {
						swal("Your imaginary file is safe!");
					}
				});
			});
	});
	$(document).ready(function(){
		$("#catatan").on('submit',
			function(e) {
				e.preventDefault();
				var form = $(this);
				var formdata = false;

				if (window.FormData) {
					formdata = new FormData(form[0]);
				}

				var formAction = form.attr('action');

				$.ajax({
					type: 'POST',
					url: formAction,
					data: formdata ? formdata: form.serialize(),
					contentType: false,
					processData: false,
					cache: false,
					success: function() {
						location.reload();
					}
				});
			});
	});

</script></head>
<?php foreach ($pembimbing->result() as $u) {
	?>
	<div class="container-fluid">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-2 mr-auto">
						<img class="card-img-top" src="<?php echo base_url('assets/images/'.$u->foto_mhs) ;?>">
					</div>
					<div class="col">
						<div class="form-row">
							<div class="form-group col-5">
								<h3 class="card-title text-left"><?php echo $u->nama_mhs;?></h3>
								<div class="card-subtitle text-muted"> <?php echo $u->nim;?> / <?php echo $u->email_mhs;?> </div>
								<div>
									No. HP : <?php echo $u->nohp_mhs;?> 
								</div>
							</div>						
							<div class="form-group col text-right">
								<div><h5><?php echo $u->judul;?></h5></div>
							</div>
						</div>
						
					</div>	
					<div class="col" <?php if ($u->nilai_proposal === '0') {
						echo 'style="display: none;"';
					} ?>>
					<label>Skripsi</label>
					<div class="form-row">
						<div class="form-group col" <?php if ($u->acc_skripsi === 'Disetujui') {
							echo 'style="display: none;"';
						} ?>>
						<form class="form_action" method="POST" action="<?php echo base_url('Dosen/acc_skripsi/'.$u->id_pmb);?>">
							<input type="submit"  name="" class="btn btn-outline-primary" value="Accept">
						</form>
					</div>
					<form <?php if ($u->nilai_skripsi != '0') {
						echo 'style="display: none;"';
					} ?> class="form-row col form_action" action="<?php echo base_url('Dosen/nilai_skripsi/').$u->id_pmb;?>">
					<div class="form-group">
						<input class="form-control" type="number" name="nilai_skripsi">
						<small>Nilai Sidang Skripsi </small>
					</div>
					<div class="form-group col">
						<input type="submit" name="" class="btn btn-primary" value="Submit">
					</div>
				</form>
				<?php if ($u->nilai_skripsi != '0') {
					echo '<div class="card-body"> Nilai : '.$u->nilai_skripsi.'</div>' ;
				}?>
			</div>
		</div>
	</div>
</div>
</div>
<?php } ?>

<hr>
<div>
	<div>
		<div class="form-row">
			<div class="form-group col-9">
				<h4> <i class="fas fa-pencil-alt"></i> Kartu Bimbingan </h4>	
			</div>
			<div class="form-group text-right col">
				<button class="btn btn-outline-primary mb-2"> <i class="fas fa-print"></i> Cetak Kartu</button>		
				<button class="btn btn-outline-primary mb-2"> <i class="fas fa-print"></i> Cetak Surat</button>
			</div>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal</th>
					<th>Catatan</th>
					<th>Pembimbing</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1 ?>
				<?php foreach ($konsultasi->result() as $k) { ?>
					<tr>
						<th scope="row"><?php echo $no++;?></th>
						<td><?php echo longdate_indo($k->tanggal);?></td>
						<td><?php echo $k->catatan;?></td>
						<td><?php echo $k->pembimbing;?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>

		</div>
	</div>

</div>
</div>



</div>
</div>