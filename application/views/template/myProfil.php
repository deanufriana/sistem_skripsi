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
						url:"<?php echo base_url('ControllerGlobal/update'); ?>",
						success: function(a){
							target.hide();
							target.siblings("span[class~='caption']").html(value).fadeIn();
						},
						error: function(e) {
							swal(e.statusText, 'Nomer HP Sudah Pernah Digunakan')
						}

					})

				}

			});
		});
		
		$('#foto').click(function (e) { 
			e.preventDefault();
			$('#upload').trigger('click');
		});

		function readUrl(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#foto').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		$("#upload").change(function() {
			readUrl(this);
		});
	</script>

	<style>
	
	#foto:hover {
  		background-color: black;
		opacity: 0.5
	}

	</style>

</head>

<?php foreach ($users->result() as $d): ?>
	<?php $Status = $this->session->userdata('Status') == 'Skripsi' ? 'Mahasiswa' : $_SESSION['Status'];?>
	<div class="card mb-1">
		<?php if ($d->Foto !== null) {
			$image = base_url('assets/images/users/'.$d->Foto); 
		} else {
			$image = base_url('assets/web/user.png');	
		} 
		?>

		<div class="card-body">
		<img id='foto' class="card-img-top mb-2" src="<?= $image;?>" alt="Maaf Gambar Tidak Ditemukan" title="Ganti Foto">
		<form action="<?= base_url('ControllerGlobal/uploadFoto') ?>" method="post" class='form-inline' enctype="multipart/form-data">
			<input type="file" name="upload" id="upload" class='form-control-sm' style='display:none' value="$foto['file_name']">	
			<button class='btn btn-sm btn-primary col-md' type="submit"><i class='fas fa-upload''></i> Upload</button>		
		</form>
			<div class="row">
				<div class="col-md">
					<div class="card-text small mt-2">	
					<span class='span-email caption' data-id='<?= $d->ID;?>'> 	<i class='fas fa-envelope'></i>  <?= $d->Email;?> </span> 
						<input type='email' class='field-email form-control-sm form-control editor' value='<?= $d->Email;?>' data-id='<?= $d->ID;?>' style="display: none;"/> 
					</div> 
					<div class="card-text small mt-2"> 
					 <span class='span-phone caption' data-id='<?= $d->ID;?>'> <i class='fas fa-phone'></i>  <?= $d->NoHP === null ? 'klik to add phone number' : $d->NoHP ;?> </span> <input type='number' class='field-phone form-control-sm form-control editor' value='<?= $d->NoHP;?>' data-id='<?= $d->ID;?>' style="display: none;"/>
					</div>
				</div>

			</div>
		</div>
	</div>	
	<?php endforeach ?>