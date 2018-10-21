<script type="text/javascript">
	$(document).ready(function(){
		$("button.acc").click(function(e) {
			e.preventDefault();
			var btn = $(this);
			var btndata = false;
			var id = $(this).attr("id");
			var action = $(this).attr("action");
			var willAcc = $(this).attr('acc');

			if (window.btndata) {
				btndata = new btndata(form[0]);
			}

			$.ajax({
				type: 'POST',
				url: action+id+'/'+willAcc,
				data: btndata ? btndata: btn.serialize(),
				contentType: false,
				processData: false,
				cache: false,
				beforeSend: function () {
					$('.loading').fadeIn();
				},
				success: function(result) {
					$(".tabel"+id).fadeOut('slow');
					$("#tabelMahasiswa").load('<?= base_url('admin/tabelNavigasi/0/Mahasiswa'); ?>');
					$("#tabel_daftar_admin").load('<?= base_url('admin/tabelNavigasi/0/Daftar'); ?>');
					swal(result);
					$('.loading').fadeOut('fast');

				}
			})

		});
	});
</script>
<div class="modal-body">
	<div class="modal loading" style="display:none;">
		<div class="modal-dialog modal-dialog-centered ">
			<div class="alert alert-info alert-white rounded modal-content">
				<strong> <i class="fas fa-spinner fa-pulse"> </i> Sedang Memproses </strong>
			</div>
		</div>
	</div>
</div>