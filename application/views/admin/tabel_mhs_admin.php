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
					text: "ini akan mengubah status mahasiswa menjadi skripsi? setujui?",
					icon: "warning",
					buttons: ["Tidak ?", "Ya?"],
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
								swal('status diubah');
								$("#tabel_mhs_admin").load('<?php echo base_url('admin/tabel_mhs_admin'); ?>');
							}
						});
					} else {
						swal("status tetap mahasiswa !");
					}
				});
			});
		});
	</script>
</head>
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
		<?php if (!empty($mhs)): foreach ($mhs as $m): ?>
			<tr class="list-item">
				<td><?= $m->nim;?></td>
				<td><?= $m->nama_mhs;?></td>
				<td><?= $m->jurusan;?></td>
				<td><?= $m->konsentrasi;?></td>
				<td><?= $m->email_mhs;?></td>
				<td><?= $m->nohp_mhs;?></td>
				<td><?php if ($m->status === 'Mahasiswa') {	?>
					<a href="<?= base_url('Admin/status/'.$m->nim);?>" class="a-href" id="<?= $m->nim;?>">
						<?php echo $m->status;?>
					</a>
				<?php } 
				else {
					echo $m->status; } 	?>
				</td>
			</tr>	
		<?php endforeach; else: ?>
		<p>Belum Ada Data.</p>
	<?php endif; ?>
</tbody>
</table>
<?php echo $this->ajax_pagination->create_links(); ?>