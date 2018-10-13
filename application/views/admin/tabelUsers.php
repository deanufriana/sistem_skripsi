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
						beforeSend: function () {
							$('.loading').show();
						},
						success: function() {
							$(".tabel"+id).fadeOut('slow');
							$('.loading').fadeOut('fast');
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
<div class="modal-body">
	<div id="loading" class="modal" style="display:none;">
		<div class="modal-dialog modal-dialog-centered ">
			<div class="alert alert-info alert-white rounded modal-content">
				<strong> <i class="fas fa-spinner fa-pulse"> </i> Sedang Memproses </strong>
			</div>
		</div>
	</div>
</div>
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
<?php } else { ?>
	<div class='container-fluid mt-5'>
		<div class='row align-items-center'>
			<div class='col-md'>
				<h2>Data <?= $status === 'Daftar' ? 'Pendaftar' : $status ?> ga Ada, Min.</h2>
				<?php if ($status === 'Dosen') { ?>
					Data <?= $status ?> yang dicari belum ada, min. Silahkan Jika Butuh Tambahan Dosen  Ada di Bagian Navigasi Masukan Dosen. Gunakan Dengan Menggunakan Data Yang Valid Dimana Password Untuk Login Akan Di Kirim Melalui Email Dosen.
				<?php } elseif($status === 'Daftar') { ?>
					Lagi Liat Liat Yang Daftar ya min.. Maaf ya min sayangnya kaga ada.
				<?php } else { ?>
					Data <?= $status ?> yang dicari belum ada, min. Silahkan Minta Mahasiswa Untuk Mendaftar Di Halaman Awal. Kemudian Silahkan Validasi bener ga itu mahasiswa sini Di Navigasi Pendaftar.					
				<?php } ?>
			</div>
			<div class='col-md-3'>
				<img src="<?= base_url('assets/images/fix/sad.jpg')?>">
			</div>
		</div>
	</div>
	<?php } ?>