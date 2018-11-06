$(document).ready(function(){
	// berfungsi untuk menghapus data
	$("div#container").on('click', 'a.hapus', (function(e) {
		e.preventDefault();
		var form = $(this);
		var formdata = false;
		var id = $(this).attr("id");
		
		if (window.FormData) {
			formdata = new FormData(form[0]);
		}	
		swal({
			title: "Apa kau yakin ingin menghapus?",
			text: "sekali dihapus kau tidak akan dapat mengembalikannya lagi!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					type: "POST",
					url: form.attr("href"),
					data: formdata ? formdata: form.serialize(),
					contentType: false,
					processData: false,
					cache: false,
					async:false,
					success: function() {
						$(".tabel" + id).fadeOut("slow");
					}
				});
			} else {
				swal("Data Tidak Dihapus!");
			}
		});
	}));

	// btn view berfungsi untuk melihat data
	$("div#container").on('click', 'a.btn_view', function(e) {
		e.preventDefault();
		var form = $(this);
		var formdata = false;
		var id = $(this).attr("id");

		if (window.FormData) {
			formdata = new FormData(form[0]);
		}	
		$.ajax({
			type: 'POST',
			url: form.attr('href'),
			data: formdata ? formdata: form.serialize(),
			contentType: false,
			processData: false,
			cache: false,
			async:false,
			beforeSend: function() {
				$('.loading').show();
			},
			success: function() {
				$(".SH"+id).fadeIn('fast' ,function() {
					$("#SH"+id).load(form.attr('href')).fadeIn('fast');
					$('.loading').fadeOut('slow');
				});
			}
		});
	});
});