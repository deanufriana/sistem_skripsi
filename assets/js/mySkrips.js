$(document).ready(function(){
	$(".btn-action").click(function(e) {
		e.preventDefault();
		var form = $(this);
		var formdata = false;
		var id = $(this).attr("id");
		var action = $(this).attr("action");

		if (window.FormData) {
			formdata = new FormData(form[0]);
		}

		var ajax = $.ajax({
			type: 'POST',
			url: action+id+'/'+willDelete,
			data: formdata ? formdata: form.serialize(),
			contentType: false,
			processData: false,
			cache: false,
			success: function() {
				$(".tabel" + id).fadeOut('slow');
			}
		});

		swal({
			text: "Mahasiswa Mengajukan Pendaftaran, ACC?",
			icon: "warning",
			buttons: ["Tolak ?", "Terima?"],
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				ajax
			} else {
				ajax
			}
		});
	});
});