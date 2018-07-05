<script type="text/javascript">
	function cari_mhs(page_num) {
		page_num = page_num?page_num:0;
		var keywords_mhs = $('#keywords_mhs').val();
		var sortBy_mhs = $('#sortBy_mhs').val();
		var cari_mhs = $('#cari_mhs').val();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>Admin/tabel_mhs_admin/'+page_num,
			data:'page='+page_num+'&keywords_mhs='+keywords_mhs+'&sortBy_mhs='+sortBy_mhs+'&cari_mhs='+cari_mhs,
			beforeSend: function () {
				$('.loading').show();
			},
			success: function (html) {
				$('#tabel_mhs_admin').html(html);
				$('.loading').fadeOut("slow");
			}
		});
	}

	$(document).ready(function(){
		$(".href-mhs").click(function(e) {
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

	$("#tabel_mhs_daftar").load('<?php echo base_url('admin/tabel_mhs_daftar'); ?>');
	$("#tabel_mhs_admin").load('<?php echo base_url('admin/tabel_mhs_admin'); ?>');

</script>

<ul class="nav nav-pills text-center" id="pills-tab" role="tablist">
	<li class="nav-item col-md btn-sm">
		<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Data Mahasiswa</a>
	</li>
	<li class="nav-item col-md  btn-sm">
		<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#tabel_mhs_daftar" role="tab" aria-controls="pills-profile" aria-selected="false"> Data Pendaftar </a>
	</li>
</ul>

<hr>

<div class="tab-content" id="pills-tabContent">
	<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
		<div class="form-row">
			<div class="form-group col-md">
				<input class="form-control form-control-sm" id="keywords_mhs" type="text" placeholder="Cari Mahasiswa" onkeyup="cari_mhs()"/>
			</div>
			<div class="form-group col-md-2">
				<select class="form-control form-control-sm" id="cari_mhs" name="cari_mhs" onchange="cari_mhs()">
					<option value="nim">NIM</option>
					<option value="nama_mhs">Nama</option>
					<option value="jurusan">Jurusan</option>
				</select>
			</div>
			<div class="form-group col-md-2">
				<select class="form-control form-control-sm " id="sortBy_mhs" onchange="cari_mhs()">
					<option value="asc">Ascending</option>
					<option value="desc">Descending</option>
				</select>
			</div>
			<div class="form-group col-md-1 m-1 loading" style="display: none">
				<i class="fas fa-spinner fa-pulse"></i>
			</div>
		</div>

		<div class="tabel table-responsive" id="tabel_mhs_admin" nama="mahasiswa">
		</div>
	</div>
	<div class="tab-pane fade" id="tabel_mhs_daftar" role="tabpanel" aria-labelledby="pills-profile-tab"></div>
	<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
</div>