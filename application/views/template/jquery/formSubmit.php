<head>
	<script type="text/javascript">
		$("form").on('submit', 
			function(e) {
				e.preventDefault();
				var form = $(this)
				var formData = false;
				if (window.FormData) {
					formdata = new FormData(form[0])
				}

				var formAction = form.attr('action');

				$.ajax({
					url: formAction,
					type: 'POST',
					cache:false,
					contentType:false,
					processData:false,
					data: formdata ? formdata: form.serialize(),
					success: function (result, status) {
						if (result) {
							swal(result, '', status);
						} else {
							swal('Terjadi Kesalahan', 'Mohon Maaf Untuk Saat Ini Ada Kesalahan Dalam Sistem Coba Lagi Nanti', 'error');
						}
					}
				})

			});
		</script>
	</head>