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
							$("#daftar" + id).fadeOut('slow');
							$("#tabel_mhs_admin").load('<?php echo base_url('admin/tabel_mhs_admin'); ?>');
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
							$("#daftar" + id).fadeOut('slow');
						}
					});
				}
			});
		});
	});

	function search_daftar(page_num) {
		page_num = page_num?page_num:0;
		var keywords_mhs = $('#keywords_mhs').val();
		var sortBy_mhs = $('#sortBy_mhs').val();
		var cari_mhs = $('#cari_mhs').val();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>Admin/tabel_mhs_daftar/'+page_num,
			data:'page='+page_num+'&keywords_mhs='+keywords_mhs+'&sortBy_mhs='+sortBy_mhs+'&cari_mhs='+cari_mhs,
			beforeSend: function () {
				$('.loading').show();
			},
			success: function (html) {
				$('#tabel_mhs_daftar').html(html);
				$('.loading').fadeOut("slow");
			}
		});
	}

</script>
<table class="table">
	<thead>
		<tr>
			<th scope="col">NIM</th>
			<th scope="col">Nama</th>
			<th scope="col">Jurusan</th>
			<th scope="col">Email</th>
			<th scope="col">No HP</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>	
		<?php if (!empty($mhs)): foreach ($mhs as $m): ?>
			<tr class="list-item" id="daftar<?=$m->nim;?>">
				<td><?php echo $m->nim;?></td>
				<td><?php echo $m->nama_mhs;?></td>
				<td><?php echo $m->jurusan;?></td>
				<td><?php echo $m->konsentrasi;?></td>
				<td><?php echo $m->nohp_mhs;?></td>
				<td><a id="<?php echo $m->nim;?>" class="btn-action" href="<?php echo base_url('Admin/submit_daftar/'.$m->nim.'/tidak');?>" action="<?php echo base_url('Admin/submit_daftar/'.$m->nim.'/ya') ;?>"> <button class="btn-action btn-sm btn btn-outline-primary"> Aksi </button> </a>
				</td>
			</tr>				
		</tbody>
	<?php endforeach; else: ?>
	<p>Belum Ada Data.</p>
<?php endif; ?>
</table>

<?php echo $this->ajax_pagination->create_links(); ?>