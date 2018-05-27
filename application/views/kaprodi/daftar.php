<head>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".btn-action").click(function(e) {
				e.preventDefault();
				var form = $(this);
				var formdata = false;
				var id = $(this).attr("id");

				if (window.FormData) {
					formdata = new FormData(form[0]);
				}	
				swal({
					text: "Mahasiswa Mengajukan Pendaftaran Skripsi, ACC?",
					icon: "warning",
					buttons: ["Tolak ?", "Terima?"],
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
						$.ajax({
							type: 'POST',
							url: form.attr('href'),
							data: formdata ? formdata: form.serialize(),
							contentType: false,
							processData: false,
							cache: false,
							success: function() {
								$(".hapus_daftar" + id).fadeOut('slow');
							}
						});
					} else {
						$.ajax({
							type: 'POST',
							url: form.attr('action'),
							data: formdata ? formdata: form.serialize(),
							contentType: false,
							processData: false,
							cache: false,
							success: function() {
								$(".hapus_daftar" + id).fadeOut('slow');
							}
						});
					}
				});
			});
		});
	</script>
</head>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>NIM</th>
			<th>Nama</th>
			<th>Validasi</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($pendaftaran->result() as $m){ ?>
			<tr class="hapus_daftar<?php echo $m->nim;?>">
				<td><?php echo $m->nim;?></td>
				<td><img class="col-1" src="<?php echo base_url('assets/images/').$m->foto;?>"><?php echo $m->nama;?></td>
				<td> <a id="<?php echo $m->nim;?>" class="btn-action" href="<?php echo base_url('Kaprodi/aksi_daftar/'.$m->nim);?>" action="<?php echo base_url('Kaprodi/delete_daftar/'.$m->nim) ;?>"> <button class="btn-action btn btn-outline-primary"> Aksi </button> </a> </td>
			</tr>
			<?php } ?>
		</tbody>	
	</table>
