<head>
	<script type="text/javascript">
		$("#btn-login").click(function(){
			var formAction = $("#login").attr('action');
			var datalogin = {
				pass_lama: $("#pass_lama").val(),
				pass_baru: $("#pass_baru").val()
			};

			if (!$("#pass_lama").val() || !$("#pass_baru").val()) {
				$("#warning").show('fast').delay(2000).hide('fast');
				return false;
			} else {
				$.ajax({
					type: "POST",
					url: formAction,
					data: datalogin,
					success: function(result) {
						if(result == 1) {
							$("#success").show('fast').delay(2000).hide('slow', function() {
								$("#Ubah").modal('toggle');						
							});;
						}
						else {
							$("#failed").show('fast').delay(2000).hide('fast');
							$('#pass_lama').val('');
							$('#pass_baru').val('');
							return false;
						}
					}
				});
				return false;
			}
		});   

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
					if(target.is(".field-name")){
						data.modul="nama_mhs";
					}else if(target.is(".field-email")){
						data.modul="email_mhs";
					}else if(target.is(".field-phone")){
						data.modul="nohp_mhs";
					}

					$.ajax({
						type:"post",
						cache:false,
						dataType: "json",
						data:data,
						url:"<?php echo base_url('Mahasiswa/update'); ?>",
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

<div class="modal fade ubah" id="Ubah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<form id="login" method="POST" action="<?php echo base_url('Mahasiswa/update_password');?>">
					<div class="content">
						<div id="success" class="alert alert-success alert-white rounded" style="display:none;">
							<strong><i class="fas fa-check"></i> Password Berhasil di Ubah !</strong>
						</div>
						<div id="warning" class="alert alert-warning alert-white rounded" style="display:none;">
							<strong> <i class="fas fa-exclamation"></i> Peringatan !</strong>
							<br>Kata Sandi Tidak Boleh Kosong
						</div>
						<div id="failed" class="alert alert-danger alert-white rounded"style="display:none;">
							<strong><i class="fas fa-user-times"></i> Password Salah !</strong>
							<br>Kata Sandi Lama Salah!
						</div>						
					</div>

					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Password Lama</label>
						<input type="password" class="form-control" id="pass_lama" name="pass_lama">
					</div>
					<div class="form-group">
						<label for="message-text" class="col-form-label">Password Baru</label>
						<input type="Password" name="pass_baru" id="pass_baru" class="form-control">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
						<button type="submit" class="btn btn-primary" id="btn-login"> <i class="fas fa-sign-in-alt"></i> Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<img class="card-img-top" src="<?php echo base_url('assets/images/').$this->session->userdata('foto_mhs');?>">
<div class="card-body">
	<?php foreach ($mahasiswa as $m) {
		echo $this->session->userdata('jurusan')." ".$this->session->userdata('konsentrasi');
		?>
		<h6 class="card-title"><?= $m->nama_mhs;?> / <?= $m->nim;?></h6>
		<hr>

		<a href="#" data-target="#Ubah" data-toggle="modal" class="btn btn-outline-primary btn-sm float-right"><i class="fas fa-edit"></i> Password </a>
		<div class="card-text small">	<span class='span-email caption' data-id='<?= $this->session->userdata('nim');?>'> <?= $m->email_mhs;?> </span> <input type='email' class='field-email col-7 form-control-sm form-control editor' value='<?= $m->email_mhs;?>' data-id='<?= $this->session->userdata('nim');?>' style="display: none;"/> 
		</div> 
		<div class="card-text small"> <span class='span-phone caption' data-id='<?= $this->session->userdata('nim');?>'> <?= $m->nohp_mhs;?> </span> <input type='text' class='field-phone col-7 form-control-sm form-control editor' value='<?= $m->nohp_mhs;?>' data-id='<?= $this->session->userdata('nim');?>' style="display: none;"/>
		</div>
	<?php } ?> 

</div>