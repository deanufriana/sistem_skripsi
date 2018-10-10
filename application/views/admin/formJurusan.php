<head>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#fakultas").on('submit',
        function(e) {
          e.preventDefault();
          var form = $(this);
          var formdata = false;

          if (window.FormData) {
            formdata = new FormData(form[0]);
          }

          var formAction = form.attr('action');

          $.ajax({
            type: 'POST',
            url: formAction,
            data: formdata ? formdata: form.serialize(),
            contentType: false,
            processData: false,
            cache: false,
            success: function() {
              swal("", "Jurusan berhasil ditambahkan", "success");
              $("#tabelJurusanAdmin").load('<?php echo base_url('admin/tabelJrsnAdmin'); ?>');
            }
          });
        });
    });
  </script>
</head>
<form method="POST" action="<?php echo base_url('Admin/saveJurusan');?>" id="fakultas">
  <div class="form-row align-items-center">
    <div class="col-md-auto">
      <label class="sr-only" for="inlineFormInput">ID Fakultas</label>
      <input name="id_jurusan" min="0" type="number" class="form-control btn-sm mb-4" placeholder="ID Jurusan">
    </div>
    <div class="col-md">
      <label class="sr-only" for="inlineFormInputGroup">Jurusan</label>
      <div class="input-group mb-4">
        <input name="jurusan" type="text" class="form-control btn-sm" placeholder="Jurusan">
      </div>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-4 btn-sm">Submit</button>
    </div>
  </div>
</form>