<head>
	<script type="text/javascript">	
		$(function(){

			$(document).on("click","div.small",function(){
				$(this).find("span[class~='caption']").hide();
				$(this).find("input[class~='editor']").fadeIn().focus();
			});


			$(document).on("keydown",".editor",function(e){
				if(e.keyCode==13){
					var target=$(e.target);
					var value=target.val();
					var id=target.attr("data-id");
					var data={id:id,value:value};
					if (target.is(".field-name")){
						data.modul="Nama";
					} else if(target.is(".field-email")){
						data.modul="Email";
					} else if(target.is(".field-phone")){
						data.modul="NoHP";
					}

					$.ajax({
						type:"post",
						cache:false,
						dataType: "json",
						data:data,
						url:"<?php echo base_url('Dosen/update'); ?>",
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

<?php foreach ($users->result() as $d): ?>
	<?php $Status = $this->session->userdata('Status') == 'Skripsi' ? 'Mahasiswa' : $_SESSION['Status'];?>
	<div class="card mb-1">
		<?php if (file_exists('assets/images/User/'.$d->Foto)) {
			$base_url = base_url('assets/images/User/'.$d->Foto); 
		} else {
			$base_url = base_url('assets/images/fix/user.png');
		} 
		?>
		<img class="card-img-top m-2" src="<?= $base_url;?>" alt="Maaf Gambar Tidak Ditemukan" title="Image not Found">

		<div class="card-body">
			<div class="row">
				<div class="col-md">
					<div class="card-text small">	<span class='span-email caption' data-id='<?= $d->ID;?>'> <?= $d->Email;?> </span> <input type='email' class='field-email col-7 form-control-sm form-control editor' value='<?= $d->Email;?>' data-id='<?= $d->ID;?>' style="display: none;"/> 
					</div> 
					<div class="card-text small"> <span class='span-phone caption' data-id='<?= $d->ID;?>'> <?= $d->NoHP;?> </span> <input type='text' class='field-phone col-7 form-control-sm form-control editor' value='<?= $d->NoHP;?>' data-id='<?= $d->ID;?>' style="display: none;"/>
					</div>
				</div>

			</div>
		</div>
	</div>	
	<?php endforeach ?>