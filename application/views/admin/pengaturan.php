<head>
  <script type="text/javascript">
    $(".btn-pass").click(function(){
      var formAction = $("#pass_admin").attr('action');
      var datalogin = {
        username: $("#username").val(),
        pass_lama: $("#pass_lama").val(),
        pass_baru: $("#pass_baru").val()
      };

      if (!$("#pass_lama").val() || !$("#pass_baru").val() || !$("#username").val()) {
        $("#warning").show('fast').delay(2000).hide('fast');
        return false;
      } else {
        $.ajax({
          type: "POST",
          url: formAction,
          data: datalogin,
          success: function(result) {
            if(result == 1) {
              $("#success").show('fast').delay(2000).hide('fast');
            } else {
              $("#failed").show('fast').delay(2000).hide('fast');
              $('#username').val('');
              $('#pass_lama').val('');
              $('#pass_baru').val('');
              return false;
            }
          }
        });
        return false;
      }
    });    
  </script>
</head>
<form class="mb-3" id="pass_admin" method="post" action="<?php echo base_url('Admin/submit_pwd');?>">
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

  
  <div class="form-row">
    <div class="form-group col-md">
      <label for="exampleInputEmail1">Username</label>
      <input type="text" class="form-control" id="username" placeholder="Username" name="username">
    </div>
    <div class="form-group col">
      <label for="exampleInputPassword1">Password Lama</label>
      <input type="password" class="form-control" id="pass_lama" name="pass_lama" placeholder="Password">
    </div>
    <div class="form-group col">
      <label for="exampleInputPassword1">Password Baru</label>
      <input type="password" class="form-control" id="pass_baru" name="pass_baru" placeholder="Password">
    </div>
  </div>
  <button type="submit" class="btn btn-primary btn-pass">Submit</button>
</form> 