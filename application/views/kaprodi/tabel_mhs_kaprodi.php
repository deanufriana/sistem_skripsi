<head>
	<script type="text/javascript" src="<?php echo base_url('assets/js/myscript.js');?>"></script>
	<script type="text/javascript">
		$(function(){

			$(document).on("click","div.small",function(){
				$(this).find("span[class~='caption']").hide();
				$(this).find("input[class~='editor']").fadeIn().focus();
			});


			$(document).on("keydown",".edit",function(e){
				if(e.keyCode==13){
					var target=$(e.target);
					var value=target.val();
					var id=target.attr("data-id");
					var data={id:id,value:value};
					if(target.is(".field-name")){
						data.modul="nilai";
					}

					$.ajax({
						type:"post",
						cache:false,
						dataType: "json",
						data:data,
						url:"<?php echo base_url('Kaprodi/nilai'); ?>",
						success: function(a){
							target.hide();
							target.siblings("span[class~='caption']").html(value).fadeIn();
						}

					})

				}

			});
		});
	</script>	
</head>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th scope="col">NIM</th>
				<th scope="col">Nama</th>
				<th scope="col">No HP</th>
				<th>Email</th>
				<th>Nilai</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($skripsi)): foreach ($skripsi as $u):
				?>
				<tr class="text-left list-item">
					<td><?php echo $u->IDMahasiswaSkripsi;?></td>
					<td><a href="<?php echo base_url('Dosen/detailMahasiswa/'.$u->IDMahasiswaSkripsi);?>"><?php echo $u->Nama ?></a></td>
					<td><?= $u->NoHP;?></td>
					<td><?= $u->Email;?></td>
					<td>  <?php if ($u->Nilai === '0') {
						echo "<input data-id=".$u->IDSkripsi." class='form-control form-control-sm field-name edit' type='number' name='nilai' min='0' max='100' value=".$u->Nilai.">";
					} else {
						echo "<span class='caption'>".$u->Nilai."</span>";
					} ?> 	<span class='span-name caption' data-id='<?= $u->IDSkripsi ?>' style="display: none"> <?= $u->Nilai;?> </span>		</td>
				</tr>
				<tr class="list-item">
					<th scope="col">Judul</th>
					<td colspan="4"><a class="btn_view" id="pembimbing" href="<?php echo base_url('Kaprodi/pembimbing/'.$u->IDSkripsi);?>">
						<?php echo $u->JudulSkripsi;?>
					</a></td>
				</tr>
			<?php endforeach; else: ?>
		</tbody>
	</table>
	<div class="col-md text-center">
		<p>Belum Ada Data.</p>	
	</div>

<?php endif; ?>
</div>