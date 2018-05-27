<head>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#save_konsentrasi").on('submit',
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
              swal("", "Konsentrasi Jurusan Berhasil Ditambahkan!", "success")
              $('#jurusan').load('<?php echo base_url('Admin/jurusan');?>');
            }
          });
        });

      $("#jrsn").change(function(){ 
        $("#prodi").hide();
        $.ajax({
          type: "POST", 
          url: "<?php echo base_url("Admin/filter_kaprodi"); ?>", 
          data: {id_jurusan : $("#jrsn").val()}, 
          dataType: "json",
          success: function(response){ 
            $("#view").show('fast', function() {
              $("#dsn").html(response.list).show();  
            });
            
          },
        });
      });

    });
  </script>
</head>
<form id="save_konsentrasi" action="<?php echo base_url('Admin/save_konsentrasi');?>" method="post">
  <div class="form-row align-items-center">
    <div class="col-md  mb-4">
      <label class="sr-only" for="inlineFormInput">ID Konsentrasi</label>
      <input min="0" type="number" class="form-control mb-s4 form-control-sm" id="inlineFormInput" placeholder="ID Konsentrasi" name="id">
    </div>
    <div class="col-md mb-4">

      <input type="text" name="konsentrasi" class="form-control form-control-sm" id="inlineFormInputGroup" placeholder="Konsentrasi">
    </div>
    <div class="col-md mb-4">
      <select name="id_jurusan" class="custom-select mr-sm-2 form-control-sm" id="jrsn">
        <option selected>Jurusan</option>
        <?php foreach ($jurusan as $j) { ?>  
          <option value="<?php echo $j->id_jurusan;?>"><?php echo $j->jurusan;?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-md mb-4" style="display: none" id="view">
        <select name="prodi" class="custom-select mr-sm-2 form-control-sm" id="dsn">
          <option selected>Pilih Kepala Jurusan</option>
        </select>
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-4 btn-sm">Submit</button>
      </div>
    </div>
  </form>