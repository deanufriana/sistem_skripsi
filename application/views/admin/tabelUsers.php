<head>
	<script type="text/javascript">
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
					title: "Memasuki Proses Skripsi ?",
					text: "Mahasiswa Akan Mengakses Semua Fitur Untuk Skripsi, Pastikan Semua Persyaratan Telah Terpenuhi Sebelum Mengubah Status",
					icon: "warning",
					buttons: ["Tidak", "Ya"],
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
									swal('Perubahan Berhasil !', 'Proses Skripsi Sedang Berjalan');
									$("#tabelMahasiswa").load('<?php echo base_url('admin/tabelNavigasi/0/Mahasiswa'); ?>');
								} else {
									swal({
										text: 'Maaf Terjadi Kesalahan Saat Mengubah Data',
										icon: 'error',
									});
								}
							}
						});
					} else {
						swal("Perubahah Status Mahasiswa Dibatalkan");
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

						<button acc='true' type="button" id="<?= $m->ID?>" action="<?= base_url('Admin/acceptDaftar/')?>" class=" acc btn-action btn-sm btn btn-outline-success"><i class="fas fa-check"></i> </button> 
						
						<button type="button" acc='false' id="<?= $m->ID?>" action="<?= base_url('Admin/acceptDaftar/')?>" class="acc btn-action btn-sm btn btn-outline-danger"> <i class="fas fa-window-close"></i> </button> 
						
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