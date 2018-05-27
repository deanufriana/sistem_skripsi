<head>

	<script type="text/javascript">

		$(function(){

			$.ajaxSetup({
				type:"post",
				cache:false,
				dataType: "json"
			})


			$(document).on("click","td",function(){
				$(this).find("span[class~='caption']").hide();
				$(this).find("input[class~='editor']").fadeIn().focus();
			});


			$(document).on("keydown",".editor",function(e){
				if(e.keyCode==13){
					var target=$(e.target);
					var value=target.val();
					var id=target.attr("data-id");
					var data={id:id,value:value};
					if(target.is(".field-name")){
						data.modul="nama_dosen";
					}else if(target.is(".field-email")){
						data.modul="email_dsn";
					}else if(target.is(".field-phone")){
						data.modul="nohp_dsn";
					}

					$.ajax({
						data:data,
						url:"<?php echo base_url('Admin/update'); ?>",
						success: function(a){
							target.hide();
							target.siblings("span[class~='caption']").html(value).fadeIn();
						}

					})

				}

			});


			$(document).on("click",".hapus-member",function(){
				var id=$(this).attr("data-id");
				swal({
					title:"Hapus Member",
					text:"Yakin akan menghapus member ini?",
					type: "warning",
					showCancelButton: true,
					confirmButtonText: "Hapus",
					closeOnConfirm: true,
				},
				function(){
					$.ajax({
						url:"<?php echo base_url('index.php/crud/delete'); ?>",
						data:{id:id},
						success: function(){
							$("tr[data-id='"+id+"']").fadeOut("fast",function(){
								$(this).remove();
							});
						}
					});
				});
			});

		});

	</script>
</head>
<button class="btn btn-info" id="tambah-data"><i class="glyphicon glyphicon-plus-sign"></i> Tambah </button>

<table class="table">
	<thead>
		<tr>
			<th scope="col">NIK</th>
			<th scope="col">Nama</th>
			<th scope="col">Jurusan</th>
			<th scope="col">Email</th>
			<th scope="col">No HP</th>
		</tr>
	</thead>
	<tbody id="dsn">
		<?php if (!empty($dosen)): foreach ($dosen as $d): ?>
			<tr>
				<td><?php echo $d->nik;?></td>
				<td><span class='span-email caption' data-id='<?= $d->nik;?>'><?php echo $d->nama_dosen;?></span> <input type='text' class='field-name form-control editor' value='<?php echo $d->nama_dosen;?>' data-id='<?= $d->nik;?>' style="display: none;"/></td>
				<td><?php echo $d->jurusan;?></td>
				<td><span class='span-email caption' data-id='<?= $d->nik;?>'><?= $d->email_dsn;?></span> <input type='text' class='field-email form-control editor' value='<?= $d->email_dsn;?>' data-id='<?= $d->nik;?>' style="display: none;"/></td>
				<td><?php echo $d->nohp_dsn;?></td>
			</tr>	
		<?php endforeach; else: ?>
		<p>Data tidak ditemukan.</p>
	<?php endif; ?>
</tbody>
</table>
<?php echo $this->ajax_pagination->create_links(); ?>