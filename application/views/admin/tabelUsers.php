<head>
	<script type="text/javascript">

		$(document).ready(function(){
			$(".btn-action").click(function(e) {
				e.preventDefault();
				var form = $(this);
				var formdata = false;
				var id = $(this).attr("id");
				var action = $(this).attr("action");

				if (window.FormData) {
					formdata = new FormData(form[0]);
				}

				swal({
					text: "Mahasiswa Mengajukan Pendaftaran, ACC?",
					icon: "warning",
					buttons: ["Tolak ?", "Terima?"],
					dangerMode: true,
				})
				.then((willDelete) => {
					$.ajax({
						type: 'POST',
						url: action+id+'/'+willDelete,
						data: formdata ? formdata: form.serialize(),
						contentType: false,
						processData: false,
						cache: false,
						success: function() {
							$("#tabel_mahasiswa_admin").load('<?php echo base_url('admin/tabelNavigasi/0/Mahasiswa'); ?>');
						}
					})
				});
			});
		});

		$(function(){
			$(".a-href").click(function(e) {
				e.preventDefault();
				var form = $(this);
				var formdata = false;
				var id = $(this).attr("id");

				if (window.FormData) {
					formdata = new FormData(form[0]);
				}	
				swal({
					text: "ini akan mengubah status mahasiswa menjadi skripsi? setujui?",
					icon: "warning",
					buttons: ["Tidak ?", "Ya?"],
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
							success: function(result) {
								if (result === '1') {
									swal('Status Mahasiswa Berubah');
									$("#tabel_mahasiswa_admin").load('<?php echo base_url('admin/tabelNavigasi/0/Mahasiswa'); ?>');
								} else {
									swal({
										text: 'Maaf Terjadi Kesalahan Saat Mengubah Data',
										icon: 'error',
									});
								}
							}
						});
					} else {
						swal("Tidak Ada Perubahan");
					}
				});
			});
		});
	</script>
</head>
<?php if (!empty($users)) { ?>
	<table class="table small">
		<thead>
			<tr>
				<th scope="col">NIM</th>
				<th scope="col">Nama</th>
				<th scope="col">Jurusan</th>
				<th scope="col">Konsentrasi</th>
				<th scope="col">Email</th>
				<th scope="col">No HP</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($users->result() as $m):
				$status = $m->Status;
				?>
				<tr class="list-item tabel<?= $m->ID?>">
					<td><?= $m->ID;?></td>
					<td><?= $m->Nama;?></td>
					<td><?= $m->Jurusan;?></td>
					<td><?= $m->Konsentrasi;?></td>
					<td><?= $m->Email;?></td>
					<td><?= $m->NoHP;?></td>

					<td><?php if ($m->Status === 'Daftar') { ?>
						<a id="<?php echo $m->ID;?>" class="btn-action" action="<?php echo base_url('Admin/acceptDaftar/') ;?>"> 
							<button class="btn-action btn-sm btn btn-outline-primary"> Aksi </button>
						<?php } elseif ($m->Status === 'Mahasiswa') { ?>
							<a href="<?= base_url('Admin/statusSkripsi/'.$m->ID);?>" class="a-href" id="<?= $m->ID;?>">
								<?php echo $m->Status;?>
							</a>
						<?php } else {
							echo $m->Status;
						} ?>
					</td>
				</tr>	
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php echo $this->ajax_pagination->create_links(); ?>
<?php } else {
	echo $status." Tidak Ditemukan";
}