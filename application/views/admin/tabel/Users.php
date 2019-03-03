<head>
	<script type="text/javascript">
		$(function(){
			$(".a-href").click(function(e) {
				e.preventDefault();
				var form = $(this);
				var formdata = false;
				var id = $(this).attr("id");
				var title = $(this).attr("title");
				var text = $(this).attr("text");

				if (window.FormData) {
					formdata = new FormData(form[0]);
				}
				swal({
					title: title,
					text: text,
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
							beforeSend: function () {
								$('.loading').fadeIn();
							},
							success: function(result) {
								swal(result);
								$("#tabelMahasiswa").load('<?php echo base_url('admin/tabelNavigasi/0/Mahasiswa'); ?>');
								$("#tabelDosen").load('<?php echo base_url('admin/tabelNavigasi/0/Dosen'); ?>');
								$('.loading').fadeOut();
							}
						});
					} else {
						swal("Perubahah Status Mahasiswa Dibatalkan");
					}
				});
			});

		});

		$(".form<?=$status?>").load('<?=base_url('admin/formUsers/' . $status);?>');
	</script>
</head>

<?php if (!empty($users)) {?>
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
        ?>
							<tr class="list-item tabel<?=$m->ID?> <?php if (empty($m->Password)) {
            echo 'table-warning';
        }?>">
							<td><?=$m->ID;?></td>
							<td><a class="a-href" title="Kirim Ulang Password?" text="Ini akan mengubah password dan akan di kirim melalui email." href="<?=base_url('Admin/sendPassword/' . $m->ID)?>"> <?=$m->Nama;?> </a></td>
							<td><?=$m->Jurusan;?></td>
							<td><?=$m->Konsentrasi;?></td>
							<td><?=$m->Email;?></td>
							<td><?=$m->NoHP;?></td>

							<td><?php if ($m->Status === 'Daftar') {?>

								<button acc='true' type="button" id="<?=$m->ID?>" action="<?=base_url('Admin/acceptDaftar/')?>" class="acc btn-action btn-sm btn btn-outline-success"><i class="fas fa-check"></i> </button>

								<button type="button" acc='false' id="<?=$m->ID?>" action="<?=base_url('Admin/acceptDaftar/')?>" class="acc btn-action btn-sm btn btn-outline-danger"> <i class="fas fa-window-close"></i> </button>

							<?php } elseif ($m->Status === 'Mahasiswa') {?>
					<a title="Mengubah Status Mahasiswa?" text="Mahasiswa Akan Mengakses Semua Fitur Untuk Skripsi, Pastikan Semua Persyaratan Telah Terpenuhi Sebelum Mengubah Status" href="<?=base_url('Admin/statusSkripsi/' . $m->ID);?>" class="a-href" id="<?=$m->ID;?>">
						<?php echo $m->Status; ?>
					</a>
				<?php } else {
        echo $m->Status;
    }?>
			</td>
		</tr>
	<?php endforeach;?>
</tbody>
</table>

<div class="form<?=$status?>"></div>


	<div class="alert alert-info" role="alert">
	<div class="close">
		<i class="fas fa-info"> </i>
	</div>
	Tabel yang berwarna Kuning pertanda bahwa pengguna belum pernah menerima password dari admin untuk mengirim password dari admin silahkan klik pada bagian nama pengguna dan pastikan email server bekerja maka password akan di kirim melalui email masing masing
	</div>


<?php echo $this->ajax_pagination->create_links(); ?>
<?php } else {?>
	<div class='container-fluid mt-5'>
		<div class='row align-items-center'>
			<div class='col-md'>
				<h2>Data <?=$status === 'Daftar' ? 'Pendaftar' : $status?> ga Ada, Min.</h2>
				<?php if ($status === 'Dosen') {?>
					Data <?=$status?> yang dicari belum ada, min. Silahkan Jika Butuh Tambahan Dosen  Ada di Bagian Navigasi Masukan Dosen. Gunakan Dengan Menggunakan Data Yang Valid Dimana Password Untuk Login Akan Di Kirim Melalui Email Dosen.
				<?php } elseif ($status === 'Daftar') {?>
					Lagi Liat Liat Yang Daftar ya min.. Maaf ya min sayangnya kaga ada.
				<?php } else {?>
					Data <?=$status?> yang dicari belum ada, min. Silahkan Minta Mahasiswa Untuk Mendaftar Di Halaman Awal. Kemudian Silahkan Validasi bener ga itu mahasiswa sini Di Navigasi Pendaftar.
				<?php }?>
			</div>
			<div class='col-md-3'>
				<img src="<?=base_url('assets/web/sad.jpg')?>">
			</div>
		</div>
	</div>
<?php }?>
